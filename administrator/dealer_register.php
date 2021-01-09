<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('connection/PDO_db_function.php');
$db = new DB_Functions();
if (isset($_REQUEST['type']) && isset($_REQUEST['tb'])) {
  $type = $_REQUEST['type'];
  $tb = $_REQUEST['tb'];
}
$postedToken = filter_input(INPUT_POST, 'token');
if (!empty($postedToken)) {

  $time = date('Y-m-d H:i:s');

  if (isTokenValid($postedToken)) {
    if ($tb == "admin" || $tb == "dealer") {


      if ($tb == "admin") {
        $page = "dealer";
        $pagefail = "dealer";
      } else {
        $page = "../login";
        $pagefail = "../register_dealer";
      }

      if ($type == "add") {
        if (isset($_POST['submit'])) {
        }
      }

      //--------------------------------------------------
      //                 Dealer Register 
      //--------------------------------------------------

      else if ($type == "dealer_register") {
        if (isset($_POST['btnAction'])) {

          $empty_input = 0; // check is input empty
          if ($_POST['distributor_code'] == "" || $_POST['distributor_code'] == null) {
            $empty_input + 1;
          } else {
            $distributor_code = $_POST['distributor_code'];
          }

          if ($_POST['name'] == "" || $_POST['name'] == null) {
            $empty_input + 1;
          } else {
            $name = $_POST['name'];
          }

          if ($_POST['email'] == "" || $_POST['email'] == null) {
            $empty_input + 1;
          } else {
            $email = $_POST['email'];
          }

          if ($_POST['contact'] == "" || $_POST['contact'] == null) {
            $empty_input + 1;
          } else {
            $contact = $_POST['contact'];
          }

          if ($_POST['password'] == "" || $_POST['password'] == null) {
            $empty_input + 1;
          } else {
            $password = $_POST['password'];
            $password = encrypt_decrypt('encrypt', $password);
          }

          if ($_POST['address'] == "" || $_POST['address'] == null) {
            $empty_input + 1;
          } else {
            $address = $_POST['address'];
          }

          if ($_POST['state'] == "" || $_POST['state'] == null) {
            $empty_input + 1;
          } else {
            $state = $_POST['state'];
          }

          if ($_POST['postcode'] == "" || $_POST['postcode'] == null) {
            $empty_input + 1;
          } else {
            $postcode = $_POST['postcode'];
          }

          if ($_POST['city'] == "" || $_POST['city'] == null) {
            $empty_input + 1;
          } else {
            $city = $_POST['city'];
          }

          $address_name = "-";


          // check Distributor is it isset in database
          $table = "users left join user_distributor on users.id = user_distributor.user_id";
          $col = "users.id as distributor_id, user_distributor.distributor_code as distributor_code";
          $opt = 'user_distributor.distributor_code =?';
          $arr = array($distributor_code);
          $check_distributor_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_distributor_isset) <= 0) {
            echo "<script>alert(\" Distributor Do not Existed!\");
            window.location.href='$pagefail.php';</script>";
          } else {

            // check Dealer is it isset in database
            $table = "users";
            $col = "id, name";
            $opt = 'email =?';
            $arr = array($email);
            $check_dealer_isset = $db->advwhere($col, $table, $opt, $arr);

            if (count($check_dealer_isset) != 0) {
              echo "<script>alert(\" Dealer Existed, Please use other email to register\");
              window.location.href='$pagefail.php';</script>";
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
                $col = "id, email";
                $opt = 'date_created = ?';
                $arr = array($time);
                $dealer = $db->advwhere($col, $table, $opt, $arr);
                $dealer_id = $dealer[0]['id'];
                $user_email = $dealer[0]['email'];
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
                  //--------------------------
                  //       for email
                  //--------------------------
                  require_once "vendor/autoload.php";
                  //PHPMailer Object
                  $mail = new PHPMailer;
                  // $mail->SMTPDebug = 3;
                  $mail->isSMTP();
                  $mail->Host = $email_host;
                  $mail->SMTPAuth = true;
                  $mail->Username = $email_username;
                  $mail->Password = $email_password;
                  $mail->SMTPSecure = "tls";
                  $mail->Port = "587";
                  //Send HTML or Plain Text email
                  $mail->isHTML(true);
                  //From email address and name
                  $mail->From = $email_from;
                  $mail->FromName = $email_from_name;

                  //--------------------------
                  //       for email
                  //--------------------------
                  // $order_detail = array("order" => $order, "order_item" => $order_item, "server_path" => $server_path);

                  //To address and name
                  $mail->addAddress($user_email);
                  $mail->Subject = "REGISTER SUCCESSFUL";
                  $mail->Body = "Congratulations on successful registration";
                  // $mail->Body = get_include_contents('../administrator/mail/purchase_success_mail.php', $order_detail);
                  $mail->send();
                  // if (!$mail->send()) {
                  //     echo "Mailer Error: " . $mail->ErrorInfo;
                  // } else {
                  //     echo "Message has been sent successfully2";
                  // }
                  //----------------------------
                  //		Email code here(end)
                  //----------------------------
                  if ($mail) {
                    echo "<script>alert(\" Dealer Register Successful\");
                  window.location.href='$page.php';</script>";
                  } else {
                    echo "<script>alert(\" Dealer Register Successful! But Send Mail Fail.\");
                window.location.href='$page.php';</script>";
                  }
                } else {
                  echo "<script>alert(\" Dealer Register Fail, PLease Try Again. \");
                window.location.href='$page.php';</script>";
                }
              }
            }
          }
        }
      }

      //--------------------------------------------------
      //                    Dealer Register
      //--------------------------------------------------

    } // table admin
  } else {
    echo "Token Expired. Please Try Again";
  }
} else {
  echo "Token Is Required.";
}
