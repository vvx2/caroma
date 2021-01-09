<?php


// require_once('connection/PDO_db_function.php');
// $db = new DB_Functions(); 
require_once('inc/init.php');
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
            //                 new_arrival Generate 
            //--------------------------------------------------

            else if ($type == "add_new_arrival") {
                if (isset($_POST['btnAction'])) {

                    $new_arrival = $_POST['new_arrival'];

                    // delete prodcut for insert again
                    $delete_new_arrival = $db->delall("new_arrival", 'id', 0);

                    // insert promotion new_arrival
                    foreach ($new_arrival as $new_arrival) {

                        $table = "new_arrival";
                        $colname = array("product_id");
                        $array = array($new_arrival);
                        $result_new_arrival = $db->insert($table, $colname, $array);
                    }

                    if ($result_new_arrival) {
                        echo "<script>alert(\" Add New Arrival Product Successful\");
                                      window.location.href='new_arrival.php';</script>";
                    } else {
                        echo "<script>alert(\" Add New Arrival Product Fail, PLease Try Again. \");
                                      window.location.href='new_arrival.php';</script>";
                    }
                }
            }
            //--------------------------------------------------
            //                    new_arrival Generate
            //--------------------------------------------------

        } // table admin
        else {
            echo "You are not admin";
        }
    } else {
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}
