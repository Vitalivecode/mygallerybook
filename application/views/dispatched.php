<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Dispatched</h3>
        <div class="row mt">
            <div class="col-lg-9">
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> Add Dispatched Details</h4>
                <div class="form-panel">
                    <div class="form" id="form">
                        <form id="dispatchedForm" name="dispatchedForm" class="cmxform form-horizontal style-form">
                            <div class="form-group ">
                                <label for="albumId" class="control-label col-lg-2">Album Id</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="albumId" name="albumId" value="<?= $albumId ?>"  type="text" required readonly />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cPhone" class="control-label col-lg-2">Customer Phone</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="cPhone" name="cPhone" value="<?= $cPhone ?>"  type="text" required readonly />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="courierN" class="control-label col-lg-2">Courier Name</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="courierN" name="courierN" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="courierTI" class="control-label col-lg-2">Courier Track ID</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="courierTI" name="courierTI" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="courierDate" class="control-label col-lg-2">Courier Date</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="courierDate" name="courierDate" type="date" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <input class="form-control" id="oStatus" name="oStatus" value="<?= $oStatus ?>"  type="hidden" required readonly />
                                    <button class="btn btn-theme" type="submit">Send</button>
                                    <button class="btn btn-theme04" type="reset">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
    
$('#dispatchedForm').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    console.log(formData);
         $.ajax({
            async: true,
            url:'<?=base_url()?>order/dispatched',
            dataType: 'json',
            type:"post",
            data:formData,
            success: function(response){
                window.location.href = "orders";
            },
            error: function(response){
                alert(response);
            },
            cache: false,
    		contentType: false,
    		processData: false
        });
});

});
    
</script>