<?php
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();
$obj->loginCheck();
if ($_SESSION['Login_data']['is_admin'] == 0){
    $_SESSION['Errors_R'] = "You don't have permission to access this page"."<br>"."<a href=\"profile.php\">Go to profile</a>";
    header("location:errors.php?id=" . $_SESSION['Login_data']['unique_id']);
}

$allData = $obj->index();

// Counter
$countNewOrder = $obj->countNewOrder();
$countCompleteOrder = $obj->countCompleteOrder();
$countUsers = $obj->countUsers();
$countTrashUser = $obj->countTrashUser();

include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";

?>
<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row mtb60">
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked bag">
                            <use xlink:href="#stroked-bag"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?php echo $countNewOrder['is_new']; ?></div>
                        <div class="text-muted">New Orders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked email">
                            <use xlink:href="#stroked-email"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?php echo $countCompleteOrder['is_accept']; ?></div>
                        <div class="text-muted">CompleteOrders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?php echo $countUsers['id'];?></div>
                        <div class="text-muted">Total Users</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked basket ">
                            <use xlink:href="#stroked-basket"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?php echo $countTrashUser['is_delete'];?></div>
                        <div class="text-muted">Suspend Users</div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.counter-section-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">All user list</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <strong class="success"><?php $obj->validationMessage("Login") ?></strong>
                            <strong class="success"><?php $obj->validationMessage("Res_Acc") ?></strong>
                            <strong class="error"><?php $obj->validationMessage("Sus_Acc") ?></strong>
                            <div class="table-responsive mtb30">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>FB Profile URL</th>
                                        <th>Action</th>
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
                                            <td><?php echo $onedata['phone'] ?></td>
                                            <td><?php echo $onedata['fb_profile_url'] ?></td>
                                            <td><a href="show.php?id=<?php echo $onedata['unique_id'] ?>" data-toggle="tooltip" data-placement="top" title="View">
                                                    <svg class="ticon glyph stroked eye"><use xlink:href="#stroked-eye"></use></svg>
                                                </a>
                                                <?php if (!empty($_SESSION['Login_data']['is_admin']) == 1) { ?>
                                                <a href="edit.php?id=<?php echo $onedata['unique_id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <svg class="ticon glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>
                                                </a>
                                                <?php if ($onedata['is_admin'] == 0) { ?>
                                                    <a href="trash.php?id=<?php echo $onedata['unique_id'] ?>"
                                                       onclick="return confirm('Are you sure?');"  data-toggle="tooltip" data-placement="top" title="Suspend">
                                                        <svg class="ticon glyph stroked basket "><use xlink:href="#stroked-basket"></use></svg>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } } else { ?>
                                        <td colspan="6" class="text-center"><strong>No Available Data</strong></td>
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
