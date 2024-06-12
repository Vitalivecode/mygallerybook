<!--main content start-->
<section id="main-content" style="padding:5px;">
    <section class="wrapper site-min-height">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="row content-panel">
                    <div class="col-md-7 profile-text mt mb">
                        <div class="right-divider hidden-sm hidden-xs">
                            <div class="row">
                            <?php
                            $i = 0;
                            foreach($customerAddress as $row):
                                $i = $i+1;
                            ?>
                            <div class="col-md-4">
                                <h4>Address <?= $i ?></h4>
                                <p><?= $row->cDoorNo ?></p>
                                <p><?= $row->cStreet ?></p>
                                <p><?= $row->cLandMark ?></p>
                                <p><?= $row->cCity ?></p>
                                <p><?= $row->cPincode ?></p>
                            </div>
                            <?php
                            endforeach;
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 profile-text">
                        <h3><?= $customerProfile->cFName ?>&nbsp;<?= $customerProfile->cLName ?></h3>
                        <p><?= $customerData->cPhone ?></p>
                        <p><?= $customerProfile->cEmail ?></p>
                    </div>
                    <div class="col-md-2 centered">
                        <div class="profile-pic">
                            <p><img src="<?=base_url()?>uploads/profiles/<?= $customerProfile->cPicture ?>" class="img-circle"></p>
                            <p>
                            <?php
                            if($customerData->cStatus == 1){
                            ?>
                                <button data-toggle="tooltip" title="De Active" class="btn btn-theme03 cactive" value='{"cId" :<?= $customerData->cId ?>,"cStatus" : <?= $customerData->cStatus ?> }'>De Active</button><?php
                            }
                            else if($customerData->cStatus == 0){
                            ?>
                                <button data-toggle="tooltip" title="Active" class="btn btn-theme02 cactive" value='{"cId" :<?= $customerData->cId ?>,"cStatus" : <?= $customerData->cStatus ?> }'>Active</button><?php
                            }
                            ?>
                                <button data-toggle="tooltip" title="Delete" class="btn btn-theme04 cactive" value='{"cId" :<?= $customerData->cId ?>,"cStatus" : 2 }'>Delete</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt">
                <div class="row content-panel">
                <div class="panel-heading">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a data-toggle="tab" href="#ordersTab">Orders</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#subscriptionsTab">Subscription Details</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                    <div id="ordersTab" class="tab-pane active">
                        <div class="content-panel">
                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Album ID</th>
                                        <th>Download</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($customerOrders as $row):
                                ?>
                                    <tr>
                                        <th><?= $row->albumId ?></th>
                                        <th><button class="download" value='{"albumId" :"<?= $row->albumId ?>"}' style="border: none;background-color: transparent;"><i class="fa fa-download"></i></button></th>
                                        <th>
                                        <?php
                                        if($row->oStatus == 1){
                                        ?>
                                            Ordered-><button data-toggle="tooltip" title="Received" class="btn btn-theme oStatus" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"2" }'>Received</button><?php
                                        }
                                        else if($row->oStatus == 2){
                                        ?>
                                            Received-><button data-toggle="tooltip" title="Printed" class="btn btn-theme02 oStatus" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"3" }'>Printed</button><?php
                                        }
                                        else if($row->oStatus == 3){
                                        ?>
                                            Printed-><button data-toggle="tooltip" title="Dispatched" class="btn btn-theme03 dispatched" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"4","cPhone" :"<?= $customerData->cPhone ?>" }'>Dispatched</button><?php
                                        }
                                        else if($row->oStatus == 4){
                                        ?>
                                            Dispatched-><button data-toggle="tooltip" title="Delivered" class="btn btn-theme04 oStatus" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"5" }'>Delivered</button><?php
                                        }
                                        else if($row->oStatus == 5){
                                        ?>
                                            <button data-toggle="tooltip" title="Completed" class="btn btn-success">Completed</button><?php
                                        }
                                        ?>
                                        </th>
                                        <th><?= $row->orderAt ?></th>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <div id="subscriptionsTab" class="tab-pane">
                        <div class="content-panel" style="padding:5px;">
                            <div class="adv-table">
                              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                  <tr>
                                    <th class="none">Pack Details</th>
                                    <th>Pack EndDate</th>
                                    <th>Remain Albums</th>
                                    <th>Payment Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($customerPacks as $row):
                                ?>
                                <tr>
                                    <th><?= $row->sName ?><br><i class="fa fa-rupee">&nbsp;<?= $row->sCost ?></i><br><?= $row->sMonths ?> Months <br><?= $row->sAlbums ?> Albums<br><?= $row->sDescription ?></th>
                                    <th><?php echo date('d-m-Y', strtotime($row->sEndDate));?></th>
                                    <th><?= $row->sRemainAlbums ?></th>
                                    <th><?= $row->paymentAt ?></th>
                                </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                              </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</section>

<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery.redirect.js"></script>

<script>
jQuery(function($){
    
    $(document).on("click",".cactive",function(e){
        var data=$(this);
        var customer = JSON.parse(data.val());
        var cId = customer.cId;
        var cStatus = customer.cStatus;
        $.redirect("<?=base_url()?>customer/active", {"cId":cId,"cStatus":cStatus}, "POST");
    });

    $(".download").click(function(){
        var data=$(this);
        var jsondata = JSON.parse(data.val());
        var albumId = jsondata.albumId;
        $.redirect("<?php echo base_url(); ?>owner/download", {albumId}, "POST");
    });
    
    $(document).on("click",".oStatus",function(e){
        var data=$(this);
        var order = JSON.parse(data.val());
        var albumId = order.albumId;
        var oStatus = order.oStatus;
        $.redirect("<?=base_url()?>order/status", {"albumId":albumId,"oStatus":oStatus}, "POST");
    });
    
    $(document).on("click",".dispatched",function(e){
        var data=$(this);
        var order = JSON.parse(data.val());
        var albumId = order.albumId;
        var oStatus = order.oStatus;
        var cPhone = order.cPhone;
        $.redirect("dispatched", {"albumId":albumId,"oStatus":oStatus,"cPhone":cPhone}, "POST");
    });

});
    
</script>