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
      //                       DELETE
      //--------------------------------------------------
      else if ($type == "delete_data") {
        if (isset($_POST['btnAction'])) {

          $table = $_REQUEST['table'];
          $page = $_REQUEST['page'];

          $id = $_POST['btnAction'];

          if ($_SESSION['admin'] == 'admin') {

            $result = $db->del($table, 'id', $id);

            if ($result) {
              echo "<script>alert(\" Delete Item Successful\");
								window.location.href='" . $page . ".php';</script>";
            }
          } else if ($_SESSION['admin'] != 'admin') {

            die('you are not admin');
          }
        }
      }

      //--------------------------------------------------
      //                       DELETE
      //--------------------------------------------------

      //--------------------------------------------------
      //                       CATEGORY
      //--------------------------------------------------
      else if ($type == "category_add") {
        if (isset($_POST['btnAction'])) {

          $name_en = trim($_POST['name_en']);
          $name_cn = trim($_POST['name_cn']);
          $name_my = trim($_POST['name_my']);

          // $desc_en = $_POST['desc_en'];
          // $desc_cn = $_POST['desc_cn'];
          // $desc_my = $_POST['desc_my'];

          $desc_en = "";
          $desc_cn = "";
          $desc_my = "";

          // check category is it isset in database
          $table = "category_translation";
          $col = "id, name";
          $opt = 'name = ? || name = ? || name = ?';
          $arr = array($name_en, $name_cn, $name_my);
          $check_cate_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_cate_isset) != 0) {
            echo "<script>alert(\" Category Existed\");
            window.location.href='category.php';</script>";
          } else {

            $table = "category";
            $colname = array("status", "date_created", "date_modified");
            $array = array(1, $time, $time);
            $result_cate = $db->insert($table, $colname, $array);

            if ($result_cate) {

              //--------------------------
              //  get category id inserted
              //--------------------------
              $table = "category";
              $col = "id";
              $opt = 'date_created = ?';
              $arr = array($time);
              $category = $db->advwhere($col, $table, $opt, $arr);
              $category_id = $category[0]['id'];
              //--------------------------


              //--------------------------
              //  insert category detail
              //--------------------------
              $table = "category_translation";
              $colname = array("name", "description", "language", "category_id");
              $array = array($name_en, $desc_en, "en", $category_id);
              $result_cate = $db->insert($table, $colname, $array);

              $array = array($name_cn, $desc_cn, "cn", $category_id);
              $result_cate = $db->insert($table, $colname, $array);

              $array = array($name_my, $desc_my, "my", $category_id);
              $result_cate = $db->insert($table, $colname, $array);
              //--------------------------


              if ($result_cate) {
                echo "<script>alert(\" Add Category Successful\");
                window.location.href='category.php';</script>";
              } else {
                echo "<script>alert(\" Add Category Fail, PLease Try Again. \");
                window.location.href='category.php';</script>";
              }
            }
          }
        }
      } else if ($type == "category_edit") {
        if (isset($_POST['btnAction'])) {

          $category_id = $_POST['btnAction'];
          $name_en = trim($_POST['name_en']);
          $name_cn = trim($_POST['name_cn']);
          $name_my = trim($_POST['name_my']);

          $status = $_POST['status'];

          // $desc_en = $_POST['desc_en'];
          // $desc_cn = $_POST['desc_cn'];
          // $desc_my = $_POST['desc_my'];

          $desc_en = "";
          $desc_cn = "";
          $desc_my = "";


          $table = "category";
          $data = "status =?, date_modified = ? WHERE id = ?";
          $array = array($status, $time, $category_id);
          $result_cate = $db->update($table, $data, $array);

          if ($result_cate) {

            //--------------------------
            //  Edit category detail
            //--------------------------
            $table = "category_translation";
            $data = "name = ?, description = ? WHERE category_id = ? && language = ?";
            $array = array($name_en, $desc_en, $category_id, "en");
            $result_cate_detail = $db->update($table, $data, $array);

            $array = array($name_cn, $desc_cn, $category_id, "cn");
            $result_cate_detail = $db->update($table, $data, $array);

            $array = array($name_my, $desc_my, $category_id, "my");
            $result_cate_detail = $db->update($table, $data, $array);
            //--------------------------


            if ($result_cate_detail) {
              echo "<script>alert(\" Edit Category Successful\");
                window.location.href='category.php';</script>";
            } else {
              echo "<script>alert(\" Edit Category Fail, PLease Try Again. \");
                window.location.href='category.php';</script>";
            }
          } else {
            echo "<script>alert(\" Edit Category Fail, PLease Try Again. \");
              window.location.href='category.php';</script>";
          }
        }
      }

      //--------------------------------------------------
      //                       CATEGORY
      //--------------------------------------------------

      //--------------------------------------------------
      //                       PRODUCT
      //--------------------------------------------------
      else if ($type == "product_add") {
        if (isset($_POST['btnAction'])) {

          $name_en = trim($_POST['name_en']);
          $name_cn = trim($_POST['name_cn']);
          $name_my = trim($_POST['name_my']);

          $desc_en = $_POST['desc_en'];
          $desc_cn = $_POST['desc_cn'];
          $desc_my = $_POST['desc_my'];

          $category = $_POST['category'];
          $stock = $_POST['stock'];
          $point = $_POST['point'];

          $user_price = $_POST['user_price'];
          $distributor_price = $_POST['distributor_price'];
          $dealer_price = $_POST['dealer_price'];

          $length = $_POST['length'];
          $width = $_POST['width'];
          $weight = $_POST['weight'];
          $height = $_POST['height'];

          // $desc_en = "";
          // $desc_cn = "";
          // $desc_my = "";

          // check product is it isset in database
          $table = "product_translation";
          $col = "id, name";
          $opt = 'name = ? || name = ? || name = ?';
          $arr = array($name_en, $name_cn, $name_my);
          $check_product_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_product_isset) != 0) {
            echo "<script>alert(\" Product Existed\");
            window.location.href='product.php';</script>";
          } else {

            //------------------------------------------
            //			Image Upload Start - img
            //------------------------------------------
            if ($_FILES["img"]["error"] > 0) {
              echo "<script>alert('error');</script>";
            } else {


              if (file_exists("../img/product/" . $_FILES["img"]["name"])) {
                echo "<script>alert('exist');</script>";
              } else {
                $temp = explode(".", $_FILES["img"]["name"]);
                $newfilename = 'PROD' . round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES["img"]["tmp_name"], "../img/product/" . $newfilename);
              }
            }
            //------------------------------------------
            //			Image Upload End - img
            //------------------------------------------

            $table = "product";
            $colname = array("point", "stock", "category", "length",  "width",  "height",  "weight",  "image", "status", "date_created", "date_modified");
            $array = array($point, $stock, $category, $length, $width, $height, $weight, $newfilename, 1, $time, $time);
            $result_product = $db->insert($table, $colname, $array);

            if ($result_product) {

              //--------------------------
              //  get product id inserted
              //--------------------------
              $table = "product";
              $col = "id";
              $opt = 'date_created = ?';
              $arr = array($time);
              $product = $db->advwhere($col, $table, $opt, $arr);
              $product_id = $product[0]['id'];
              //--------------------------


              //--------------------------
              //  insert product detail
              //--------------------------
              $table = "product_translation";
              $colname = array("name", "description", "language", "product_id");
              $array = array($name_en, $desc_en, "en", $product_id);
              $result_product_translation = $db->insert($table, $colname, $array);

              $array = array($name_cn, $desc_cn, "cn", $product_id);
              $result_product_translation = $db->insert($table, $colname, $array);

              $array = array($name_my, $desc_my, "my", $product_id);
              $result_product_translation = $db->insert($table, $colname, $array);
              //--------------------------

              //----------------------------
              //  insert product role price
              //----------------------------
              $table = "product_role_price";
              $colname = array("price", "type", "product_id");
              $array = array($user_price, "1", $product_id);
              $result_product_price = $db->insert($table, $colname, $array);

              $array = array($distributor_price, "2", $product_id);
              $result_product_price = $db->insert($table, $colname, $array);

              $array = array($dealer_price, "3", $product_id);
              $result_product_price = $db->insert($table, $colname, $array);

              //----------------------------

              if ($result_product_price) {
                echo "<script>alert(\" Add Product Successful\");
                window.location.href='product.php';</script>";
              } else {
                echo "<script>alert(\" Add Product Fail, PLease Try Again. \");
                window.location.href='product.php';</script>";
              }
            }
          }
        }
      } else if ($type == "product_edit") {
        if (isset($_POST['btnAction'])) {

          $product_id = $_POST['btnAction'];
          $status = $_POST['status'];

          $name_en = trim($_POST['name_en']);
          $name_cn = trim($_POST['name_cn']);
          $name_my = trim($_POST['name_my']);

          $desc_en = $_POST['desc_en'];
          $desc_cn = $_POST['desc_cn'];
          $desc_my = $_POST['desc_my'];

          $category = $_POST['category'];
          $stock = $_POST['stock'];
          $point = $_POST['point'];

          $length = $_POST['length'];
          $width = $_POST['width'];
          $weight = $_POST['weight'];
          $height = $_POST['height'];

          $user_price = $_POST['user_price'];
          $distributor_price = $_POST['distributor_price'];
          $dealer_price = $_POST['dealer_price'];

          //------------------------------------------------------------------------------------
          //			Update product detail
          //------------------------------------------------------------------------------------
          if (!file_exists($_FILES['img']['tmp_name']) || !is_uploaded_file($_FILES['img']['tmp_name'])) { // no upload file will not update img name
            $table = "product";
            $data = "point =?, stock =?, category =?, length =?, width =?, height =?, weight =?, status =?, date_modified = ? WHERE id = ?";
            $array = array($point, $stock, $category, $length, $width, $height, $weight, $status, $time, $product_id);
            $result_product = $db->update($table, $data, $array);
          } else {
            //------------------------------------------
            //			Image Upload Start - img
            //------------------------------------------
            if ($_FILES["img"]["error"] > 0) {
              echo "<script>alert('error');</script>";
            } else {
              if (file_exists("../img/product/" . $_FILES["img"]["name"])) {
                echo "<script>alert('exist');</script>";
              } else {
                $temp = explode(".", $_FILES["img"]["name"]);
                $newfilename = 'PROD' . round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES["img"]["tmp_name"], "../img/product/" . $newfilename);
              }
            }
            //------------------------------------------
            //			Image Upload End - img
            //------------------------------------------

            $table = "product";
            $data = "point =?, stock =?, category =?, length =?, width =?, height =?, weight =?, image =?, status =?, date_modified = ? WHERE id = ?";
            $array = array($point, $stock, $category, $length, $width, $height, $weight, $newfilename, $status, $time, $product_id);
            $result_product = $db->update($table, $data, $array);
          }
          //------------------------------------------------------------------------------------

          if ($result_product) {

            //--------------------------
            //  Edit product detail
            //--------------------------
            $table = "product_translation";
            $data = "name = ?, description = ? WHERE product_id = ? && language = ?";
            $array = array($name_en, $desc_en, $product_id, "en");
            $result_product_detail = $db->update($table, $data, $array);

            $array = array($name_cn, $desc_cn, $product_id, "cn");
            $result_product_detail = $db->update($table, $data, $array);

            $array = array($name_my, $desc_my, $product_id, "my");
            $result_product_detail = $db->update($table, $data, $array);
            //--------------------------

            //--------------------------
            //  Edit product price
            //--------------------------
            $table = "product_role_price";
            $data = " price = ? WHERE product_id = ? && type = ?";
            $array = array($user_price, $product_id, "1");
            $result_product_price = $db->update($table, $data, $array);

            $array = array($distributor_price, $product_id, "2");
            $result_product_price = $db->update($table, $data, $array);

            $array = array($dealer_price, $product_id, "3");
            $result_product_price = $db->update($table, $data, $array);
            //--------------------------


            if ($result_product_detail && $result_product_price) {
              echo "<script>alert(\" Edit Product Successful\");
                window.location.href='product.php';</script>";
            } else {
              echo "<script>alert(\" Edit Product Fail, PLease Try Again. \");
                window.location.href='product.php';</script>";
            }
          } else {
            echo "<script>alert(\" Edit Product Fail, PLease Try Again. \");
              window.location.href='product.php';</script>";
          }
        }
      }

      //--------------------------------------------------
      //                       PRODUCT
      //--------------------------------------------------

      //--------------------------------------------------
      //                    DISTRIBUTOR 
      //--------------------------------------------------

      else if ($type == "distributor_add") {
        if (isset($_POST['btnAction'])) {

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
          $table = "users";
          $col = "id, name";
          $opt = 'email =?';
          $arr = array($email);
          $check_distributor_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_distributor_isset) != 0) {
            echo "<script>alert(\" Distributor Existed\");
            window.location.href='distributor.php';</script>";
          } else {

            $table = "users";
            $colname = array("name", "email", "password", "type", "status", "date_created", "date_modified");
            $array = array($name, $email, $password, 2, 1, $time, $time);
            $result_distributor = $db->insert($table, $colname, $array);

            if ($result_distributor) {

              //------------------------------------------
              //		To get distributor code with no repeat
              //------------------------------------------

              $check_code = 0;
              $distributor_code = 'DIST' . random_string(7);
              $check_distributor_code = $db->where('distributor_code', 'user_distributor', 'distributor_code', $distributor_code);

              if (count($check_distributor_code) > 0) { //if count distributor code more than 1
                do {

                  $distributor_code = 'DIST' . random_string(7);
                  $check_distributor_code = $db->where('distributor_code', 'user_distributor', 'distributor_code', $distributor_code);

                  if (count($check_distributor_code) == 0) {
                    $check_code = 1;
                  }
                } while ($check_code != 1);
              }

              //--------------------------
              //  get distributor_code id inserted
              //--------------------------
              $table = "users";
              $col = "id";
              $opt = 'date_created = ?';
              $arr = array($time);
              $distributor = $db->advwhere($col, $table, $opt, $arr);
              $distributor_id = $distributor[0]['id'];
              //--------------------------


              $table = "user_distributor";
              $colname = array("distributor_code", "user_id");
              $array = array($distributor_code, $distributor_id);
              $result_distributor_code = $db->insert($table, $colname, $array);

              $table = "user_address";
              $colname = array("name", "contact", "address", "postcode", "city", "state", "status", "user_id", "date_created", "date_modified");
              $array = array($address_name, $contact, $address, $postcode, $city, $state, 1, $distributor_id, $time, $time);
              $result_distributor_address = $db->insert($table, $colname, $array);


              if ($result_distributor_code && $result_distributor_address) {
                echo "<script>alert(\" Add Distributor Successful\");
                window.location.href='distributor.php';</script>";
              } else {
                echo "<script>alert(\" Add Distributor Fail, PLease Try Again. \");
                window.location.href='distributor.php';</script>";
              }
            }
          }
        }
      } else if ($type == "distributor_edit") {
        if (isset($_POST['btnAction'])) {

          $distributor_id = $_POST['btnAction'];
          $status = $_POST['status'];

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

          $table = "users";
          $data = "name = ?, email = ?, password = ?, status = ?, date_modified = ? WHERE id = ?";
          $array = array($name, $email, $password, $status, $time, $distributor_id);
          $result_distributor = $db->update($table, $data, $array);

          if ($result_distributor) {


            $table = "user_address";
            $data = "name = ?, contact = ?, address = ?, postcode = ?, city = ?, state = ?, date_modified = ? WHERE user_id = ?";
            $array = array($address_name, $contact, $address, $postcode, $city, $state, $time, $distributor_id);
            $result_distributor_address = $db->update($table, $data, $array);


            if ($result_distributor_address) {
              echo "<script>alert(\" Edit Distributor Successful\");
              window.location.href='distributor.php';</script>";
            } else {
              echo "<script>alert(\" Edit Distributor Fail, PLease Try Again. \");
              window.location.href='distributor.php';</script>";
            }
          }
        }
      }




      //--------------------------------------------------
      //                    DISTRIBUTOR
      //--------------------------------------------------

      //--------------------------------------------------
      //             DISTRIBUTOR REFUND
      //--------------------------------------------------

      else if ($type == "refund_approve") {
        if (isset($_POST['btnAction'])) {

          $refund_id = $_POST['btnAction'];

          $col = "dw.*, u.name as distributor_name, ud.*";
          $tb = "distributor_wallet_transaction dw left join users u on dw.distributor_id = u.id left join user_distributor ud on dw.distributor_id = ud.user_id";
          $opt = 'dw.id = ?';
          $arr = array($refund_id);
          $refund = $db->advwhere($col, $tb, $opt, $arr);

          if (count($refund) != 0) {
            $refund = $refund[0];

            $amount_to_refund = $refund['amount'];
            $distributor_wallet = $refund['distributor_wallet'];
            $distributor_id = $refund['distributor_id'];
            $refund_date_created = $refund['date_created'];

            if ($distributor_wallet >= $amount_to_refund) {

              if (!file_exists($_FILES['img']['tmp_name']) || !is_uploaded_file($_FILES['img']['tmp_name'])) { // no upload file will not update img name
                echo "<script>alert(\" Upload Refund Proof Fail, PLease Try Again. \");
                window.location.href='refund.php';</script>";
                exit();
              } else {
                //------------------------------------------
                //			Image Upload Start - img
                //------------------------------------------
                if ($_FILES["img"]["error"] > 0) {
                  echo "<script>alert('error');</script>";
                } else {
                  if (file_exists("../img/refund/" . $_FILES["img"]["name"])) {
                    echo "<script>alert('exist');</script>";
                  } else {
                    $temp = explode(".", $_FILES["img"]["name"]);
                    $newfilename = 'REF' . round(microtime(true)) . '.' . end($temp);
                    move_uploaded_file($_FILES["img"]["tmp_name"], "../img/refund/" . $newfilename);
                  }
                }
                //------------------------------------------
                //			Image Upload End - img
                //------------------------------------------
              }

              //update refund request status
              $table = "distributor_wallet_transaction";
              $data = "status = ?, image =?, date_modified = ? WHERE id = ?";
              $array = array(2, $newfilename, $time, $refund_id);
              $result_distributor_wallet_transaction = $db->update($table, $data, $array);

              if (!$result_distributor_wallet_transaction) {
                echo "<script>alert(\" Update Refund Request Status Fail, PLease Try Again. \");
                window.location.href='refund.php';</script>";
                exit();
              }

              //update distributor wallet amount after reduce
              $reduced_wallet_amount = $distributor_wallet - $amount_to_refund;
              $negative_amount = $amount_to_refund * -1; // insert negative number to db, for identify it is reducing
              $description = "Refund Request. Date: " . $refund_date_created; // history description

              $table = "user_distributor";
              $data = "distributor_wallet = ? WHERE user_id = ?";
              $array = array($reduced_wallet_amount, $distributor_id);
              $result_user_distributor = $db->update($table, $data, $array);

              if (!$result_user_distributor) {
                echo "<script>alert(\" Update Distributor Wallet Fail, PLease Try Again. (**Contact IT Support** )\");
                window.location.href='refund.php';</script>";
                exit();
              }

              //   Add Histroy to distributor_wallet_transaction_history
              $table = "distributor_wallet_transaction_history";
              $colname = array("amount", "current_amount", "description", "distributor_id", "date_created", "date_modified");
              $array = array($negative_amount, $reduced_wallet_amount, $description, $distributor_id, $time, $time);
              $result_wallet_history = $db->insert($table, $colname, $array);

              if ($result_wallet_history) {
                echo "<script>alert(\" Appprove Refund Request Successful\");
                window.location.href='refund.php';</script>";
              } else {
                echo "<script>alert(\" Appprove Refund Request Successful, But Insert History Fail\");
                window.location.href='refund.php';</script>";
              }
            } else {
              echo "<script>alert(\" Wallet amount is insufficient , PLease Try Again. \");
                     window.location.href='refund.php';</script>";
            }
          } else {
            echo "<script>alert(\" This Refund not Exists in database, PLease Try Again. \");
            window.location.href='refund.php';</script>";
          }
        }
      }

      //--------------------------------------------------
      //              DISTRIBUTOR REFUND
      //--------------------------------------------------

      //--------------------------------------------------
      //                    DEALER 
      //--------------------------------------------------

      else if ($type == "dealer_edit") {
        if (isset($_POST['btnAction'])) {

          $dealer_id = $_POST['btnAction'];
          $status = $_POST['status'];
          $distributor_code = $_POST['distributor_code'];
          $name = $_POST['name'];
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

          // check dealer is it isset in database
          $table = "users left join user_distributor on users.id = user_distributor.user_id";
          $col = "users.id as distributor_id, user_distributor.distributor_code as distributor_code";
          $opt = 'user_distributor.distributor_code =?';
          $arr = array($distributor_code);
          $check_distributor_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_distributor_isset) <= 0) {
            echo "<script>alert(\" Distributor Do not Existed!\");
                      window.location.href='dealer.php';</script>";
          } else {

            $table = "users";
            $data = "name = ?, email = ?, password = ?, status = ?, date_modified = ? WHERE id = ?";
            $array = array($name, $email, $password, $status, $time, $dealer_id);
            $result_dealer = $db->update($table, $data, $array);

            if ($result_dealer) {


              $table = "user_address";
              $data = "name = ?, contact = ?, address = ?, postcode = ?, city = ?, state = ?, date_modified = ? WHERE user_id = ?";
              $array = array($address_name, $contact, $address, $postcode, $city, $state, $time, $dealer_id);
              $result_dealer_address = $db->update($table, $data, $array);


              if ($result_dealer_address) {
                echo "<script>alert(\" Edit Dealer Successful\");
              window.location.href='dealer.php';</script>";
              } else {
                echo "<script>alert(\" Edit Dealer Fail, PLease Try Again. \");
              window.location.href='dealer.php';</script>";
              }
            }
          }
        }
      }

      //--------------------------------------------------
      //                    DEALER
      //--------------------------------------------------

      //--------------------------------------------------
      //                    USER 
      //--------------------------------------------------

      else if ($type == "user_edit") {
        if (isset($_POST['btnAction'])) {

          $user_id = $_POST['btnAction'];
          $status = $_POST['status'];
          $name = $_POST['name'];
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

          $table = "users";
          $data = "name = ?, email = ?, password = ?, status = ?, date_modified = ? WHERE id = ?";
          $array = array($name, $email, $password, $status, $time, $user_id);
          $result_user = $db->update($table, $data, $array);

          if ($result_user) {

            $table = "user_address";
            $data = "name = ?, contact = ?, address = ?, postcode = ?, city = ?, state = ?, date_modified = ? WHERE user_id = ?";
            $array = array($address_name, $contact, $address, $postcode, $city, $state, $time, $user_id);
            $result_user_address = $db->update($table, $data, $array);


            if ($result_user_address) {
              echo "<script>alert(\" Edit User Successful\");
              window.location.href='user.php';</script>";
            } else {
              echo "<script>alert(\" Edit User Fail, PLease Try Again. \");
              window.location.href='user.php';</script>";
            }
          }
        }
      }

      //--------------------------------------------------
      //                    USER
      //--------------------------------------------------

      //--------------------------------------------------
      //                    ORDER 
      //--------------------------------------------------

      // approve order from status failed / canceled
      else if ($type == "order_approve") {
        if (isset($_POST['btnAction'])) {

          $order_id = $_POST['btnAction'];

          $tablename = "orders";
          $data = "status = ?, date_modified = ? WHERE id = ?";
          $array = array(2, $time, $order_id);
          $result = $db->update($tablename, $data, $array);

          if ($result) {
            echo "<script>alert(\" Update Status Successful\");
              window.location.href='order.php?page=2';</script>";
          } else {
            echo "<script>alert(\" Update Status Fail, PLease Try Again. \");
              window.location.href='order.php?page=2';</script>";
          }
        }
      }

      // order assign consigment number
      else if ($type == "order_assign") {
        if (isset($_POST['btnAction'])) {

          $order_id = $_POST['btnAction'];
          $consignment_number = $_POST['consignment_number'];

          $tablename = "orders";
          $data = "status = ?, consignment_number =?, date_modified = ? WHERE id = ?";
          $array = array(3, $consignment_number, $time, $order_id);
          $result = $db->update($tablename, $data, $array);

          if ($result) {
            echo "<script>alert(\" Update Status Successful\");
              window.location.href='order.php?page=3';</script>";
          } else {
            echo "<script>alert(\" Update Status Fail, PLease Try Again. \");
              window.location.href='order.php?page=3';</script>";
          }
        }
      }


      // to complete order after delivered
      else if ($type == "order_complete") {
        if (isset($_POST['btnAction'])) {

          $order_id = $_POST['btnAction'];

          $tablename = "orders";
          $data = "status = ?, date_modified = ? WHERE id = ?";
          $array = array(4, $time, $order_id);
          $result = $db->update($tablename, $data, $array);

          if ($result) {
            echo "<script>alert(\" Update Status Successful\");
                    window.location.href='order.php?page=4';</script>";
          } else {
            echo "<script>alert(\" Update Status Fail, PLease Try Again. \");
                    window.location.href='order.php?page=4';</script>";
          }
        }
      }

      //--------------------------------------------------
      //                    ORDER
      //--------------------------------------------------

    } // table admin
  } else {
    echo "Token Expired. Please Try Again";
  }
} else {
  echo "Token Is Required.";
}
