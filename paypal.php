<?php 
	session_start();
?><!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=viewport content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous"> 
<link rel="preload" as="style" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin> 
<script defer src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script defer src="payments-simple.js?v=1"></script>
</head>
<body>



<?php 
	//Set Price
	$_SESSION['fee'] = 1;
  
    $countries["AL"]="Albania";
    $countries["DZ"]="Algeria";
    $countries["AD"]="Andorra";
    $countries["AO"]="Angola";
    $countries["AI"]="Anguilla";
    $countries["AQ"]="Antarctica";
    $countries["AG"]="Antigua and Barbuda";
    $countries["AR"]="Argentina";
    $countries["AM"]="Armenia";
    $countries["AW"]="Aruba";
    $countries["AU"]="Australia";
    $countries["AT"]="Austria";
    $countries["AZ"]="Azerbaijan";
    $countries["BS"]="Bahamas";
    $countries["BH"]="Bahrain";
    $countries["BB"]="Barbados";
    $countries["BY"]="Belarus";
    $countries["BE"]="Belgium";
    $countries["BZ"]="Belize";
    $countries["BJ"]="Benin";
    $countries["BM"]="Bermuda";
    $countries["BT"]="Bhutan";
    $countries["BO"]="Bolivia, Plurinational State of";
    $countries["BA"]="Bosnia and Herzegovina";
    $countries["BW"]="Botswana";
    $countries["BR"]="Brazil";
    $countries["VG"]="British Virgin Islands";
    $countries["BN"]="Brunei Darussalam";
    $countries["BG"]="Bulgaria";
    $countries["BF"]="Burkina Faso";
    $countries["BI"]="Burundi";
    $countries["KH"]="Cambodia";
    $countries["CM"]="Cameroon";
    $countries["CA"]="Canada";
    $countries["CV"]="Cape Verde";
    $countries["KY"]="Cayman Islands";
    $countries["TD"]="Chad";
    $countries["CL"]="Chile";
    $countries["C2"]="China";
    $countries["CO"]="Colombia";
    $countries["KM"]="Comoros";
    $countries["CG"]="Congo - Brazzaville";
    $countries["CD"]="Congo - Kinshasha";
    $countries["CK"]="Cook Islands";
    $countries["CR"]="Costa Rica";
    $countries["CI"]="C么te d'Ivoire";
    $countries["HR"]="Croatia";
    $countries["CY"]="Cyprus";
    $countries["CZ"]="Czech Republic";
    $countries["DK"]="Denmark";
    $countries["DJ"]="Djibouti";
    $countries["DM"]="Dominica";
    $countries["DO"]="Dominican Republic";
    $countries["EC"]="Ecuador";
    $countries["EG"]="Egypt";
    $countries["SV"]="El Salvador";
    $countries["ER"]="Eritrea";
    $countries["EE"]="Estonia";
    $countries["ET"]="Ethiopia";
    $countries["FK"]="Falkland Islands (Malvinas)";
    $countries["FO"]="Faroe Islands";
    $countries["FJ"]="Fiji";
    $countries["FI"]="Finland";
    $countries["FR"]="France";
    $countries["GF"]="French Guiana";
    $countries["PF"]="French Polynesia";
    $countries["GA"]="Gabon";
    $countries["GM"]="Gambia";
    $countries["GE"]="Georgia";
    $countries["DE"]="Germany";
    $countries["GI"]="Gibraltar";
    $countries["GR"]="Greece";
    $countries["GL"]="Greenland";
    $countries["GD"]="Grenada";
    $countries["GP"]="Guadeloupe";
    $countries["GT"]="Guatemala";
    $countries["GN"]="Guinea";
    $countries["GW"]="Guinea-Bissau";
    $countries["GY"]="Guyana";
    $countries["HN"]="Honduras";
    $countries["HK"]="Hong Kong";
    $countries["HU"]="Hungary";
    $countries["IS"]="Iceland";
    $countries["IN"]="India";
    $countries["ID"]="Indonesia";
    $countries["IE"]="Ireland";
    $countries["IL"]="Israel";
    $countries["IT"]="Italy";
    $countries["JM"]="Jamaica";
    $countries["JP"]="Japan";
    $countries["JO"]="Jordan";
    $countries["KZ"]="Kazakhstan";
    $countries["KE"]="Kenya";
    $countries["KI"]="Kiribati";
    $countries["KW"]="Kuwait";
    $countries["KG"]="Kyrgyzstan";
    $countries["LA"]="Lao People's Democratic Republic";
    $countries["LV"]="Latvia";
    $countries["LS"]="Lesotho";
    $countries["LI"]="Liechtenstein";
    $countries["LT"]="Lithuania";
    $countries["LU"]="Luxembourg";
    $countries["MK"]="Macedonia, the former Yugoslav Republic of";
    $countries["MG"]="Madagascar";
    $countries["MW"]="Malawi";
    $countries["MY"]="Malaysia";
    $countries["MV"]="Maldives";
    $countries["ML"]="Mali";
    $countries["MT"]="Malta";
    $countries["MH"]="Marshall Islands";
    $countries["MQ"]="Martinique";
    $countries["MR"]="Mauritania";
    $countries["MU"]="Mauritius";
    $countries["YT"]="Mayotte";
    $countries["MX"]="Mexico";
    $countries["FM"]="Micronesia, Federated States of";
    $countries["MD"]="Moldova, Republic of";
    $countries["MC"]="Monaco";
    $countries["MN"]="Mongolia";
    $countries["ME"]="Montenegro";
    $countries["MS"]="Montserrat";
    $countries["MA"]="Morocco";
    $countries["MZ"]="Mozambique";
    $countries["NA"]="Namibia";
    $countries["NR"]="Nauru";
    $countries["NP"]="Nepal";
    $countries["NL"]="Netherlands";
    $countries["NC"]="New Caledonia";
    $countries["NZ"]="New Zealand";
    $countries["NI"]="Nicaragua";
    $countries["NE"]="Niger";
    $countries["NG"]="Nigeria";
    $countries["NU"]="Niue";
    $countries["NF"]="Norfolk Island";
    $countries["NO"]="Norway";
    $countries["OM"]="Oman";
    $countries["PW"]="Palau";
    $countries["PA"]="Panama";
    $countries["PG"]="Papua New Guinea";
    $countries["PY"]="Paraguay";
    $countries["PE"]="Peru";
    $countries["PH"]="Philippines";
    $countries["PN"]="Pitcairn";
    $countries["PL"]="Poland";
    $countries["PT"]="Portugal";
    $countries["QA"]="Qatar";
    $countries["RE"]="R茅union";
    $countries["RO"]="Romania";
    $countries["RU"]="Russia";
    $countries["RW"]="Rwanda";
    $countries["KN"]="Saint Kitts and Nevis";
    $countries["LC"]="Saint Lucia";
    $countries["PM"]="Saint Pierre and Miquelon";
    $countries["VC"]="Saint Vincent and the Grenadines";
    $countries["WS"]="Samoa";
    $countries["SM"]="San Marino";
    $countries["ST"]="Sao Tome and Principe";
    $countries["SA"]="Saudi Arabia";
    $countries["SN"]="Senegal";
    $countries["RS"]="Serbia";
    $countries["SC"]="Seychelles";
    $countries["SL"]="Sierra Leone";
    $countries["SG"]="Singapore";
    $countries["SK"]="Slovakia";
    $countries["SI"]="Slovenia";
    $countries["SB"]="Solomon Islands";
    $countries["SO"]="Somalia";
    $countries["ZA"]="South Africa";
    $countries["KR"]="South Korea";
    $countries["ES"]="Spain";
    $countries["LK"]="Sri Lanka";
    $countries["SR"]="Suriname";
    $countries["SJ"]="Svalbard and Jan Mayen";
    $countries["SZ"]="Swaziland";
    $countries["SE"]="Sweden";
    $countries["CH"]="Switzerland";
    $countries["TW"]="Taiwan, Province of China";
    $countries["TJ"]="Tajikistan";
    $countries["TZ"]="Tanzania, United Republic of";
    $countries["TH"]="Thailand";
    $countries["TG"]="Togo";
    $countries["TO"]="Tonga";
    $countries["TT"]="Trinidad and Tobago";
    $countries["TN"]="Tunisia";
    $countries["TM"]="Turkmenistan";
    $countries["TC"]="Turks and Caicos Islands";
    $countries["TV"]="Tuvalu";
    $countries["UG"]="Uganda";
    $countries["UA"]="Ukraine";
    $countries["AE"]="United Arab Emirates";
    $countries["GB"]="United Kingdom";
    $countries["US"]="United States";
    $countries["UY"]="Uruguay";
    $countries["UZ"]="Uzbekistan";
    $countries["VU"]="Vanuatu";
    $countries["VA"]="Vatican City";
    $countries["VE"]="Venezuela, Bolivarian Republic of";
    $countries["VN"]="Viet Nam";
    $countries["WF"]="Wallis and Futuna";
    $countries["YE"]="Yemen";
    $countries["ZM"]="Zambia";
    $countries["ZW"]="Zimbabwe";
    
    function selectedCountry($countries,$selected=''){
		$allOut = "";	
		foreach($countries as $code => $country){
			$out = '<option ';
				if(@$selected == $code){
					$out.="selected";
				}
			$out.=' value="'.$code.'">';
			$out.=$country . '</option>';  
			$allOut.= $out;			
		 }
		 return $allOut;
	}	
?>
<?php 
    function selectedState($states,$selected=''){
		$allOut = "";	
		foreach($states as $code => $state){
			$out = '<option ';
				if(@$selected == $code){
					$out.="selected";
				}
			$out.=' value="'.$code.'">';
			$out.=$state . '</option>';  
			$allOut.= $out;			
		 }
		 return $allOut;
	}	


?>




 <div class="container">
	<form method="post" id="payment-form">   
      <div class="row cell example example4">

        <div class="col-md-6">
               <div class="container">
              
           <h3> Enter Your Details </h3>
            <br>
         <div class="form-control-label">
                <label for="fname">First Name</label>
                <input id="fname" name="fname" class="input form-control" type="text" placeholder="Jane" required autocomplete="given-name" value="<?php echo (isset($user_inputs['fname'])?$user_inputs['fname']:''); ?>">
              </div>
        <div class="form-control-label">
                <label for="lname">Last Name</label>
                <input id="lname" name="lname" class="input form-control" type="text" placeholder="Doe" required autocomplete="family-name" value="<?php echo (isset($user_inputs['lname'])?$user_inputs['lname']:''); ?>">
              </div>        
     
              <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" data-tid="elements_examples.form.email_placeholder" class="input form-control text-lowercase" type="text" placeholder="janedoe@gmail.com" required autocomplete="email"  value="<?php echo (isset($user_inputs['email'])?$user_inputs['email']:''); ?>">
              </div>
    <!--         -->
		 
<label class="form-control-label" for="country">Country 
<select autocomplete="country" class="form-control" id="country" name="country" placeholder="Required" title="Country">
    <option value=''>Select Country</option>
<?php
echo selectedCountry($countries,(isset($user_inputs['country'])?$user_inputs['country']:''));
?>

</select>
</label> 
		 
		 
<label class="form-control-label" for="address1">Street Address 
	<input autocomplete="address-line1" class="form-control" id="address1" name="address1" placeholder="Required" title="Street Address 1" type="text" value="<?php echo (isset($user_inputs['address1'])?$user_inputs['address1']:''); ?>" />
</label> 
		 
<label class="form-control-label" for="address2">Apt. / Suite # 
	<input autocomplete="address-line2 address-level1" class="form-control" id="address2" name="address2" placeholder="Optional" title="Street Address 2" type="text" value="<?php echo (isset($user_inputs['address2'])?$user_inputs['address2']:''); ?>" />
</label> 

<label class="form-control-label" for="city">City 
	<input autocomplete="locality" class="form-control" id="city" name="city" placeholder="Required" title="City" type="text" value="<?php echo (isset($user_inputs['city'])?$user_inputs['city']:''); ?>" />
</label> 

<label class="form-control-label" for="state">State / Province
	<input  autocomplete="shipping region" class="form-control" id="state" name="state" placeholder="Required" title="State" type="text" maxlength="2" value="<?php echo (isset($user_inputs['state'])?$user_inputs['state']:''); ?>" />
</label> 

<label class="form-control-label" for="zip">Zip 
	<input autocomplete="postal-code" class="form-control" id="zip" name="zip" placeholder="If Required" title="Zip/Postal" type="text" value="<?php echo (isset($user_inputs['zip'])?$user_inputs['zip']:''); ?>" />
</label> 



<br />

  
        <div id="input-error">Please complete all of the required fields.</div>
             </div>
        </div>
        <div id="payment-details" class="col-md-6">
 
   
        <div class="container">
         <h3> Bill for $<?php echo @$_SESSION['fee'] ?> USD</h3>
  
     
<hr>
             



    <div id="paypal-button-container" class="container"></div>
     </div>  

   </div>
	 </form>
</div>

<script 
    src="https://www.paypal.com/sdk/js?client-id=SB_CLIENT_ID&currency=USD&disable-funding=paylater"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>

<style>
.loading{display:none;margin: -4px 0 0 0;} 

#address-form .form-group{margin-bottom:0px;}


#lightbox {
    position:fixed; /* keeps the lightbox window in the current viewport */
    top:0; 
    left:0; 
    width:100%; 
    height:100%; 
    background:rgba(0,0,0,.4); 
	text-align:center;
	z-index:3000;
	color:#ddd;
	font-size:50px;
}


input#agreed{
    position: relative;

     -webkit-appearance: checkbox !important;
     -moz-appearance: checkbox !important;
     -ms-appearance: checkbox !important;
     -o-appearance: checkbox !important;
     appearance: checkbox !important;

}
span#terms{font-weight:bold;text-decoration:underline;color:blue;cursor: pointer;}



.text-lowercase {
    text-transform:lowercase;
}


.saving{
     pointer-events: none;   
}


.details-error{border-bottom: 1px solid #dc3545 !important;}
#stopper{position:relative;}
#blocker.blocking{
position: absolute;
    width: 100%;
    height: 40px;
    z-index: 100;  
}
#input-error{display:none;}
</style>
 
</body>
<html>