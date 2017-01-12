<?
//include_once "../vendor/autoload.php";
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();

include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";
?>

<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add New User</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <strong class="success"><? $obj->validationMessage("storeSuccess"); ?></strong>
                            <form class="mtb30" role="form" action="store.php" method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" placeholder="Name" type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" placeholder="Password" type="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" placeholder="Email" type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" placeholder="Phone" type="number" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label>FB Profile Link</label>
                                    <input class="form-control" placeholder="Facebook Profile Link" type="url" name="fb_profile_url" required>
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

<?
include_once "footer.php"
?>

