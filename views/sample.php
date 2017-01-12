<?
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();
$obj->loginCheck();



include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";

?>

<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">All user list</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

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
