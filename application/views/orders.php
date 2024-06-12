    <!--main content start-->
    <section id="main-content" style="padding:5px;">
      <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Orders</h3>
          <div class="row mb">
              
            <div class="content-panel" style="padding:5px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info" width="100%" data-order="[[ 6, &quot;desc&quot; ]]">
                <thead>
                  <tr>
                    <th>Album ID</th>
                    <th>Customer Name</th>
                    <th>Phone&nbsp;Number</th>
                    <th class="none">Remaining&nbsp;Albums</th>
                    <th>Download</th>
                    <th>No of Albums</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th class="none">Subject</th>
                    <th class="none">Re-Order</th>
                    <th class="none">Address</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                foreach($myOrdersData as $row):
                ?>
                <tr>
                    <th><?= $row->albumId ?></th>
                    <th><?= $row->cFName ?>&nbsp;<?= $row->cLName ?></th>
                    <th><?= $row->cPhone ?></th>
                    <th><?= $row->sRemainAlbums ?></th>
                    <th><button class="download" value='{"albumId" :"<?= $row->albumId ?>"}' style="border: none;background-color: transparent;"><i class="fa fa-download"></i></button></th>
                    <th><?= $row->oQuantity ?></th>
                    <th>
                    <?php
                    if($row->oStatus == 1){
                    ?>
                        Ordered<br><button data-toggle="tooltip" title="Received" class="btn btn-theme oStatus" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"2" }'>Received</button><?php
                    }
                    else if($row->oStatus == 2){
                    ?>
                        Received<br><button data-toggle="tooltip" title="Printed" class="btn btn-theme02 oStatus" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"3" }'>Printed</button><?php
                    }
                    else if($row->oStatus == 3){
                    ?>
                        Printed<br><button data-toggle="tooltip" title="Dispatched" class="btn btn-theme03 dispatched" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"4","cPhone" :"<?= $row->cPhone ?>" }'>Dispatched</button><?php
                    }
                    else if($row->oStatus == 4){
                    ?>
                        Dispatched<br><button data-toggle="tooltip" title="Delivered" class="btn btn-theme04 oStatus" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"5" }'>Delivered</button><?php
                    }
                    else if($row->oStatus == 5){
                    ?>
                        <button data-toggle="tooltip" title="Completed" class="btn btn-success">Completed</button><?php
                    }
                    ?>
                    </th>
                     <td><?php echo date('d-m-Y h:i A', strtotime($row->orderAt));?></td> 
                    <!--<td><?php echo $row->orderAt ;?></td>-->
                    <td><?php echo $row->oNote ;?></td>
                    <td><?php echo $row->oReorder ;?></td>
                    <th><?= $row->cDoorNo ?><br><?= $row->cStreet ?><br><?= $row->cLandMark ?><br><?= $row->cCity ?><br><?= $row->cDoorNo ?><br><?= $row->cPincode ?></th>
                </tr>
                <?php
                endforeach;
                ?>
                </tbody>
              </table>
            </div>
          </div>
          
          </div>
      </section>
    </section>
    <!--main content end-->
    
    
<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery.redirect.js"></script>
    
<script>
jQuery(function($){
    
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