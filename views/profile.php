<?php
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();
$obj->loginCheck();

$obj->prepare($_GET);

$onedata = $obj->show();


include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";

?>

<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">User Profile</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <strong class="success"><?php $obj->validationMessage("Login") ?></strong>

                            <h3>Name: <?php echo $onedata['name'] ?></h3>
                            <h3>Email: <?php echo $onedata['email'] ?></h3>
                            <h3>Phone: <?php echo $onedata['phone'] ?></h3>
                            <h3>FB Profile URL: <a href="<?php echo $onedata['fb_profile_url'] ?>">Checkout Here</a></h3>
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
