<?php
include_once "../src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();
$obj->loginCheck();
if ($_SESSION['Login_data']['is_admin'] == 0){
    $_SESSION['Errors_R'] = "You don't have permission to access this page"."<br>"."<a href=\"profile.php\">Go to profile</a>";
    header("location:errors.php?id=" . $_SESSION['Login_data']['unique_id']);
}

$allData = $obj->indexTrash();


include_once "header.php";
include_once "navbar.php";
include_once "sidebar.php";

?>
<!--Main Content-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row mtb60">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Trash user list</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <strong class="error"><?php $obj->validationMessage("Sus_Acc") ?></strong>
                            <strong class="error"><?php $obj->validationMessage("dele_Acc") ?></strong>
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
                                            <td><a href="restore.php?id=<?php echo $onedata['unique_id'] ?>" onclick="return confirm('Are you sure?');" data-toggle="tooltip" data-placement="top" title="Restore">
                                                    <svg class="ticon glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
                                                </a>
                                                <?php if ($onedata['is_admin'] == 0) { ?>
                                                    <a href="delete.php?id=<?php echo $onedata['unique_id'] ?>"
                                                       onclick="return confirm('Are you sure? If you delete this user then will delete this user all data');"  data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <svg class="ticon glyph stroked basket "><use xlink:href="#stroked-basket"></use></svg>
                                                    </a>
                                                <?php } ?>
                                            </td>
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
