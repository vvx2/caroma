<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();
$id = $_REQUEST['p'];

$col = "dw.*, u.name as distributor_name, ud.*";
$tb = "distributor_wallet_transaction dw left join users u on dw.distributor_id = u.id left join user_distributor ud on dw.distributor_id = ud.user_id";
$opt = 'dw.id = ?';
$arr = array($id);
$refund = $db->advwhere($col, $tb, $opt, $arr);
$refund = $refund[0];

$status = $refund['status'];

switch ($status) {
    case "1":
        $status_color = "bg-yellow";
        $status_show = "Pending";
        $status_desc = "This refund request is pending.";
        break;
    case "2":
        $status_color = "bg-green";
        $status_show = "Success";
        $status_desc = "The refund request was approved.";
        break;
    case "3":
        $status_color = "bg-danger";
        $status_show = "Rejected";
        $status_desc = "This refund request was rejected.";
        break;
    default:
        $status_color = "";
        $status_show = "";
        $status_desc = "";
}


?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Refund Requst Details</h4>

</div>
<div class="modal-body">


    <div class="ibox-content">
        <div class="col-lg-12">
            <div class="contact-box ">

                <h2 class="m-b-xs"><strong><?php echo $status_show; ?></strong><br><span class=""><?php echo $status_desc; ?><span></h2>


                <br>
                <table class="table">

                    <thead>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Distributor Name</td>
                            <td><?php echo $refund["distributor_name"]; ?></td>
                        </tr>
                        <?php if ($status == 3) { ?>
                            <tr>
                                <td>Reject Reason</td>
                                <td><?php echo $refund["reason"]; ?></td>
                            </tr>
                        <?php  } ?>
                        <tr>
                            <td>Amount requested for refund</td>
                            <td><strong>RM <?php echo number_format($refund['amount'], 2) ?></strong></td>
                        </tr>
                        <tr>
                            <td>Distributor Wallet</td>
                            <td>RM <?php echo number_format($refund['distributor_wallet'], 2) ?></td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td><?php echo $refund["bank_name"]; ?></td>
                        </tr>
                        <tr>
                            <td>Bank Account</td>
                            <td><?php echo $refund["bank_account"]; ?></td>
                        </tr>

                        <?php if ($status == 2) { ?>
                            <tr>
                                <td>Proof</td>
                                <td>
                                    <a href="../img/refund/<?php echo $refund['image']; ?>" target="_blank">
                                        <span hidden></span>
                                        <i style="color:blue" class="fa fa-chevron-circle-right fa-lg"> View</i>
                                    </a>
                                </td>
                            </tr>
                        <?php  } ?>
                        <tr>
                            <td>Date Create</td>
                            <td><?php echo $refund['date_created']; ?></td>
                        </tr>
                        <tr>
                            <td>Date Approve</td>
                            <td><?php echo $refund['date_modified']; ?></td>
                        </tr>
                        <?php if ($status != 1) { ?>
                            <tr>
                                <td>
                                    <?php
                                    if ($status == 2) {
                                        echo "Approved By";
                                    } else {
                                        echo "Rejected By";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $admin = $db->where('user_nickname', 'admin', 'user_id', $refund['admin_id']);
                                    $admin = $admin[0];
                                    echo $admin['user_nickname'];
                                    ?>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
</div>