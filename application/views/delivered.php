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
                    <th>Phone Number</th>
                    <th class="none">Remaining&nbsp;Albums</th>
                    <th>No of Albums</th>
                    <th>Action</th>
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
                    <th><?= $row->oQuantity ?></th>
                    <th><button data-toggle="tooltip" title="Delivered" class="btn btn-theme04 oStatus" value='{"albumId" :"<?= $row->albumId ?>","oStatus" :"5" }'>Delivered</button></th>
                    <td><?php echo date('d-m-y h:i A', strtotime($row->orderAt));?></td>
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
    
    $(document).on("click",".oStatus",function(e){
        var data=$(this);
        var order = JSON.parse(data.val());
        var albumId = order.albumId;
        var oStatus = order.oStatus;
        $.redirect("<?=base_url()?>order/status", {"albumId":albumId,"oStatus":oStatus}, "POST");
    });
    
    
});
</script>