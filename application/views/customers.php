    <!--main content start-->
    <section id="main-content" style="padding:5px;">
      <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Customers</h3>
          <div class="row mb">
              
              <div class="content-panel" style="padding:5px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info" width="100%">
                <thead>
                  <tr>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Email Id</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                foreach($customers as $row):
                ?>
                <tr>
                    <th><?= $row->cFName ?><?= $row->cLName ?></th>
                    <th><?= $row->cPhone ?></th>
                    <th><?= $row->cEmail ?></th>
                    <th><button data-toggle="tooltip" title="Complete Profile" class="btn btn-theme cProfile" value='{"cId" :<?= $row->cId ?>}'>Complete Profile</button></th>
                    <td><?php echo date('d-m-y h:i A', strtotime($row->createdAt));?></td> 
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

$(document).on("click",".cProfile",function(e){
        var data=$(this);
        var customer = JSON.parse(data.val());
        var cId = customer.cId;
        $.redirect("<?=base_url()?>o/completeProfile", {"cId":cId}, "POST");
});

});
    
</script>