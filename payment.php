<?php

/**
 * This is a sample code for manual integration with QlicknPay
 * It is so simple that you can do it in a single file
 * Make sure that in QlicknPay Dashboard you have key in the return URL referring to this file
 */

# please fill in the required info as below
$merchant_id = '10512'; // this refers to your Merchant ID that can be obtain from QlicknPay
$api = '5DjIByCEjXhU'; // API key


# this part is to process data from the form that user key in, make sure that all of the info is passed so that we can process the payment
if (isset($_POST['amount']) && isset($_POST['invoice']) && isset($_POST['payment_desc'])) {

    # assuming all of the data passed is correct and no validation required. Preferably you will need to validate the data passed
    $hashed_string = md5($api . "|" . urldecode($merchant_id) . "|" . urldecode($_POST['invoice']) . "|" . urldecode($_POST['amount']) . "|" . urldecode($_POST['payment_desc']));

    # now we send the data to QlicknPay by using post method

    $QlicknPay_link_sandbox = 'https://www.demo.qlicknpay.com/merchant/api/v1/receiver';
    $QlicknPay_link_live = 'https://www.qlicknpay.com/merchant/api/v1/receiver';

?>
    <html>

    <head>
        <title>QlicknPay Payment Gateway API Sample Code</title>
    </head>

    <body onload="document.order.submit()">
        #Specified the link below either for sandbox or live production
        <form name="order" method="post" action="<?= $QlicknPay_link_live ?>">
            <?php #  REQUIRED FORM START HERE 
            ?>
            <input type="hidden" name="merchant_id" value="<?= $merchant_id; ?>">
            <input type="hidden" name="invoice" value="<?= $_POST['invoice'] ?>">
            <input type="hidden" name="amount" value="<?= $_POST['amount']; ?>">
            <input type="hidden" name="payment_desc" value="<?= $_POST['payment_desc']; ?>">
            <input type="hidden" name="hash" value="<?= $hashed_string; ?>">
            <?php #  REQUIRED FORM END HERE 
            ?>

            <?php #   OPTIONAL FORM START HERE 
            ?>
            <?php #  Set this as null or remove it if you're not required this form. This form will display on payment gateway and save the value in dashboard  
            ?>
            <?php #  Buyer Name 
            ?>
            <input type="hidden" name="buyer_name" value="John">
            <?php #  Buyer Email. Must be valid email address. Buyer will get transaction status through this email 
            ?>
            <input type="hidden" name="buyer_email" value="John@gmail.com">
            <?php #  Buyer Phone number with country code 
            ?>
            <input type="hidden" name="phone" value="+0123456789">
            <?php #  Buyer Address form line 1
            ?>
            <input type="hidden" name="add_line_1" value="10-3, 3rd Floor Jln PJU 5/9">
            <?php #  Buyer Address form line 2
            ?>
            <input type="hidden" name="add_line_2" value="Dataran Sunway Kota Damansara">
            <?php #  Buyer Postcode 
            ?>
            <input type="hidden" name="postcode" value="47810">
            <?php #  Buyer City 
            ?>
            <input type="hidden" name="city" value="Petaling Jaya">
            <?php #  Buyer State 
            ?>
            <input type="hidden" name="state" value="Selangor">
            <?php #  Buyer Comment 
            ?>
            <input type="hidden" name="comment" value="">

            <?php #  Your callback url for backend process. If you already have specified it on your dashboard but want a different url for different process, please include this form. 
            ?>
            <?php #  Your Back-end Process 
            ?>
            <input type="hidden" name="callback_url_be" value="http://localhost/caroma/checkout.php">
            <?php #  Your Front-end Process Success interface 
            ?>
            <input type="hidden" name="callback_url_fe_succ" value="http://localhost/caroma/checkout.php">
            <?php #  Your Front-end Process Fail interface 
            ?>
            <input type="hidden" name="callback_url_fe_fail" value="http://localhost/caroma/checkout.php">

            <?php #  If you required a variable that provide the same value when you return it after transaction, use this baggage form. You can have more than one variable.
            ?>
            <?php # Please seperate each variable and value by using '|'. Please make sure that every form's value below not more than 5000 characters 
            ?>

            <?php #   Custom your payment title and contact. 
            ?>
            <input type="hidden" name="header_title" value="Payment Title">
            <input type="hidden" name="header_email" value="contact@gmail.com">
            <input type="hidden" name="header_phone" value="0123456789">
            <?php #   OPTIONAL FORM END HERE 
            ?>

        </form>
    </body>

    </html>

<?php
} else {
?>

    <html>

    <head>
        <title>QlicknPay Payment Gateway API Sample Code</title>
    </head>

    <body>
        <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF']); ?>">
            <table>
                <tr>
                    <td colspan="2">Please fill up the detail below in order to test the payment.</td>
                </tr>
                <tr>
                    <?php #  AMOUNT VALUE  MUST MORE THAN RM1.50 AND WITH 2 DECIMAL POINTS 
                    ?>
                    <td>Amount</td>
                    <td>: <input type="text" name="amount" value="" placeholder="Amount to pay, for example 12.20" size="30"></td>
                </tr>
                <tr>
                    <?php #   DESCRIPTION MUST BE LESS THAN 1,000 CHARACTERS 
                    ?>
                    <td>Payment Description (Not more than 1,000 character)</td>
                    <td>: <input type="text" name="payment_desc" value="" placeholder="Description of the transaction" size="30"></td>
                </tr>
                <tr>
                    <?php #  MUST BE UNIQUE  
                    ?>
                    <td>Invoice (Not more than 17 char without '-')</td>
                    <td>: <input type="text" name="invoice" value="<?php echo time(); ?>" placeholder="Unique id to reference the transaction or order" size="30"></td>
                </tr>

                <tr>
                    <td><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    </body>

    </html>
<?php
}
?>