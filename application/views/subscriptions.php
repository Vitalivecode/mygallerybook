<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Subscriptions</h3>
        <div class="row mt">
            <div class="col-lg-6">
                <?php
                if($pack == null){
                ?>
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> Add Subscription</h4>
                <div class="form-panel">
                    <div class="form" id="form">
                        <form id="packForm" name="packForm" class="cmxform form-horizontal style-form">
                            <div class="form-group ">
                                <label for="sName" class="control-label col-lg-2">Subscription</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="sName" name="sName" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="sMonths" class="control-label col-lg-2">Months</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="sMonths" name="sMonths" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="sAlbums" class="control-label col-lg-2">Albums</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="sAlbums" name="sAlbums" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="sCost" class="control-label col-lg-2">Cost</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="sCost" name="sCost" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="sOfferCost" class="control-label col-lg-2">Offer Cost</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="sOfferCost" name="sOfferCost" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="sDescription" class="control-label col-lg-2">Description</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " id="sDescription" name="sDescription" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-theme" type="submit">Save</button>
                                    <button class="btn btn-theme04" type="reset">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                }
                else{
                    $data = json_decode($pack);
                ?>
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> Update Subscription</h4>
                    <div class="form-panel">
                        <div class="form" id="form">
                            <form id="packForm1" name="packForm1" class="cmxform form-horizontal style-form">
                                <div class="form-group ">
                                    <label for="sName" class="control-label col-lg-2">Subscriptionn</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="sName" name="sName" value="<?= $data->sName ?>" type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="sMonths" class="control-label col-lg-2">Months</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="sMonths" name="sMonths" value="<?= $data->sMonths ?>"  type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="sAlbums" class="control-label col-lg-2">Albums</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="sAlbums" name="sAlbums" value="<?= $data->sAlbums ?>"  type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="sCost" class="control-label col-lg-2">Cost</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="sCost" name="sCost" value="<?= $data->sCost ?>"  type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="sOfferCost" class="control-label col-lg-2">Offer Cost</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="sOfferCost" name="sOfferCost" value="<?= $data->sOfferCost ?>" type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="sDescription" class="control-label col-lg-2">Description</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control " id="sDescription" name="sDescription"  required><?= $data->sDescription ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input class="form-control" id="sId" name="sId" value="<?= $data->sId ?>"  type="hidden" required />
                                        <button class="btn btn-theme" type="submit">Update</button>
                                        <button class="btn btn-theme04" type="reset">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
                  
            </div>
            <div class="col-lg-6">
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> View Subscription</h4>
                <div class="row">
                <?php
                foreach($subscription as $row):
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="custom-box">
                        <div class="servicetitle">
                            <h4><?= $row->sName ?></h4>
                            <hr>
                        </div>
                        <div class="icn-main-container">
                            <span class="icn-container"><i class="fa fa-rupee">&nbsp;<?= $row->sCost ?></i></span>
                        </div>
                        <?php
                        if($row->sName == "Free"){
                            ?><p><br><?= $row->sDescription ?></p><?php
                        }
                        else{
                            ?><p><?= $row->sDescription ?></p><?php
                        }
                        ?>
                        <ul class="pricing">
                            <li><?= $row->sMonths ?> Months</li>
                            <li><?= $row->sAlbums ?> Albums</li>
                        </ul>
                        <button data-toggle="tooltip" title="Edit" class="btn btn-theme edit" value='<?= json_encode($row) ?>'>Edit</button>
                        <?php
                        if($row->sStatus == 1){
                        ?>
                            <button data-toggle="tooltip" title="De Active" class="btn btn-theme03 sactive" value='{"sId" :<?= $row->sId ?>,"sStatus" : <?= $row->sStatus ?> }'>De Active</button><?php
                        }
                        else if($row->sStatus == 0){
                        ?>
                            <button data-toggle="tooltip" title="Active" class="btn btn-theme02 sactive" value='{"sId" :<?= $row->sId ?>,"sStatus" : <?= $row->sStatus ?> }'>Active</button><?php
                        }
                        ?>
                            <button data-toggle="tooltip" title="Delete" class="btn btn-theme04 sactive" value='{"sId" :<?= $row->sId ?>,"sStatus" : 2 }'>Delete</button>
                    </div>
                    </div>
                    <?php
                endforeach;
                ?>
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
    
$('#packForm').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    console.log(formData);
         $.ajax({
            async: true,
            url:'<?=base_url()?>subscription/add',
            dataType: 'json',
            type:"post",
            data:formData,
            success: function(response){
                window.location.href = "subscriptions";
            },
            error: function(response){
                alert(response);
            },
            cache: false,
    		contentType: false,
    		processData: false
        });
});

$(document).on("click",".edit",function(e){
    e.preventDefault();
    var data=$(this).val();
    $.redirect("subscriptions", {"pack":data}, "POST");
});

$('#packForm1').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    console.log(formData);
         $.ajax({
            async: true,
            url:'<?=base_url()?>subscription/edit',
            dataType: 'json',
            type:"post",
            data:formData,
            success: function(response){
                window.location.href = "subscriptions";
            },
            error: function(response){
                alert(response);
            },
            cache: false,
    		contentType: false,
    		processData: false
        });
});

$(document).on("click",".sactive",function(e){
        var data=$(this);
        var pack = JSON.parse(data.val());
        var sId = pack.sId;
        var sStatus = pack.sStatus;
        $.redirect("<?=base_url()?>subscription/active", {"sId":sId,"sStatus":sStatus}, "POST");
    });

});
    
</script>