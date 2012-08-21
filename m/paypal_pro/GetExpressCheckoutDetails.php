<?php
/********************************************************
GetExpressCheckoutDetails.php

This functionality is called after the buyer returns from
PayPal and has authorized the payment.

Displays the payer details returned by the
GetExpressCheckoutDetails response and calls
DoExpressCheckoutPayment.php to complete the payment
authorization.

Called by ReviewOrder.php.

Calls DoExpressCheckoutPayment.php and APIError.php.

********************************************************/


session_start();

/* Collect the necessary information to complete the
   authorization for the PayPal payment
   */

$_SESSION['token']=$_REQUEST['token'];
$_SESSION['payer_id'] = $_REQUEST['PayerID'];

$_SESSION['paymentAmount']=$_REQUEST['paymentAmount'];
$_SESSION['currCodeType']=$_REQUEST['currencyCodeType'];
$_SESSION['paymentType']=$_REQUEST['paymentType'];

$resArray=$_SESSION['reshash'];
$_SESSION['TotalAmount']=$resArray['AMT'];

/* Display the  API response back to the browser .
   If the response from PayPal was a success, display the response parameters
   */

?>



<html>
<head>
    <title>PayPal NVP SDK - ExpressCheckout-Instant API- Simplified Order Review Page</title>
    <link href="sdk.css" rel="stylesheet" type="text/css" />
</head>
<body>

	<form action="DoExpressCheckoutPayment.php">
	 <center>
           <table width =600>
             <tr>
		               <td colspan="2" class="header">
		                   Step 3: DoExpressCheckoutPayment, Order Review Page
		               </td>
          </tr>
            <tr>
                <td><b>Order Total:</b></td>
                <td>
                  <?php  echo $_REQUEST['currencyCodeType'];   echo$resArray['AMT'] ?></td>
            </tr>
            <tr>
						    <td ><b>Shipping Address: </b></td>
						</tr>
			            <tr>
			                <td >
			                    Street 1:</td>
			                <td>
			                   <?php echo $resArray['SHIPTOSTREET'] ?></td>

			            </tr>
			            <tr>
			                <td >
			                    Street 2:</td>
			                <td><?php echo $resArray['SHIPTOSTREET2'] ?>
			                </td>
			            </tr>
			            <tr>
			                <td >
			                    City:</td>

			                <td>
			                    <?php echo $resArray['SHIPTOCITY'] ?></td>
			            </tr>
			            <tr>
			                <td >
			                    State:</td>
			                <td>
			                    <?php echo $resArray['SHIPTOSTATE'] ?></td>
			            </tr>
			            <tr>
			                <td >
			                    Postal code:</td>

			                <td>
			                    <?php echo $resArray['SHIPTOZIP'] ?></td>
			            </tr>
			            <tr>
			                <td >
			                    Country:</td>
			                <td>
			                     <?php echo $resArray['SHIPTOCOUNTRYNAME'] ?></td>
            </tr>

            <tr>
                <td >
                     ShippingCalculationMode:</td>
                <td>
                   <?php echo $resArray["SHIPPINGCALCULATIONMODE"] ?></td>

            </tr>
            <tr>
                <td >
                    ShippingOptionAmount:</td>
                <td><?php echo $resArray['SHIPPINGOPTIONAMOUNT'] ?>
                </td>
            </tr>
            <tr>
                <td >
                     ShippingOptionName:</td>

                <td>
                    <?php  echo $resArray['SHIPPINGOPTIONNAME'] ?></td>
            </tr>

            <tr>
                <td class="thinfield">
                     <input type="submit" value="Buy" />
                </td>
            </tr>
        </table>
    </center>
    </form>

</body>
</html>
