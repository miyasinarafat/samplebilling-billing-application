<?php
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();


include_once "header.php";
?>

<!--Main Content-->
<div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-1 main">
    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Error Page</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <strong class="error"><?php $obj->validationMessage("Errors_R"); ?></strong>
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

