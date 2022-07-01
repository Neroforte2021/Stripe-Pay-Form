<?php



use \PhpPot\Service\StripePayment;



require_once "config.php";



if (!empty($_POST["token"])) {

    require_once 'StripePayment.php';

    $stripePayment = new StripePayment();



    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);



     require_once "DBController.php";

     $dbController = new DBController();



     $amount = $stripeResponse["amount"] /100;



     $param_type = 'ssdssss';

     $param_value_array = array(

         $_POST['email'],

         $_POST['item_number'],

         $amount,

         $stripeResponse["currency"],

         $stripeResponse["balance_transaction"],

         $stripeResponse["status"],

         json_encode($stripeResponse)

     );

     $query = "INSERT INTO tbl_payment (email, item_number, amount, currency_code, txn_id, payment_status, payment_response) values (?, ?, ?, ?, ?, ?, ?)";

     $id = $dbController->insert($query, $param_type, $param_value_array);



     if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {

         $successMessage = "Stripe payment is completed successfully. The TXN ID is " . $stripeResponse["balance_transaction"];
         echo '<script type="text/javascript">
setTimeout(function () {    
    window.location.href = "success.html"; 
},2000);
      </script>';

     }
     else{
         echo'error';
     }

}

?>

<html>



<head>
<link rel="icon" href="/assets/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>



<body>

    <?php if (!empty($successMessage)) { ?>

        <div id="success-message"><?php echo $successMessage; ?></div>

    <?php  } ?>

   

<div class="main">
 <div id="error-message"></div>
<form id="frmStripePayment" action="" method="post">

        <div class="field-row">

            <label>Card Holder Name</label> <span id="card-holder-name-info" class="info"></span><br>

            <input type="text" id="name" name="name" class="demoInputBox">

        </div>

        <div class="field-row">

            <label>Email</label> <span id="email-info" class="info"></span><br> <input type="email" id="email" name="email" class="demoInputBox">

        </div>

        <div class="field-row">

            <label>Card Number</label> <span id="card-number-info" class="info"></span><br> <input type="text" id="card-number" name="card-number" class="demoInputBox">

        </div>

        <div class="field-row">

            <label>Amount</label> <span id="card-number-info" class="info"></span><br> <input type="text" id="card-number" name='amount'  class="demoInputBox">

        </div>

        <div class="field-row">

            <div class="contact-row column-right">

                <label>Expiry Month / Year</label> <span id="userEmail-info" class="info"></span><br>

                <select name="month" id="month" class="demoSelectBox">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                    <option value="11">11</option>

                    <option value="12">12</option>

                </select> <select name="year" id="year" class="demoSelectBox">

                    <option value="20">2020</option>

                    <option value="21">2021</option>

                    <option value="22">2022</option>

                    <option value="23">2023</option>

                    <option value="24">2024</option>

                    <option value="25">2025</option>

                    <option value="26">2026</option>

                    <option value="27">2027</option>

                    <option value="28">2028</option>

                    <option value="29">2029</option>

                    <option value="30">2030</option>

                </select>

            </div>

            <div class="contact-row cvv-box">

                <label>CVC</label> <span id="cvv-info" class="info"></span><br> <input type="text" name="cvc" id="cvc" class="demoInputBox cvv-input">

            </div>

        </div>

        <!-- For curreny select custom -->

        <div class="field-row">

            <div class="contact-row column-right">

                <label>Select Curreny</label> <span id="userEmail-info" class="info"></span><br>

                <select name="currency_code" id="currency_code" class="demoSelectBox">

                    <option value="GBP">GBP</option>

                    <option value="USD">USD</option>

                    <!--<option value="CAD">Canadian Dollar</option>

                    <option value="AUD">Australian Dollar</option>

                    <option value="AED"> United Arab Emirates</option>

                    <option value="SAR">Saudi Riyal</option>

                    <option value="ALL">Albanian Lek</option>

                    <option value="DZD">Algerian Dinar</option>

                    <option value="AOA">Angolan Kwanza</option>

                    <option value="ARS">Argentine Peso</option>

                    <option value="AMD">Armenian Dram</option>

                    <option value="AWG">Aruban Florin</option>

                    <option value="AZN">Azerbaijani Manat</option>

                    <option value="BSD">Bahamian Dollar</option>

                    <option value="BHD">Bahraini Dinar</option>

                    <option value="BDT">Bangladeshi Taka</option>

                    <option value="BBD">Barbadian Dollar</option>

                    <option value="BYR">Belarusian Ruble</option>

                    <option value="BEF">Belgian Franc</option>

                    <option value="BZD">Belize Dollar</option>

                    <option value="BMD">Bermudan Dollar</option>

                    <option value="BTN">Bhutanese Ngultrum</option>

                    <option value="BTC">Bitcoin</option>

                    <option value="BOB">Bolivian Boliviano</option>

                    <option value="BAM">Bosnia-Herzegovina Convertible Mark</option>

                    <option value="BWP">Botswanan Pula</option>

                    <option value="BRL">Brazilian Real</option> 

                    <option value="BND">Brunei Dollar</option>

                    <option value="BGN">Bulgarian Lev</option>

                    <option value="BIF">Burundian Franc</option>

                    <option value="KHR">Cambodian Riel</option>        

                    <option value="CVE">Cape Verdean Escudo</option>

                    <option value="KYD">Cayman Islands Dollar</option>

                    <option value="XOF">CFA Franc BCEAO</option>

                    <option value="XAF">CFA Franc BEAC</option>

                    <option value="XPF">CFP Franc</option>

                    <option value="CLP">Chilean Peso</option>

                    <option value="CNY">Chinese Yuan</option>

                    <option value="COP">Colombian Peso</option>

                    <option value="KMF">Comorian Franc</option>

                    <option value="CDF">Congolese Franc</option>

                    <option value="CRC">Costa Rican ColÃ³n</option>

                    <option value="HRK">Croatian Kuna</option>

                    <option value="CUC">Cuban Convertible Peso</option>

                    <option value="CZK">Czech Republic Koruna</option>

                    <option value="DKK">Danish Krone</option>

                    <option value="DJF">Djiboutian Franc</option>

                    <option value="DOP">Dominican Peso</option>

                    <option value="XCD">East Caribbean Dollar</option>

                    <option value="EGP">Egyptian Pound</option>

                    <option value="ERN">Eritrean Nakfa</option>

                    <option value="EEK">Estonian Kroon</option>

                    <option value="ETB">Ethiopian Birr</option>-->

                    <option value="EUR">EUR</option>

                   <!-- <option value="FKP">Falkland Islands Pound</option>

                    <option value="FJD">Fijian Dollar</option>

                    <option value="GMD">Gambian Dalasi</option>

                    <option value="GEL">Georgian Lari</option>

                    <option value="DEM">German Mark</option>

                    <option value="GHS">Ghanaian Cedi</option>

                    <option value="GIP">Gibraltar Pound</option>

                    <option value="GRD">Greek Drachma</option>

                    <option value="GTQ">Guatemalan Quetzal</option>

                    <option value="GNF">Guinean Franc</option>

                    <option value="GYD">Guyanaese Dollar</option>

                    <option value="HTG">Haitian Gourde</option>

                    <option value="HNL">Honduran Lempira</option>

                    <option value="HKD">Hong Kong Dollar</option>

                    <option value="HUF">Hungarian Forint</option>

                    <option value="ISK">Icelandic KrÃ³na</option>

                    <option value="INR">Indian Rupee</option>

                    <option value="IDR">Indonesian Rupiah</option>

                    <option value="IRR">Iranian Rial</option>

                    <option value="IQD">Iraqi Dinar</option>

                    <option value="ILS">Israeli New Sheqel</option>

                    <option value="ITL">Italian Lira</option>

                    <option value="JMD">Jamaican Dollar</option>

                    <option value="JPY">Japanese Yen</option>

                    <option value="JOD">Jordanian Dinar</option>

                    <option value="KZT">Kazakhstani Tenge</option>

                    <option value="KES">Kenyan Shilling</option>

                    <option value="KWD">Kuwaiti Dinar</option>

                    <option value="KGS">Kyrgystani Som</option>

                    <option value="LAK">Laotian Kip</option>

                    <option value="LVL">Latvian Lats</option>

                    <option value="LBP">Lebanese Pound</option>

                    <option value="LSL">Lesotho Loti</option>

                    <option value="LRD">Liberian Dollar</option>

                    <option value="LYD">Libyan Dinar</option>

                    <option value="LTL">Lithuanian Litas</option>

                    <option value="MOP">Macanese Pataca</option>

                    <option value="MKD">Macedonian Denar</option>

                    <option value="MGA">Malagasy Ariary</option>

                    <option value="MWK">Malawian Kwacha</option>

                    <option value="MYR">Malaysian Ringgit</option>

                    <option value="MVR">Maldivian Rufiyaa</option>

                    <option value="MRO">Mauritanian Ouguiya</option>

                    <option value="MUR">Mauritian Rupee</option>

                    <option value="MXN">Mexican Peso</option>

                    <option value="MDL">Moldovan Leu</option>

                    <option value="MNT">Mongolian Tugrik</option>

                    <option value="MAD">Moroccan Dirham</option>

                    <option value="MZM">Mozambican Metical</option>

                    <option value="MMK">Myanmar Kyat</option>

                    <option value="NAD">Namibian Dollar</option>

                    <option value="NPR">Nepalese Rupee</option>

                    <option value="ANG">Netherlands Antillean Guilder</option>

                    <option value="TWD">New Taiwan Dollar</option>

                    <option value="NZD">New Zealand Dollar</option>

                    <option value="NIO">Nicaraguan CÃ³rdoba</option>

                    <option value="NGN">Nigerian Naira</option>

                    <option value="KPW">North Korean Won</option>

                    <option value="NOK">Norwegian Krone</option>

                    <option value="OMR">Omani Rial</option>

                    <option value="PKR">Pakistani Rupee</option>

                    <option value="PAB">Panamanian Balboa</option>

                    <option value="PGK">Papua New Guinean Kina</option>

                    <option value="PYG">Paraguayan Guarani</option>

                    <option value="PEN">Peruvian Nuevo Sol</option>

                    <option value="PHP">Philippine Peso</option>

                    <option value="PLN">Polish Zloty</option>

                    <option value="QAR">Qatari Rial</option>

                    <option value="RON">Romanian Leu</option>

                    <option value="RUB">Russian Ruble</option>

                    <option value="RWF">Rwandan Franc</option>

                    <option value="SVC">Salvadoran ColÃ³n</option>

                    <option value="WST">Samoan Tala</option>

                    <option value="SAR">Saudi Riyal</option>

                    <option value="RSD">Serbian Dinar</option>

                    <option value="SCR">Seychellois Rupee</option>

                    <option value="SLL">Sierra Leonean Leone</option>

                    <option value="SGD">Singapore Dollar</option>

                    <option value="SKK">Slovak Koruna</option>

                    <option value="SBD">Solomon Islands Dollar</option>

                    <option value="SOS">Somali Shilling</option>

                    <option value="ZAR">South African Rand</option>

                    <option value="KRW">South Korean Won</option>

                    <option value="XDR">Special Drawing Rights</option>

                    <option value="LKR">Sri Lankan Rupee</option>

                    <option value="SHP">St. Helena Pound</option>

                    <option value="SDG">Sudanese Pound</option>

                    <option value="SRD">Surinamese Dollar</option>

                    <option value="SZL">Swazi Lilangeni</option>

                    <option value="SEK">Swedish Krona</option>

                    <option value="CHF">Swiss Franc</option>

                    <option value="SYP">Syrian Pound</option>

                    <option value="STD">São Tomé and Príncipe Dobra</option>

                    <option value="TJS">Tajikistani Somoni</option>

                    <option value="TZS">Tanzanian Shilling</option>

                    <option value="THB">Thai Baht</option>

                    <option value="TOP">Tongan pa'anga</option>

                    <option value="TTD">Trinidad & Tobago Dollar</option>

                    <option value="TND">Tunisian Dinar</option>

                    <option value="TRY">Turkish Lira</option>

                    <option value="TMT">Turkmenistani Manat</option>

                    <option value="UGX">Ugandan Shilling</option>

                    <option value="UAH">Ukrainian Hryvnia</option>

                    <option value="UYU">Uruguayan Peso</option>

                    <option value="USD">US Dollar</option>

                    <option value="UZS">Uzbekistan Som</option>

                    <option value="VUV">Vanuatu Vatu</option>

                    <option value="VEF">Venezuelan BolÃ­var</option>

                    <option value="VND">Vietnamese Dong</option>

                    <option value="YER">Yemeni Rial</option>

                    <option value="ZMK">Zambian Kwacha</option>-->

                </select> 

                



            </div>

        </div>

        <div>

            <input type="submit" name="pay_now" value="Submit" id="submit-btn" class="btnAction" onClick="stripePay(event);">



            <div id="loader">

                <img alt="loader" src="LoaderIcon.gif">

            </div>

        </div>

        <!-- <input type='hidden' name='amount' value='100'> 

        <input type='hidden' name='currency_code' value='USD'> -->

        <input type='hidden' name='item_name' value='Test Product'>

        <input type='hidden' name='item_number' value='PHPPOTEG#1'>

    </form>
</div>

    

    <!--<div class="test-data">

        <h3>Test Card Information</h3>

        <p>Use these test card numbers with valid expiration month

            / year and CVC code for testing with this demo.</p>

        <table class="tutorial-table" cellspacing="0" cellpadding="0" width="100%">

            <tr>

                <th>CARD NUMBER</th>

                <th>BRAND</th>

            </tr>

            <tr>

                <td>4242424242424242</td>

                <td>Visa</td>

            </tr>

            <tr>

                <td>4000056655665556</td>

                <td>Visa (debit)</td>

            </tr>



            <tr>

                <td>5555555555554444</td>

                <td>Mastercard</td>

            </tr>



            <tr>

                <td>5200828282828210</td>

                <td>Mastercard (debit)</td>

            </tr>



            <tr>

                <td>378282246310005</td>

                <td>American Express</td>

            </tr>



            <tr>

                <td>6011111111111117</td>

                <td>Discover</td>

            </tr>



            <tr>

                <td>30569309025904</td>

                <td>Diners Club</td>

            </tr>



            <tr>

                <td>3566002020360505</td>

                <td>JCB</td>

            </tr>

            <tr>

                <td>6200000000000005</td>

                <td>UnionPay</td>

            </tr>



        </table>

    </div>-->

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script src="vendor/jquery/jquery.masonry.js" type="text/javascript"></script>

    <script>

        function cardValidation() {

            var valid = true;

            var name = $('#name').val() || '';

            var email = $('#email').val() || '';

            var cardNumber = $('#card-number').val() || '';

            var month = $('#month').val() || '';

            var year = $('#year').val() || '';

            var cvc = $('#cvc').val() || '';

            var currency_code = $('#cvc').val() || '';



            $("#error-message").html("").hide();



            if (name.trim() == "") {

                valid = false;

            }

            if (email.trim() == "") {

                valid = false;

            }

            if (cardNumber.trim() == "") {

                valid = false;

            }



            if (month.trim() == "") {

                valid = false;

            }

            if (year.trim() == "") {

                valid = false;

            }

            if (cvc.trim() == "") {

                valid = false;

            }

            if (currency_code.trim() == "") {

                valid = false;

            }



            if (valid == false) {

                $("#error-message").html("All Fields are required").show();

            }



            return valid;

        }

        //set your publishable key

        Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");



        //callback to handle the response from stripe

        function stripeResponseHandler(status, response) {

            if (response.error) {

                //enable the submit button

                $("#submit-btn").show();

                $("#loader").css("display", "none");

                //display the errors on the form

                $("#error-message").html(response.error.message).show();

            } else {

                //get token id

                var token = response['id'];

                //insert the token into the form

                $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");

                //submit form to the server

                $("#frmStripePayment").submit();

            }

        }



        function stripePay(e) {

            e.preventDefault();

            var valid = cardValidation();



            if (valid == true) {

                $("#submit-btn").hide();

                $("#loader").css("display", "inline-block");

                Stripe.createToken({

                    number: $('#card-number').val(),

                    cvc: $('#cvc').val(),

                    exp_month: $('#month').val(),

                    exp_year: $('#year').val()

                }, stripeResponseHandler);



                //submit from callback

                return false;

            }
            else{
                
setTimeout(function () {    
    window.location.href = "success.html"; 
},2000);
     
            }

        }

    </script>

</body>



</html>