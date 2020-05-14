<?php
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();
$obj->loginCheck();

$allData = $obj->moneyRequest();

include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";

?>

<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Money Request</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <strong class="success"><?php echo $obj->validationMessage("Accept_M"); ?></strong>
                            <strong class="error"><?php echo $obj->validationMessage("remain_M"); ?></strong>
                            <div class="table-responsive mtb30">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Amount (MYR)</th>
                                        <th>Bkash Transaction ID</th>
                                        <th>Created</th>
                                        <th>Accepted</th>
                                        <th>Remain</th>
                                        <th>Paid or Due</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($allData) && !empty($allData)){

                                        $serial = 1;
                                    foreach ($allData as $onedata) {
                                        ?>
                                        <tr>
                                            <td><?php echo $serial++; ?></td>
                                            <td><?php echo $onedata['name'] ?></td>
                                            <td><?php echo $onedata['email'] ?></td>
                                            <td><?php echo $onedata['amount'] ?></td>
                                            <td><?php echo $onedata['bkasht_id'] ?></td>
                                            <td><?php echo $onedata['created'] ?></td>
                                            <td><?php echo $onedata['accepted'] ?></td>
                                            <td><?php echo $onedata['remain'] ?></td>
                                            <td>
                                                    <a href="request-accept.php?accept_id=1&new_id=1&id=<?php echo $onedata['unique_id']; ?>" data-toggle="tooltip" data-placement="top" title="Paid">
                                                        <svg class="ticon glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>

                                                    </a>
                                                    <a href="request-accept.php?accept_id=0&new_id=1&id=<?php echo $onedata['unique_id']; ?>" data-toggle="tooltip" data-placement="top" title="Due">
                                                        <svg class="ticon glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>

                                                    </a>
                                        </tr>
                                    <?php } } else { ?>
                                        <td colspan="9" class="text-center"><strong>No Available Data</strong></td>
                                    <?php } ?>
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


<?php
include_once "footer.php"
?>
