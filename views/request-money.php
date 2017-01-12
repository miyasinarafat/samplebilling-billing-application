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
                <div class="panel-heading">Request Money</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <strong class="success"><? $obj->validationMessage("orderS") ?></strong>
                            <form id="request-moneyf" class="form-horizontal request-money-form mtb30"
                                  action="request-store.php" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="amount">Amount (MYR)</label>
                                        <div class="col-md-9">
                                            <input onchange="showIData()" id="amount" name="amount" type="number"
                                                   placeholder="Amount (MYR)" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="bkasht_id">Bkash T ID</label>
                                        <div class="col-md-9">
                                            <input onchange="showIData()" id="bkasht_id" name="bkasht_id" type="number"
                                                   placeholder="Bkash Transaction ID" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary btnNext">Next</button>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="field-hidden">
                                    <div class="mtb30">
                                        <h3>Conform your order</h3>
                                        <p>
                                            Amount (MYR): <strong id="amountshow"></strong><br>
                                            Bkash Transaction ID: <strong id="bkasht_idshow"></strong>
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-success btnPrev">Previous</button>
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                </fieldset>
                                <script>
                                    function showIData() {
                                        var amount = document.getElementById("amount");
                                        var amountshow = document.getElementById('amountshow');
                                        amountshow.innerHTML = amount.value;

                                        var bkasht_id = document.getElementById("bkasht_id");
                                        var bkasht_idshow = document.getElementById('bkasht_idshow');
                                        bkasht_idshow.innerHTML = bkasht_id.value;
                                    }
                                </script>
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
