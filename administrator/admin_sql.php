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
          $point_allow_discount = $_POST['point_allow_discount'];

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



            $table = "product";
            $colname = array("point", "point_allow_discount", "stock", "category", "length",  "width",  "height",  "weight",  "image", "status", "date_created", "date_modified");
            $array = array($point, $point_allow_discount, $stock, $category, $length, $width, $height, $weight, "", 1, $time, $time);
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


              //------------------------------------------
              //			Image Upload Start - img
              //------------------------------------------
              // if ($_FILES["img"]["error"] > 0) {
              //   echo "<script>alert('error');</script>";
              // } else {

              //   if (file_exists("../img/product/" . $_FILES["img"]["name"])) {
              //     echo "<script>alert('exist');</script>";
              //   } else {
              //     $temp = explode(".", $_FILES["img"]["name"]);
              //     $newfilename = 'PROD' . round(microtime(true)) . '.' . end($temp);
              //     move_uploaded_file($_FILES["img"]["tmp_name"], "../img/product/" . $newfilename);
              //   }
              // }

              $files = array_filter($_FILES['img']['name']); //Use something similar before processing files.
              // Count the number of uploaded files in array
              $total_count = count($_FILES['img']['name']);
              // Loop through every file
              for ($i = 0; $i < $total_count; $i++) {
                //The temp file path is obtained
                $tmpFilePath = $_FILES['img']['tmp_name'][$i];
                //A file path needs to be present
                if ($tmpFilePath != "") {
                  //Setup our new file path
                  $temp = explode(".", $_FILES['img']['name'][$i]);
                  $newfilename = 'PROD' . round(microtime(true)) . $i . '.' . end($temp);
                  $newFilePath = "../img/product/" . $newfilename;
                  //File is uploaded to temp dir
                  if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    //Other code goes here
                    if ($i == 0) {
                      $table = "product";
                      $data = "image = ? WHERE id = ?";
                      $array = array($newfilename, $product_id);
                      $result_update_image = $db->update($table, $data, $array);
                    }
                    $table = "product_image";
                    $colname = array("image", "product_id");
                    $array = array($newfilename, $product_id);
                    $result_insert_multi_image = $db->insert($table, $colname, $array);
                  }
                }
              }



              //------------------------------------------
              //			Image Upload End - img
              //------------------------------------------


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
          $point_allow_discount = $_POST['point_allow_discount'];

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

          $table = "product";
          $data = "point =?, point_allow_discount=?, stock =?, category =?, length =?, width =?, height =?, weight =?, status =?, date_modified = ? WHERE id = ?";
          $array = array($point, $point_allow_discount, $stock, $category, $length, $width, $height, $weight, $status, $time, $product_id);
          $result_product = $db->update($table, $data, $array);

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
      } else if ($type == "product_image_set_primary") {
        if (isset($_POST['btnAction'])) {

          $image_id = $_POST['btnAction'];

          $col = "*";
          $tb = "product_image";
          $opt = 'id = ?';
          $arr = array($image_id);
          $product_image = $db->advwhere($col, $tb, $opt, $arr);

          if (count($product_image) != 0) {
            $product_id = $product_image[0]['product_id'];
            $image_name = $product_image[0]['image'];
          } else {
            echo "<script>alert(\" Setting Product Image Fail. Cant Get Product Details. Please try again.\");
                      window.location.href='product_image.php?p=$product_id';</script>";
            exit();
          }

          $table = "product";
          $data = " image = ?, date_modified =? WHERE id = ? ";
          $array = array($image_name, $time, $product_id);
          $result_set_product_image = $db->update($table, $data, $array);

          if ($result_set_product_image) {
            echo "<script>alert(\" Setting Product Image Successful.\");
                            window.location.href='product_image.php?p=$product_id';</script>";
          } else {
            echo "<script>alert(\" Setting Product Image Fail. Please try again.\");
                        window.location.href='product_image.php?p=$product_id';</script>";
          }
        }
      } else if ($type == "product_add_image") {
        if (isset($_POST['btnAction'])) {

          $product_id = $_POST['btnAction'];


          $files = array_filter($_FILES['img']['name']); //Use something similar before processing files.
          // Count the number of uploaded files in array
          $total_count = count($_FILES['img']['name']);
          // Loop through every file
          for ($i = 0; $i < $total_count; $i++) {
            //The temp file path is obtained
            $tmpFilePath = $_FILES['img']['tmp_name'][$i];
            //A file path needs to be present
            if ($tmpFilePath != "") {
              //Setup our new file path
              $temp = explode(".", $_FILES['img']['name'][$i]);
              $newfilename = 'PROD' . round(microtime(true)) . $i . '.' . end($temp);
              $newFilePath = "../img/product/" . $newfilename;
              //File is uploaded to temp dir
              if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Other code goes here
                $table = "product_image";
                $colname = array("image", "product_id");
                $array = array($newfilename, $product_id);
                $result_insert_multi_image = $db->insert($table, $colname, $array);
              } else {
                $result_insert_multi_image = false;
              }
            }
          }

          // var_dump($result_insert_multi_image);
          if ($result_insert_multi_image) {
            echo "<script>alert(\" Add Product Image Successful.\");
                          window.location.href='product_image.php?p=$product_id';</script>";
          } else {
            echo "<script>alert(\" Add Product Image Fail. Please try again.\");
                      window.location.href='product_image.php?p=$product_id';</script>";
          }



          //------------------------------------------
          //			Image Upload End - img
          //------------------------------------------

        }
      } else if ($type == "product_delete") {
        if (isset($_POST['btnAction'])) {

          $image_id = $_POST['btnAction'];

          $col = "*";
          $tb = "product_image";
          $opt = 'id = ?';
          $arr = array($image_id);
          $product_image = $db->advwhere($col, $tb, $opt, $arr);

          if (count($product_image) != 0) {
            $product_id = $product_image[0]['product_id'];
            $image_name = $product_image[0]['image'];
          } else {
            echo "<script>alert(\" Delete Product Image Fail. Cant Get Product Details. Please try again.\");
                      window.location.href='product_image.php?p=$product_id';</script>";
            exit();
          }

          if (file_exists("../img/product/" . $image_name)) {
            unlink("../img/product/" . $image_name);
          }
          $result_product_image_delete = $db->del("product_image", 'id', $image_id);

          if ($result_product_image_delete) {
            echo "<script>alert(\" Delete Product Image Successful.\");
                          window.location.href='product_image.php?p=$product_id';</script>";
          } else {
            echo "<script>alert(\" Delete Product Image Fail. Please try again.\");
                      window.location.href='product_image.php?p=$product_id';</script>";
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

            // check Distributor state is it isset in database
            $table = "users u left join user_address ad on u.id = ad.user_id";
            $col = "state";
            $opt = 'u.type =? && ad.state =?';
            $arr = array(2, $state);
            $check_distributor_state = $db->advwhere($col, $table, $opt, $arr);

            if (count($check_distributor_state) != 0) {
              echo "<script>alert(\" Distributor's State Existed\");
              window.location.href='distributor.php';</script>";
              exit();
            }

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
                window.location.href='refund.php?page=1';</script>";
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
              $data = "admin_id =?, status = ?, image =?, date_modified = ? WHERE id = ?";
              $array = array($uid, 2, $newfilename, $time, $refund_id);
              $result_distributor_wallet_transaction = $db->update($table, $data, $array);

              if (!$result_distributor_wallet_transaction) {
                echo "<script>alert(\" Update Refund Request Status Fail, PLease Try Again. \");
                window.location.href='refund.php?page=1';</script>";
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
                window.location.href='refund.php?page=1';</script>";
                exit();
              }

              //   Add Histroy to distributor_wallet_transaction_history
              $table = "distributor_wallet_transaction_history";
              $colname = array("amount", "current_amount", "description", "distributor_id", "date_created", "date_modified");
              $array = array($negative_amount, $reduced_wallet_amount, $description, $distributor_id, $time, $time);
              $result_wallet_history = $db->insert($table, $colname, $array);

              if ($result_wallet_history) {
                echo "<script>alert(\" Appprove Refund Request Successful\");
                window.location.href='refund.php?page=2';</script>";
              } else {
                echo "<script>alert(\" Appprove Refund Request Successful, But Insert History Fail\");
                window.location.href='refund.php?page=2';</script>";
              }
            } else {
              echo "<script>alert(\" Wallet amount is insufficient , PLease Try Again. \");
                     window.location.href='refund.php?page=1';</script>";
            }
          } else {
            echo "<script>alert(\" This Refund not Exists in database, PLease Try Again. \");
            window.location.href='refund.php?page=1';</script>";
          }
        }
      } else if ($type == "refund_reject") {
        if (isset($_POST['btnAction'])) {

          $refund_id = $_POST['btnAction'];
          $reason = $_POST['reason'];

          $tablename = "distributor_wallet_transaction";
          $data = "status =?, reason =?, date_modified = ? WHERE id = ?";
          $array = array(3, $reason, $time, $refund_id);
          $result_distributor_wallet_transaction = $db->update($tablename, $data, $array);

          if ($result_distributor_wallet_transaction) {
            echo "<script>alert(\" Reject Refund Request Successful\");
                      window.location.href='refund.php?page=3';</script>";
          } else {
            echo "<script>alert(\" Reject Refund Request Fail. Please Try Again\");
                      window.location.href='refund.php?page=3';</script>";
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


            //--------------------------------------------------
            //              Get order details
            $col = "*";
            $tb = "orders";
            $opt = 'id = ?';
            $arr = array($order_id);
            $order = $db->advwhere($col, $tb, $opt, $arr);
            $order = $order[0];
            //--------------------------------------------------

            $user_id = $order["users_id"];
            //--------------------------------------------------
            //              Get user point details
            $col = "*";
            $tb = "user_point";
            $opt = 'user_id = ?';
            $arr = array($user_id);
            $user_point = $db->advwhere($col, $tb, $opt, $arr);
            if (count($user_point) == 0) {
              echo "<script>alert(\" Update Status Successful, But No Point\");
              window.location.href='order.php?page=4';</script>";
              exit();
            }
            $user_point = $user_point[0];
            //--------------------------------------------------

            $current_point = $user_point['point'];
            $order_point = $order['reward_point'];
            $gateway_order_id = $order["gateway_order_id"]; // order to record in description
            $description = "Caroma Coin Earn. Order Id: " . $gateway_order_id;
            $added_point = $current_point + $order_point;

            $tablename = "user_point";
            $data = "point =? WHERE user_id = ?";
            $array = array($added_point, $user_id);
            $result_user_point = $db->update($tablename, $data, $array);

            if ($result_user_point) {
              //   Add Histroy to user_point_transaction_history
              $table = "user_point_transaction_history";
              $colname = array("point", "current_point", "description", "user_id", "date_created", "date_modified");
              $array = array($order_point, $added_point, $description, $user_id, $time, $time);
              $result_user_point_history = $db->insert($table, $colname, $array);

              if ($result_user_point_history) {
                echo "<script>alert(\" Update Status Successful\");
                window.location.href='order.php?page=4';</script>";
              } else {
                echo "<script>alert(\" Update Status Successful. But Insert Points History Fail\");
                window.location.href='order.php?page=4';</script>";
              }
            } else {
              echo "<script>alert(\" Update Status Successful. But Update Points Fail\");
              window.location.href='order.php?page=4';</script>";
            }



            echo "<script>alert(\" Update Status Successful\");
                    window.location.href='order.php?page=4';</script>";
          } else {
            echo "<script>alert(\" Update Status Fail, PLease Try Again. \");
                    window.location.href='order.php?page=4';</script>";
          }
        }
      }

      // cancel order , when user request cancel or admin need to cancel order
      else if ($type == "order_cancel") {
        if (isset($_POST['btnAction'])) {

          $order_id = $_POST['btnAction'];
          $reason = $_POST['reason'];

          if (!file_exists($_FILES['img']['tmp_name']) || !is_uploaded_file($_FILES['img']['tmp_name'])) { // no upload file will not update img name

            $tablename = "orders";
            $data = "status =?,reason =?, date_modified = ? WHERE id = ?";
            $array = array(1, $reason, $time, $order_id);
            $result_order = $db->update($tablename, $data, $array);
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
                $newfilename = 'CANCEL_PROOF' . round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES["img"]["tmp_name"], "../img/refund/" . $newfilename);
              }
            }

            $tablename = "orders";
            $data = "status =?,reason =?, proof_image=?, date_modified = ? WHERE id = ?";
            $array = array(1, $reason, $newfilename, $time, $order_id);
            $result_order = $db->update($tablename, $data, $array);

            //------------------------------------------
            //			Image Upload End - img
            //------------------------------------------
          }


          if ($result_order) {
            //--------------------------
            //  get order details
            //--------------------------
            $table = "orders";
            $col = "id, customer_email, customer_name, gateway_order_id, reason";
            $opt = 'id = ?';
            $arr = array($order_id);
            $order = $db->advwhere($col, $table, $opt, $arr);
            $customer_email = $order[0]['customer_email'];
            $customer_name = $order[0]['customer_name'];
            $gateway_order_id = $order[0]['gateway_order_id'];
            $reason = $order[0]['reason'];
            //--------------------------

            //------------------------------
            // add product stock
            //------------------------------
            $table = "order_items";
            $col = "product_id, qty";
            $opt = 'order_id = ?';
            $arr = array($order_id);
            $result_order_items = $db->advwhere($col, $table, $opt, $arr);

            // loop all product in item
            foreach ($result_order_items as $item) {

              // get product detail.
              $col = "id, stock";
              $table = "product";
              $opt = 'id = ?';
              $arr = array($item['product_id']);
              $product = $db->advwhere($col, $table, $opt, $arr);

              //if product exists then execute
              if ($product) {

                $product_id = $product[0]["id"];
                $product_stock = $product[0]["stock"];
                $added_prodcut_stock = $product_stock + $item['qty'];

                $tablename = "product";
                $data = "stock = ?, date_modified = ? WHERE id = ?";
                $array = array($added_prodcut_stock, $time, $product_id);
                $result_add_stock = $db->update($tablename, $data, $array);
              } else {
                continue;
              }
            }

            //------------------------------
            // Add product stock
            //------------------------------

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
            $path_login =  $server_path . "login.php";

            $cancel_detail = array("path_login" => $path_login, "user_name" => $customer_name, "order_id" => $gateway_order_id, "reason" => $reason);

            //To address and name
            $mail->addAddress($customer_email);
            $mail->Subject = "ORDER CANCEL";
            // $mail->Body = "Congratulations on successful registration";
            $mail->Body = get_include_contents('mail/order_cancel_mail.php', $cancel_detail);
            // $mail->send();
            // if (!$mail->send()) {
            //   echo "Mailer Error: " . $mail->ErrorInfo;
            // } else {
            //   echo "Message has been sent successfully2";
            // }
            //----------------------------
            //		Email code here(end)
            //----------------------------

            if (!$mail->send()) {
              echo "<script>alert(\" Update Status Successful, But Send Mail Fail\");
                      window.location.href='order.php?page=1';</script>";
            } else {
              echo "<script>alert(\" Update Status Successful\");
                      window.location.href='order.php?page=1';</script>";
            }
          } else {
            echo "<script>alert(\" Update Status Fail. Please Try Again\");
                      window.location.href='order.php?page=1';</script>";
          }
        }
      }
      //--------------------------------------------------
      //                    ORDER
      //--------------------------------------------------

      //--------------------------------------------------
      //              Admin Geo Zone
      //--------------------------------------------------
      else if ($type == "geo_zone_add") {
        if (isset($_POST['btnAction'])) {

          $name = $_POST['name'];
          $description = $_POST['description'];
          $zone = $_POST['zone'];

          // check geo_zone is it isset in database
          $table = "geo_zone";
          $col = "id";
          $opt = 'name = ? && admin_id = ? ';
          $arr = array($name, 0);
          $check_geo_zone_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_geo_zone_isset) == 0) {

            $table = "geo_zone";
            $colname = array("name", "description", "admin_id", "date_created", "date_modified");
            $array = array($name, $description, 0, $time, $time);
            $result_geo_zone = $db->insert($table, $colname, $array);

            if ($result_geo_zone) {
              //--------------------------
              //  get geo_zone id inserted
              //--------------------------
              $table = "geo_zone";
              $col = "id";
              $opt = 'date_created = ?';
              $arr = array($time);
              $geo_zone = $db->advwhere($col, $table, $opt, $arr);
              $geo_zone_id = $geo_zone[0]['id'];
              //--------------------------

              foreach ($zone as $zone) {

                $state_id = $zone;
                // check geo_zone list is it isset in database, if yes, then skip
                $table = "geo_zone_list";
                $col = "id";
                $opt = 'geo_zone_id = ? && state_id = ?';
                $arr = array($geo_zone_id, $state_id);
                $check_geo_zone_list_isset = $db->advwhere($col, $table, $opt, $arr);

                if (count($check_geo_zone_list_isset) != 0) {
                  continue;
                } else {

                  $table = "geo_zone_list";
                  $colname = array("geo_zone_id", "state_id");
                  $array = array($geo_zone_id, $state_id);
                  $result_geo_zone_list = $db->insert($table, $colname, $array);

                  if ($zone == 0) {
                    //delete geo zone list and insert again
                    $result_geo_zone_delete = $db->del("geo_zone_list", 'geo_zone_id', $geo_zone_id);
                    $result_geo_zone_list = $db->insert($table, $colname, $array);
                    break;
                  }
                }
              }

              if ($result_geo_zone_list) {
                echo "<script>alert(\" Add Geo Zone Successful.\");
                          window.location.href='geo_zone.php';</script>";
              } else {
                echo "<script>alert(\" Add Geo Zone Successful, But Add Geo Zone List fail.\");
                        window.location.href='geo_zone.php';</script>";
              }
            } else {
              echo "<script>alert(\" Add Geo Zone Fail. Please try again.\");
                      window.location.href='geo_zone.php';</script>";
            }
          } else {
            echo "<script>alert(\" Geo Zone Exists, Please try again.\");
          window.location.href='geo_zone.php';</script>";
          }
        }
      } else if ($type == "geo_zone_edit") {
        if (isset($_POST['btnAction'])) {

          $geo_zone_id = $_POST['btnAction'];

          $name = $_POST['name'];
          $description = $_POST['description'];
          $zone = $_POST['zone'];

          // check geo_zone is it isset in database
          $table = "geo_zone";
          $col = "id";
          $opt = 'name = ? && admin_id = ? && id != ?';
          $arr = array($name, 0, $geo_zone_id);
          $check_geo_zone_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_geo_zone_isset) == 0) {

            $tablename = "geo_zone";
            $data = "name =?, description=?, date_modified = ? WHERE id = ?";
            $array = array($name, $description, $time, $geo_zone_id);
            $result_geo_zone_update = $db->update($tablename, $data, $array);

            if ($result_geo_zone_update) {

              //delete geo zone list and insert again
              $result_geo_zone_delete = $db->del("geo_zone_list", 'geo_zone_id', $geo_zone_id);

              foreach ($zone as $zone) {

                $state_id = $zone;
                // check geo_zone list is it isset in database, if yes, then skip
                $table = "geo_zone_list";
                $col = "id";
                $opt = 'geo_zone_id = ? && state_id = ?';
                $arr = array($geo_zone_id, $state_id);
                $check_geo_zone_list_isset = $db->advwhere($col, $table, $opt, $arr);

                if (count($check_geo_zone_list_isset) != 0) {
                  continue;
                } else {
                  $table = "geo_zone_list";
                  $colname = array("geo_zone_id", "state_id");
                  $array = array($geo_zone_id, $state_id);
                  $result_geo_zone_list = $db->insert($table, $colname, $array);

                  if ($zone == 0) {
                    //delete geo zone list and insert again
                    $result_geo_zone_delete = $db->del("geo_zone_list", 'geo_zone_id', $geo_zone_id);
                    $result_geo_zone_list = $db->insert($table, $colname, $array);
                    break;
                  }
                }
              }

              if ($result_geo_zone_list) {
                echo "<script>alert(\" Edit Geo Zone Successful.\");
                          window.location.href='geo_zone.php';</script>";
              } else {
                echo "<script>alert(\" Edit Geo Zone Successful, But Add Geo Zone List fail.\");
                          window.location.href='geo_zone.php';</script>";
              }
            } else {
              echo "<script>alert(\" Edit Geo Zone Fail. Please try again.\");
                      window.location.href='geo_zone.php';</script>";
            }
          } else {
            echo "<script>alert(\" Geo Zone Exists, Please try again.\");
        window.location.href='geo_zone.php';</script>";
          }
        }
      } else if ($type == "geo_zone_delete") {
        if (isset($_POST['btnAction'])) {

          $geozone_id = $_POST['btnAction'];

          $result_geo_zone_delete = $db->del("geo_zone", 'id', $geozone_id);
          if ($result_geo_zone_delete) {
            echo "<script>alert(\" Delete GeoZone Successful.\");
                          window.location.href='geo_zone.php';</script>";
          } else {
            echo "<script>alert(\" Delete GeoZone Fail. Please try again.\");
                      window.location.href='geo_zone.php';</script>";
          }
        }
      }
      //--------------------------------------------------
      //              Admin Geo Zone
      //--------------------------------------------------


      //--------------------------------------------------
      //              Admin Shipping
      //--------------------------------------------------

      else if ($type == "shipping_add") {
        if (isset($_POST['btnAction'])) {

          $name = $_POST['name'];
          $geo_zone = $_POST['zone'];
          $first_weight = $_POST['first_weight'];
          $first_price = $_POST['first_price'];
          $next_weight = $_POST['next_weight'];
          $next_price = $_POST['next_price'];
          $charge = $_POST['charge'];

          // check geo_zone is it isset in database
          $table = "shipping";
          $col = "id";
          $opt = 'name = ? && admin_id = ?';
          $arr = array($name, 0);
          $check_shipping_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_shipping_isset) == 0) {

            $table = "shipping";
            $colname = array("name", "geo_zone", "first_weight", "first_price", "next_weight", "next_price", "charge", "admin_id", "status", "date_created", "date_modified");
            $array = array($name, $geo_zone, $first_weight, $first_price, $next_weight, $next_price, $charge, 0, 1, $time, $time);
            $result_shipping = $db->insert($table, $colname, $array);

            if ($result_shipping) {
              echo "<script>alert(\" Add Shipping Successful.\");
                          window.location.href='shipping.php';</script>";
            } else {
              echo "<script>alert(\" Add Shipping Fail. Please try again.\");
                      window.location.href='shipping.php';</script>";
            }
          } else {
            echo "<script>alert(\" Shipping Exists, Please try again.\");
           window.location.href='shipping.php';</script>";
          }
        }
      } else if ($type == "shipping_edit") {
        if (isset($_POST['btnAction'])) {

          $shipping_id = $_POST['btnAction'];

          $name = $_POST['name'];
          $geo_zone = $_POST['zone'];
          $first_weight = $_POST['first_weight'];
          $first_price = $_POST['first_price'];
          $next_weight = $_POST['next_weight'];
          $next_price = $_POST['next_price'];
          $charge = $_POST['charge'];
          $status = $_POST['status'];

          // check geo_zone is it isset in database
          $table = "shipping";
          $col = "id";
          $opt = 'name = ? && admin_id = ? && id != ?';
          $arr = array($name, 0, $shipping_id);
          $check_shipping_isset = $db->advwhere($col, $table, $opt, $arr);

          if (count($check_shipping_isset) == 0) {

            $tablename = "shipping";
            $data = "name =?, geo_zone =?, first_weight =?, first_price =?, next_weight =?, next_price =?, charge =?, status =?, date_modified = ? WHERE id = ?";
            $array = array($name, $geo_zone, $first_weight, $first_price, $next_weight, $next_price, $charge, $status, $time, $shipping_id);
            $result_shipping_edit = $db->update($tablename, $data, $array);

            if ($result_shipping_edit) {
              echo "<script>alert(\" Edit Shipping Successful.\");
                          window.location.href='shipping.php';</script>";
            } else {
              echo "<script>alert(\" Edit Shipping Fail. Please try again.\");
                      window.location.href='shipping.php';</script>";
            }
          } else {
            echo "<script>alert(\" Shipping Exists, Please try again.\");
         window.location.href='shipping.php';</script>";
          }
        }
      } else if ($type == "shipping_delete") {
        if (isset($_POST['btnAction'])) {

          $shipping_id = $_POST['btnAction'];

          $result_shipping_delete = $db->del("shipping", 'id', $shipping_id);
          if ($result_shipping_delete) {
            echo "<script>alert(\" Delete Shipping Successful.\");
                          window.location.href='shipping.php';</script>";
          } else {
            echo "<script>alert(\" Delete Shipping Fail. Please try again.\");
                      window.location.href='shipping.php';</script>";
          }
        }
      }

      //--------------------------------------------------
      //              Admin Shipping
      //--------------------------------------------------

      //--------------------------------------------------
      //                 POINT VALUE
      //--------------------------------------------------

      else if ($type == "point_value_edit") {
        if (isset($_POST['btnAction'])) {

          $point_id = $_POST['btnAction'];
          $point_value = $_POST['point_value'];

          $table = "reward_point_value";
          $data = "value = ? WHERE id = ?";
          $array = array($point_value, $point_id);
          $result_point_value = $db->update($table, $data, $array);

          if ($result_point_value) {
            echo "<script>alert(\" Edit Point Value Successful\");
              window.location.href='index.php';</script>";
          } else {
            echo "<script>alert(\" Edit Point Value Fail, PLease Try Again. \");
              window.location.href='index.php';</script>";
          }
        }
      }

      //--------------------------------------------------
      //               POINT VALUE
      //--------------------------------------------------

      //--------------------------------------------------
      //                 GST VALUE
      //--------------------------------------------------

      else if ($type == "gst_value_edit") {
        if (isset($_POST['btnAction'])) {

          $gst_id = $_POST['btnAction'];
          $gst_value = $_POST['gst_value'];

          $table = "gst_value";
          $data = "value = ? WHERE id = ?";
          $array = array($gst_value, $gst_id);
          $result_gst_value = $db->update($table, $data, $array);

          if ($result_gst_value) {
            echo "<script>alert(\" Edit GST Value Successful\");
              window.location.href='index.php';</script>";
          } else {
            echo "<script>alert(\" Edit GST Value Fail, PLease Try Again. \");
              window.location.href='index.php';</script>";
          }
        }
      }

      //--------------------------------------------------
      //               GST VALUE
      //--------------------------------------------------

      //--------------------------------------------------
      //                 Coupon Email VALUE
      //--------------------------------------------------

      else if ($type == "coupon_email_edit") {
        if (isset($_POST['btnAction'])) {

          $coupon_email_id = $_POST['btnAction'];
          $coupon_id = $_POST['coupon_email'];

          $table = "coupon_email";
          $data = "coupon_id = ? WHERE id = ?";
          $array = array($coupon_id, $coupon_email_id);
          $result_coupon_email = $db->update($table, $data, $array);

          if ($result_coupon_email) {
            echo "<script>alert(\" Edit Coupon Email Successful\");
              window.location.href='index.php';</script>";
          } else {
            echo "<script>alert(\" Edit Coupon Email Fail, PLease Try Again. \");
              window.location.href='index.php';</script>";
          }
        }
      }

      //--------------------------------------------------
      //               Coupon Email VALUE
      //--------------------------------------------------

    } // table admin
  } else {
    echo "Token Expired. Please Try Again";
  }
} else {
  echo "Token Is Required.";
}
