<?
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();
$obj->loginCheck();
if ($_SESSION['Login_data']['is_admin'] == 1) {
    $allData = $obj->transactionIndexForAdmin();
} else {
    $allData = $obj->transactionIndex();
}


include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";

?>

<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Transaction History</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <? if ($_SESSION['Login_data']['is_admin'] == 1) { ?>
                                            <th>Name</th>
                                            <th>Email</th>
                                        <? } ?>
                                        <th>Amount (MYR)</th>
                                        <th>Bkash Transaction ID</th>
                                        <th>Created</th>
                                        <th>Accepted</th>
                                        <th>Remain</th>
                                        <? if ($_SESSION['Login_data']['is_admin'] == 1) { ?>
                                        <th>Paid or Due & Accept Order</th>
                                        <? } else {?>
                                        <th>Paid or Due</th>
                                        <? } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    if (isset($allData) && !empty($allData)){

                                    $serial = 1;
                                    foreach ($allData as $onedata) {
                                        ?>
                                        <tr>
                                            <td><?php echo $serial++; ?></td>
                                            <? if ($_SESSION['Login_data']['is_admin'] == 1) { ?>
                                                <td><?php echo $onedata['name'] ?></td>
                                                <td><?php echo $onedata['email'] ?></td>
                                            <? } ?>
                                            <td><?php echo $onedata['amount'] ?></td>
                                            <td><?php echo $onedata['bkasht_id'] ?></td>
                                            <td><?php echo $onedata['created'] ?></td>
                                            <td><?php echo $onedata['accepted'] ?></td>
                                            <td><?php echo $onedata['remain'] ?></td>
                                            <td>
                                                <? if ($onedata['is_accept'] == 1) { ?>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Paid">
                                                        <svg class="ticong glyph stroked checkmark">
                                                            <use xlink:href="#stroked-checkmark"></use>
                                                        </svg>

                                                    </a>
                                                <? } else { ?>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Due">
                                                        <svg class="ticonr glyph stroked cancel">
                                                            <use xlink:href="#stroked-cancel"></use>
                                                        </svg>

                                                    </a>
                                                <? } ?>
                                                <?
                                                if ($_SESSION['Login_data']['is_admin'] == 1) {
                                                    if ($onedata['is_accept'] == 0) { ?>
                                                        <a href="request-accept.php?accept_id=1&new_id=1&id=<? echo $onedata['unique_id']; ?>"
                                                           data-toggle="tooltip" data-placement="top" title="Accept Order">
                                                            <svg class="ticon glyph stroked checkmark">
                                                                <use xlink:href="#stroked-checkmark"></use>
                                                            </svg>

                                                        </a>
                                                    <? }
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php } } else {  if ($_SESSION['Login_data']['is_admin'] == 1) {?>
                                        <td colspan="9" class="text-center"><strong>No Available Data</strong></td>
                                    <? } else { ?>
                                        <td colspan="7" class="text-center"><strong>No Available Data</strong></td>
                                    <? } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>
<!--/Main Content-->


<?
include_once "footer.php"
?>
