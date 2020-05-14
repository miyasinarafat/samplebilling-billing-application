<?php
//include_once "../vendor/autoload.php";
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();
$obj->prepare($_GET);
$profilData = $obj->show();

include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";
?>

<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Update User Profile</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <strong class="success"><?php $obj->validationMessage("Pro_U"); ?></strong>
                            <form class="mtb30" role="form" action="update.php" method="post">
                                <div class="form-group">
                                    <label>Update Name</label>
                                    <input class="form-control" placeholder="Update Name" type="text" name="name" required value="<?php echo $profilData['name'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Update Password</label>
                                    <input class="form-control" placeholder="Update Password" type="password" name="password" required value="<?php echo $profilData['password'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Update Email</label>
                                    <input class="form-control" placeholder="Update Email" type="email" name="email" required  value="<?php echo $profilData['email'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Update Phone</label>
                                    <input class="form-control" placeholder="Update Phone" type="number" name="phone" required  value="<?php echo $profilData['phone'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Update FB Profile Link</label>
                                    <input class="form-control" placeholder="Update Facebook Profile Link" type="url" name="fb_profile_url" required value="<?php echo $profilData['fb_profile_url'];?>">
                                    <input type="hidden" name="id" value="<?php echo $profilData['unique_id'];?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </form>
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

