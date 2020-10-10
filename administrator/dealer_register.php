<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// require_once('connection/PDO_db_function.php');
// $db = new DB_Functions(); 
require_once('inc/init.php');
// require_once("inc/level_controller.php");
if (isset($_REQUEST['type']) && isset($_REQUEST['tb'])) {
  $type = $_REQUEST['type'];
  $tb = $_REQUEST['tb'];
}
$postedToken = filter_input(INPUT_POST, 'token');
if (!empty($postedToken)) {

  $time = date('Y-m-d H:i:s');

  if (isTokenValid($postedToken)) {
    if ($tb == "admin") {
      if ($type == "add") {
        if (isset($_POST['submit'])) {
        }
      }
 
      //--------------------------------------------------
      //                 Dealer Register 
      //--------------------------------------------------

      else if ($type == "dealer_register") {
        if (isset($_POST['btnAction'])) {

          $distributor_code = $_POST['distributor_code'];
          $name = $_POST['name'];
          $email = $_POST['email'];
          $contact = $_POST['contact'];
          $password = $_POST['password'];
          $password = encrypt_decrypt('encrypt', $password);
          $address = $_POST['address'];
          $state = $_POST['state'];
          $postcode = $_POST['postcode'];
          $city = $_POST['city'];
          $address_name = "-";


          // check Distributor is it isset in database
          $table = "users left join user_distributor on users.id = user_distributor.user_id";
          $col = "users.id as distributor_id, user_distributor.distributor_code as distributor_code";
          $opt = 'user_distributor.distributor_code =?';
          $arr = array($distributor_code);
          $check_distributor_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_distributor_isset) <= 0) {
            echo "<script>alert(\" Distributor Do not Existed!\");
            window.location.href='dealer.php';</script>";
          } else {

            // check Dealer is it isset in database
            $table = "users";
            $col = "id, name";
            $opt = 'email =?';
            $arr = array($email);
            $check_dealer_isset = $db->advwhere($col, $table, $opt, $arr);

            if (count($check_dealer_isset) != 0) {
              echo "<script>alert(\" Dealer Existed, Please use other email to register\");
              window.location.href='dealer.php';</script>";
            } else {

            $distributor_id = $check_distributor_isset[0]['distributor_id'];

            $table = "users";
            $colname = array("name", "email", "password", "type", "status", "date_created", "date_modified");
            $array = array($name, $email, $password, 3, 1, $time, $time);
            $result_dealer = $db->insert($table, $colname, $array);

            if ($result_dealer) {

              //--------------------------
              //  get dealer id inserted
              //--------------------------
              $table = "users";
              $col = "id";
              $opt = 'date_created = ?';
              $arr = array($time);
              $dealer = $db->advwhere($col, $table, $opt, $arr);
              $dealer_id = $dealer[0]['id'];
              //--------------------------

              
              $table = "user_dealer";
              $colname = array("under_distributor", "user_id");
              $array = array($distributor_id, $dealer_id);
              $result_under_distributor = $db->insert($table, $colname, $array);

              $table = "user_address";
              $colname = array("name", "contact", "address", "postcode", "city", "state", "status", "user_id", "date_created", "date_modified");
              $array = array($address_name, $contact, $address, $postcode, $city, $state, 1, $dealer_id, $time, $time);
              $result_dealer_address = $db->insert($table, $colname, $array);


              if ($result_under_distributor && $result_dealer_address) {
                echo "<script>alert(\" Add Dealer Successful\");
                window.location.href='dealer.php';</script>";
              } else {
                echo "<script>alert(\" Add Dealer Fail, PLease Try Again. \");
                window.location.href='dealer.php';</script>";
              }
            }
          }
          }
        }
      }

      //--------------------------------------------------
      //                    DISTRIBUTOR
      //--------------------------------------------------

    } // table admin
  } else {
    echo "Token Expired. Please Try Again";
  }
} else {
  echo "Token Is Required.";
}
