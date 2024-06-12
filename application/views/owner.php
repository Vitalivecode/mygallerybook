<style>
    .card-box{
        padding:0px;
        margin:0px;
        box-shadow: 0px 3px 2px #aab2bd;
    }
    .ta{
       background-color: #d95b11;
    }
    /*.ta .active,.ta:hover{*/
    /*    background:#f9cb68 !important;*/
    /*}*/
    .oa{
        background-color: #575aa0; 
    }
    .ra{
       background-color: #1e88e5; 
    }
    .pa{
       background-color: #ff9800; 
    }
    .da{
       background-color: #cddc39; 
    }
    .ca{
       background-color: #3ba251; 
    }
    .order,.pack{
        background: transparent;
        border: none;
        width:100%;
    }
    
</style>
    <!--main content start-->
    <section id="main-content" style="padding:5px;">
        <section class="wrapper">
            <h1 class="green-panel" style="color: white;"><button class="order" value='{"oStatus" : "All","orderAt" : "<?= date('d-m-Y') ?>"}'><i class="fa fa-trophy"></i> Today Albums <?= $TallOrders ?> </button></h1>
            <div class="row">
                <!--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">-->
                <!--    <div class="custom-box card-box">-->
                <!--        <div class="servicetitle">-->
                <!--            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Today Albums</h4>-->
                <!--            <hr>-->
                <!--        </div>-->
                <!--        <div class="icn-main-container">-->
                <!--            <button class="order" value='{"oStatus" : "All","orderAt" : "<?= date('d-m-Y') ?>"}'>-->
                <!--                <span class="icn-container ta"><?= $TallOrders ?></span>-->
                <!--            </button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Ordered</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order" value='{"oStatus" : "1","orderAt" : "<?= date('d-m-Y') ?>"}'>
                                <span class="icn-container oa"><?= $Tordered ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Received</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order" value='{"oStatus" : "2","orderAt" : "<?= date('d-m-Y') ?>"}'>
                                <span class="icn-container ra"><?= $Treceived ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Printed</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order" value='{"oStatus" : "3","orderAt" : "<?= date('d-m-Y') ?>"}'>
                                <span class="icn-container pa"><?= $Tprinted ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Dispatched</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order" value='{"oStatus" : "4","orderAt" : "<?= date('d-m-Y') ?>"}'>
                                <span class="icn-container da"><?= $Tdispatched ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Delivered</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order" value='{"oStatus" : "5","orderAt" : "<?= date('d-m-Y') ?>"}'>
                                <span class="icn-container ca"><?= $Tdelivered ?></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <h1 class="darkblue-panel" style="color: white;"><button class="order"  value='{"oStatus" : "All","orderAt" : "All"}'><i class="fa fa-trophy"></i> Total Albums <?= $allOrders ?> </button></h1>
            <div class="row">
                <!--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">-->
                <!--    <div class="custom-box card-box">-->
                <!--        <div class="servicetitle">-->
                <!--            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Total Albums</h4>-->
                <!--            <hr>-->
                <!--        </div>-->
                <!--        <div class="icn-main-container">-->
                <!--            <button class="order"  value='{"oStatus" : "All","orderAt" : "All"}'>-->
                <!--                <span class="icn-container ta"><?= $allOrders ?></span>-->
                <!--            </button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Ordered</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order"  value='{"oStatus" : "1","orderAt" : "All"}'>
                                <span class="icn-container oa"><?= $ordered ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Received</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order"  value='{"oStatus" : "2","orderAt" : "All"}'>
                                <span class="icn-container ra"><?= $received ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Printed</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order"  value='{"oStatus" : "3","orderAt" : "All"}'>
                                <span class="icn-container pa"><?= $printed ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Dispatched</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order"  value='{"oStatus" : "4","orderAt" : "All"}'>
                                <span class="icn-container da"><?= $dispatched ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="custom-box card-box">
                        <div class="servicetitle">
                            <h4><i class="fa fa-shopping-cart"></i>&nbsp;Delivered</h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <button class="order"  value='{"oStatus" : "5","orderAt" : "All"}'>
                                <span class="icn-container ca"><?= $delivered ?></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <h3><i class="fa fa-angle-right"></i> Subscription Pack Details</h3>
            <div class="row">
                <div class="col-md-3 col-sm-3 mb">
                <button class="pack"  value='{"sId" : "4"}'>
                    <div class="white-panel pn">
                        <div class="white-header">
                            <h5>Free</h5>
                        </div>
                        <h1 class="mt"><i class="fa fa-star-o fa-2x"></i></h1>
                        <footer>
                        <div class="centered">
                            <h1><?= $free ?></h1>
                        </div>
                        </footer>
                    </div>
                </button>
                </div>
                <div class="col-md-3 col-sm-3 mb">
                <button class="pack"  value='{"sId" : "1"}'>
                    <div class="grey-panel pn">
                        <div class="grey-header">
                            <h5>Basic</h5>
                        </div>
                        <h1 class="mt"><i class="fa fa-star-half fa-2x"></i></h1>
                        <footer>
                        <div class="centered">
                            <h1><?= $basic ?></h1>
                        </div>
                        </footer>
                    </div>
                </button>
                </div>
                <div class="col-md-3 col-sm-3 mb">
                <button class="pack"  value='{"sId" : "2"}'>
                    <div class="darkblue-panel pn">
                        <div class="darkblue-header">
                            <h5>Standard</h5>
                        </div>
                        <h1 class="mt"><i class="fa fa-star-half-o fa-2x"></i></h1>
                        <footer>
                        <div class="centered">
                            <h1><?= $standard ?></h1>
                        </div>
                        </footer>
                    </div>
                </button>
                </div>
                <div class="col-md-3 col-sm-3 mb">
                <button class="pack"  value='{"sId" : "3"}'>
                    <div class="green-panel pn">
                        <div class="green-header">
                            <h5>Premium</h5>
                        </div>
                        <h1 class="mt"><i class="fa fa-star fa-2x"></i></h1>
                        <footer>
                        <div class="centered">
                            <h1><?= $premium ?></h1>
                        </div>
                        </footer>
                    </div>
                </button>
                </div>
            </div>
            <div class="mt mb white-panel">
                <h1 style>Total Amount <?= $amount; ?></h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="product-panel-2 pn" style="height:200px;">
                  <div class="badge badge-hot mt"><?= count($customers); ?></div>
                  <h1 style="color:#ed5565;"><i class="fa fa-users fa-2x mt"></i></h1>
                  <button class="btn btn-small btn-theme04 customers">CUSTOMERS</button>
                </div>
              </div
            </div>
        </section>
    </section>
    <!--main content end-->
    
    
<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery.redirect.js"></script>

<script>
jQuery(function($){
    
    $(document).on("click",".order",function(e){
        var data=$(this);
        var order = JSON.parse(data.val());
        var orderAt = order.orderAt;
        var oStatus = order.oStatus;
        $.redirect("orders", {"orderAt":orderAt,"oStatus":oStatus}, "POST");
    });
    
    $(document).on("click",".pack",function(e){
        var data=$(this);
        var pack = JSON.parse(data.val());
        var sId = pack.sId;
        $.redirect("payments", {"sId":sId}, "POST");
    });
    
    $(document).on("click",".customers",function(e){
        $.redirect("customers");
    });
    
});
</script>