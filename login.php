<?
include_once "src/SampleBilling.php";
use App\SampleBilling\SampleBilling;

$obj = new SampleBilling();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SampleBilling - Billing Application</title>

    <link href="views/css/bootstrap.min.css" rel="stylesheet">
    <link href="views/css/styles.css" rel="stylesheet">
    <link href="views/css/custom.css" rel="stylesheet">
    <!--Icons-->
    <script src="views/js/lumino.glyphs.js"></script>
    <!--[if lt IE 9]>
    <script src="views/js/html5shiv.min.js"></script>
    <script src="views/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                <strong class="error"><? $obj->validationMessage("Is_D") ?></strong>
                <strong class="error"><? $obj->validationMessage("U_P") ?></strong>
                <strong class="success"><? $obj->validationMessage("Logout_M") ?></strong>

                <form class="mtb30" role="form" action="log-store.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="log_email" type="email" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="log_password" type="password" required>
                        </div>
                        <button class="btn btn-primary">Login</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
<script src="views/js/jquery.min.js"></script>
<script src="views/js/bootstrap.min.js"></script>
<script src="views/js/bootstrap-table.js"></script>
<script src="views/js/main.js"></script>
</body>
</html>