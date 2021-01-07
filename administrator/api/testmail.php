<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = 47;
echo "<pre>";
$col = "o.*, o.id as order_id, st.name as state_name, u.name as user_name, o.reason as reason";
$tb = "orders o left join state st on o.customer_state = st.id left join users u on u.id = o.users_id";
$opt = 'o.id = ?';
$arr = array($id);
$order = $db->advwhere($col, $tb, $opt, $arr);
$order = $order[0];


$table = "order_items o left join product p on o.product_id = p.id left join product_translation pt on o.product_id = pt.product_id";
$col = "o.id as id, o.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, o.price as price";
$opt = 'o.order_id = ? AND pt.language = ? ';
$arr = array($id, "en");
$order_item = $db->advwhere($col, $table, $opt, $arr);


// var_dump($order);
// var_dump($order_item);

$order_detail = array("order" => $order, "order_item" => $order_item, "server_path" => $server_path);
// var_dump($order_detail);

//--------------------------
//       for email
//--------------------------
require_once "../vendor/autoload.php";
//PHPMailer Object
$mail = new PHPMailer;
$mail->SMTPDebug = 3;
$mail->isSMTP();
$mail->Host = "mail.caroma.com.my";
$mail->SMTPAuth = true;
$mail->Username = "test@caroma.com.my";
$mail->Password = "=HV[GXQv+7l?";
$mail->SMTPSecure = "tls";
$mail->Port = "587";
//Send HTML or Plain Text email
$mail->isHTML(true);
//From email address and name
$mail->From = "test@caroma.com.my";
$mail->FromName = "Caroma Team";
// $mail->AddEmbeddedImage('../img/product/PROD1601368421.png', 'pic1');
// $mail->AddEmbeddedImage('../img/product/PROD1601370800.png', 'pic2');
// $mail->AddEmbeddedImage('../img/product/PROD1601374119.png', 'pic3');
//--------------------------
//       for email
//--------------------------

//To address and name
$mail->addAddress("puahweewee@gmail.com");
$mail->Subject = "REGISTER SUCCESSFUL 7";
$mail->Body = get_include_contents('../../api/mail.php', $order_detail);
// $mail->send();
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent successfully2";
}
//----------------------------
//		Email code here(end)
//----------------------------
