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
                <div class="panel-heading">User Info</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>FB Profile URL</th>
                                        <th>Created</th>
                                        <th>Modified</th>
                                        <th>Restore</th>
                                        <th>Deleted</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $onedata['id']; ?></td>
                                            <td><?php echo $onedata['name'] ?></td>
                                            <td><?php echo $onedata['email'] ?></td>
                                            <td><?php echo $onedata['phone'] ?></td>
                                            <td><?php echo $onedata['fb_profile_url'] ?></td>
                                            <td><?php echo $onedata['created'] ?></td>
                                            <td><?php echo $onedata['modified'] ?></td>
                                            <td><?php echo $onedata['restore'] ?></td>
                                            <td><?php echo $onedata['deleted'] ?></td>
                                        </tr>
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
