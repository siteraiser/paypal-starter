<?php 
	session_start();
	$live_site = false;
	require $_SERVER['DOCUMENT_ROOT'].  '/vendor/autoload.php';
	//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
	use PayPalCheckoutSdk\Core\PayPalHttpClient;
	use PayPalCheckoutSdk\Core\SandboxEnvironment; //ProductionEnvironment  not LiveEnvironment...
	use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

	use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
	
	
	
	//Crude router...
	switch ($_POST['action']) {
	case "ping":
	ping();
	break;
	case "form":
	saveuserforms();
	break;
	case "create_order":
	create($live_site);	
	break;
	case "capture":
	capture($live_site);	
	break;
	default:
	exit();
	}
	
	
	
	
	function create($live_site=false){	
		$clientId = "";
		$clientSecret = "";
		if($live_site){
			$environment = new ProductionEnvironment($clientId, $clientSecret);
		}else{
			$environment = new SandboxEnvironment($clientId, $clientSecret);
		}
		
		$client = new PayPalHttpClient($environment);	
		
		$user_inputs = $_SESSION['form_data'];
		$description = $user_inputs['fname'].' '.$user_inputs['lname'].' - Service Payment';	
		$fee = str_replace([','], '',$_SESSION['fee']);
		
		$request = new OrdersCreateRequest();
		
		$request->prefer('return=representation');
		$request->body = array(
				'intent' => 'CAPTURE',
				'application_context' =>
					array(
					  'brand_name' => 'Site Raiser',
					  'locale' => 'en-US',
					  'shipping_preference' => 'NO_SHIPPING'
					),
			   'payer' => array(
					"address" => array(
						"address_line_1"=>$user_inputs['address1'],
						"address_line_2"=>$user_inputs['address2'],
						"admin_area_2"=>$user_inputs['city'],
						"country_code"=>$user_inputs['country'],
						"postal_code"=>$user_inputs['zip'],
						"admin_area_1"=>$user_inputs['state']
					),
					"name" => array(
						"given_name"=>$user_inputs['fname'],
						"surname"=>$user_inputs['lname']
					),
					"email_address"=>$user_inputs['email']
				),
					
					
				'purchase_units' =>
					array(
						0 =>
							array('description' => html_entity_decode($description),
								  'soft_descriptor' => 'Enrollment',
								  'amount' =>
									array(
										'currency_code' => 'USD',
										'value' => $fee
									)
							)
					)
			);
	   // 3. Call PayPal to set up a transaction
		//$client = PayPalClient::client();
		$response = $client->execute($request);
		
		
		$debug = false;
		if ($debug)
		{
			print "Status Code: {$response->statusCode}\n";
			print "Status: {$response->result->status}\n";
			print "Order ID: {$response->result->id}\n";
			print "Intent: {$response->result->intent}\n";
			print "Links:\n";
			foreach($response->result->links as $link)
			{
				print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
			}

		}else{
			echo '{"id":"'.$response->result->id.'"}';
			exit;
			
		}
	}
	function capture($live_site=false){	
		// Creating an environment
		$orderId =$_POST['order_id'];

		// Creating an environment
		$clientId = "";
		$clientSecret = "";
		if($live_site){
			$environment = new ProductionEnvironment($clientId, $clientSecret);
		}else{
			$environment = new SandboxEnvironment($clientId, $clientSecret);
		}
		
		$client = new PayPalHttpClient($environment);	
		$request = new OrdersCaptureRequest($orderId);

    // 3. Call PayPal to capture an authorization
  //  $client = PayPalClient::client();
    $response = $client->execute($request);    
    //	$orderresponse = $this->getOrder($response->result->id);   
    	
		if($response->result->status == 'COMPLETED'){			    
	
			//useful data...
			$total = $response->result->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;				
			$transaction_fee = $response->result->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value;						
			$status = $response->result->status;
			//useful data...
			
		}
				
	/* success */				
	$debug = false;
	   
		if ($debug)
		{
			echo'<pre>';
			var_dump($response);
			 echo'</pre>';
		print "Email: {$response->result->payer->email_address}\n";   
		print "Status Code: {$response->statusCode}\n";
		print "Status: {$response->result->status}\n";
		print "Order ID: {$response->result->id}\n";
		print "Links:\n";
		foreach($response->result->links as $link)
		{
			print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
		}
		print "Capture Ids:\n";
		foreach($response->result->purchase_units as $purchase_unit)
		{
			foreach($purchase_unit->payments->captures as $capture)
			{   
				print "\t{$capture->id}";
			}
		}
		  // To print the whole response body, uncomment the following line
		  // echo json_encode($response->result, JSON_PRETTY_PRINT);
		  
		}
		echo json_encode($response->result);
	exit;
	    
	}	
	
	function saveuserforms(){
	    
	   //	$headers = apache_request_headers();
		//$is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');
        //if($is_ajax){	    
	        $_SESSION['form_data']=filter_var_array($_POST, FILTER_SANITIZE_STRING);
	     //    echo 'saved';
       // }  
       exit();
    }
	function ping(){
	    
	   	$headers = apache_request_headers();
		$is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');
        if($is_ajax){	    
	        echo 'ping';
        }  
       exit();
    }