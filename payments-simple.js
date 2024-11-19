
window.onload = function() {


function validateEmail(email){
	return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(email) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(email);
}

function addOneError(fieldid){
    if(errors.indexOf(fieldid) == -1){
		errors.push(fieldid);
		$("#"+fieldid).addClass('details-error');
    }
}

function inputsFilled(){
    //Block wallet payments button if anything is empty

if($('#fname').val() !='' && 
$('#lname').val() !='' && 
validateEmail($('#email').val()) && 
$('#address1').val() !='' && 
$('#city').val() !='' && 
$('#state').val() !='' && 
($('#zip').val() !='' || !postalCodeRequired($('#country').val())) && 
$('#country').val() !='' 
){
	return true;
}else{
   return false;
}	
}


var pcodereq = ["AR","AU","AT","BT","BR","CA","C2","KM","DK","FK","FO","FR","GM","DE","GL","IT","JP","KI","KG","MW","MR","YT","MX","NR","NL","NE","MU","NF","NO","PN","PL","RU","SG","ES","SH","PM","SR","SJ","SE","CH","TV","GB","US","VA","WF"];
//var pcodereq = ["DZ","AR","AM","AU","AT","AZ","PT","BD","BY","BE","BA","BR","BN","BG","CA","IC","CN","CO","HR","CY","CZ","DK","EC","GB","EE","FO","FI","FR","GE","DE","GR","GL","GU","GG","NL","HU","IN","ID","IL","IT","JP","JE","KZ","KR","FM","KG","LV","LI","LT","LU","MK","MG","PT","MY","MH","MQ","YT","MX","MN","ME","NL","NZ","GB","NO","PK","PH","PL","FM","PT","PR","RE","RU","SA","SF","RS","SG","SK","SI","ZA","ES","LK","SX","VI","VI","SE","CH","TW","TJ","TH","TU","TN","TR","TM","VI","UA","GB","US","UY","UZ","VA","VN","GB","FM"];

function postalCodeRequired(code){
  if (pcodereq.indexOf(code) != -1)
	{
		return true;
	}    
}


//Save input details to session or localstorage
function saveuserforms(json){
	$('#payment-details').addClass('saving');
	$.ajax({
		type: "POST",
		url: "/process.php",
		data: json,
		cache: false,
		success: function(data) {
			$('#payment-details').removeClass('saving');
		},
		error: function(xhr, status, error) {
			console.error(xhr);
			console.log("Paypal buttons not enabled since we have an error here and the user forms are not saved.");
		}
	});
}



var errors = [];
var checkAddressFieldsEvents = 0;		
	

//Ensure email is filled out#example4-email blur
$('body').on('keyup change input cut paste click','#fname,#lname,#email,#address1,#address2,#city,#state,#zip,#country',function(event){	//,#agree,#agreed,#disagree

	checkAddressFieldsEvents = checkAddressFieldsEvents + 1;
	setTimeout(function() { 
		while(checkAddressFieldsEvents >= 1){
			if(checkAddressFieldsEvents ===1){
				updateFields(event);
				checkAddressFieldsEvents = 0;
			}else{
				checkAddressFieldsEvents--;
			} 
		}
	}, 400);		
});


var last_selected_country ='';

function updateFields(event){
	//console.log(event.target.id);
	//console.log(errors);

	var fields = '#fname,#lname,#email,#address1,#address2,#city,#state,#zip,#country';
	var fieldsarr = fields.split(",");
	for(var i = 0; i < fieldsarr.length; i++)
	{
	 //console.log(fieldsarr[i]);
		if(fieldsarr[i] !== '#address2' && fieldsarr[i] !== '#email' && fieldsarr[i] !== '#zip' && fieldsarr[i] !== '#state' ){ //&& fieldsarr[i] !== '#agreed'
				
			if($(fieldsarr[i]).val() != ''){
			   var index = errors.indexOf(fieldsarr[i].substring(1));
				if (index !== -1) {
				  errors.splice(index, 1);
				}
				  $(fieldsarr[i]).removeClass('details-error');
			}else{
				addOneError(fieldsarr[i].substring(1));
			}
		}
	}



	$("#email").val($("#email").val().toLowerCase());	    
	if(validateEmail($("#email").val())){
		var index = errors.indexOf('email');
		if (index !== -1) {
		  errors.splice(index, 1);   
		  $('#email').removeClass('details-error');
		}
	}else{
		addOneError('email');
	}
	
	//ensure state is 2 chars    
	if($("#state").val().length == 2){
		var index = errors.indexOf('state');
		if (index !== -1) {
		  errors.splice(index, 1);   
		  $('#state').removeClass('details-error');
		}
	}else{
		addOneError('state');
	}
	
	
	//Zip required?...
	if(!postalCodeRequired($('#country').val()) || $('#zip').val() != ''){
		var index = errors.indexOf('zip');
		if (index !== -1) {
		  errors.splice(index, 1);   
		  $('#zip').removeClass('details-error');
		  console.log('removing');
		}
	}else{
		addOneError('zip');
		console.log('not removing');
	}
	
	
	if(event.target.id === 'country' || last_selected_country != $('#country').val()){
		last_selected_country = $('#country').val();
			//Zip required?...
		if(!postalCodeRequired($('#country').val()) || $('#zip').val() != ''){
			var index = errors.indexOf('zip');
			if (index !== -1) {
			  errors.splice(index, 1);   
			  $('#zip').removeClass('details-error');
			}
		}else{
			addOneError(event.target.id);
		}
	   
		
	}	

	//Remove country errors if it's not empty...On autocomplete for eg. 
	if($('#country').val()!=''){  
		var index = errors.indexOf('country');
		if (index !== -1) {
			errors.splice(index, 1);   
			$('#country').removeClass('details-error');
		}
	}
	
	
	if(errors.length === 0 && inputsFilled()){
	
	}else{ 
	  
	}	
		
	//Save user input        
	var inputJSON = {
		"action":"form",  
		"fname":$("#fname").val(),
		"lname":$("#lname").val(),
		"email":$("#email").val(),
		"address1":$("#address1").val(),
		"address2":$("#address2").val(),
		"city":$("#city").val(),
		"state":$("#state").val(),
		"zip":$("#zip").val(),
		"country":$("#country").val()          
	};
	
	saveuserforms(inputJSON); 
       
}

// Build formData object.
let createOrderFormData = new FormData();
createOrderFormData.append('action', 'create_order');

// Build formData object.
let createCaptureFormData = new FormData();
createCaptureFormData.append('action', 'capture');

// Render the PayPal button into #paypal-button-container
paypal.Buttons({
	// onInit is called when the button first renders
    onInit: function(data, actions)  {

		// Disable the buttons
		actions.disable();
		// Enable or disable the button when it is checked or unchecked
		if (inputsFilled())  {
			console.log('enabling');
			actions.enable();
		}

     	$('body').on('keyup change input cut paste','#fname,#lname,#email,#address1,#address2,#city,#state,#zip,#country',function(event){	

			// Enable or disable the button when it is checked or unchecked
			if (inputsFilled())  {
				console.log('enabling');
				actions.enable();
			} else  {
				console.log('disabling');
				actions.disable();
			}   
     	});   
    },
	

	// Call your server to set up the transaction
	createOrder: function(data, actions) {

		return fetch('/process.php', {
			body: createOrderFormData,
			method: 'post'
		}).then(function(res) {
			return res.json();
		}).then(function(orderData) {
			return orderData.id;
		});
	},

	// Call your server to finalize the transaction
	onApprove: function(data, actions) {
		$('body').append('<div id="lightbox">Please wait your order is being processed...<p>');
		//Add a the order id for payment capture
		createCaptureFormData.append('order_id', data.orderID); 
		return fetch('/process.php', {
			
			body: createCaptureFormData,
			method: 'post'
		}).then(function(res) {
			return res.json();
		}).then(function(orderData) {
			// Three cases to handle:
			//   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
			//   (2) Other non-recoverable errors -> Show a failure message
			//   (3) Successful transaction -> Show confirmation or thank you

			// This example reads a v2/checkout/orders capture response, propagated from the server
			// You could use a different API or structure for your 'orderData'
			var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

			if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
				return actions.restart(); // Recoverable state, per:
				// https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
			}

			if (errorDetail) {
				var msg = 'Sorry, your transaction could not be processed.';
				if (errorDetail.description){ msg += '\n\n' + errorDetail.description;
				}
				if (orderData.debug_id){ msg += ' (' + orderData.debug_id + ')';
				}
				$('#lightbox').remove();
				return alert(msg); // Show a failure message
			}

			// Show a success message
		 //   alert('Transaction completed by ' + orderData.payer.name.given_name);
			window.location.pathname = '/success';
			
		});
	}

}).render('#paypal-button-container');
        

	//Send ping to refresh session
	function fetchdata(){
		$.ajax({
			url: '/process.php',
			type: 'post',
			data: {
			"action":"ping"  
			},
			success: function(response){
			// Perform operation on the return value	  
			}
		});
	}
	setInterval(fetchdata,50000);
}






/*





*/
    











/* Check the availability of the Payment Request API first.
paymentRequest.canMakePayment().then(function(result) {
  if (result) {
    prButton.mount('#payment-request-button');
  } else {
    document.getElementById('payment-request-button').style.display = 'none';
  }
});
console.log('loaded');
*/





