<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Templates</h3>
        <div class="row mt">
            <div class="col-lg-6">
                <?php
                if($temp == null){
                ?>
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> Add Template</h4>
                <div class="form-panel">
                    <div class="form" id="form">
                        <form id="tempForm" name="tempForm" class="cmxform form-horizontal style-form">
                            <div class="form-group ">
                                <label for="tImage" class="control-label col-lg-2">Image</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="tImage" name="tImage" type="file" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="tURL" class="control-label col-lg-2">URL</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="tURL" name="tURL" type="text" required />
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
                    $data = json_decode($temp);
                ?>
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> Edit Template</h4>
                <div class="form-panel">
                    <div class="form" id="form">
                        <form id="tempForm1" name="tempForm1" class="cmxform form-horizontal style-form">
                            <div class="form-group ">
                                <label for="tImage" class="control-label col-lg-2">Image</label>
                                <div class="col-lg-10">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="<?php echo base_url(); ?>uploads/templates/<?= $data->tImage ?>" alt="" />
                                        </div>
                                        <div>
                                            <input class="form-control" id="tImage" name="tImage" type="file" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="tURL" class="control-label col-lg-2">URL</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="tURL" name="tURL" value="<?= $data->tURL ?>" type="text" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <input class="form-control" id="tId" name="tId" value="<?= $data->tId ?>"  type="hidden" required />
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
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> View Templates</h4>
            <?php
                foreach($templates as $row):
            ?>
                <div class="content-panel pn" style="height: 330px;">
                    <div id="profile-02" style="min-height: 250px;background: url(<?php echo base_url(); ?>uploads/templates/<?= $row->tImage ?>) no-repeat center top;background-size:100% 100%;">
                    </div>
                    <div class="pr2-social centered">
                        <h4><?= $row->tURL ?></h4>
                        
                        <button data-toggle="tooltip" title="Edit" class="btn btn-theme edit" value='<?= json_encode($row) ?>'>Edit</button>
                        <?php
                        if($row->tStatus == 1){
                        ?>
                            <button data-toggle="tooltip" title="De Active" class="btn btn-theme03 tactive" value='{"tId" :<?= $row->tId ?>,"tStatus" : <?= $row->tStatus ?> }'>De Active</button><?php
                        }
                        else if($row->tStatus == 0){
                        ?>
                            <button data-toggle="tooltip" title="Active" class="btn btn-theme02 tactive" value='{"tId" :<?= $row->tId ?>,"tStatus" : <?= $row->tStatus ?> }'>Active</button><?php
                        }
                        ?>
                            <button data-toggle="tooltip" title="Delete" class="btn btn-theme04 tactive" value='{"tId" :<?= $row->tId ?>,"tStatus" : 2 }'>Delete</button>
                            
                    </div>
                </div>
            <?php
                endforeach;
            ?>
            </div>
        </div>
    </section>
</section>
<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery.redirect.js"></script>

<script>
jQuery(function($){
    
$('#tempForm').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    console.log(formData);
         $.ajax({
            async: true,
            url:'<?=base_url()?>template/tAdd',
            dataType: 'json',
            type:"post",
            data:formData,
            success: function(response){
                window.location.href = "templates";
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
    $.redirect("templates", {"temp":data}, "POST");
});

$('#tempForm1').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    console.log(formData);
         $.ajax({
            async: true,
            url:'<?=base_url()?>template/tEdit',
            dataType: 'json',
            type:"post",
            data:formData,
            success: function(response){
                window.location.href = "templates";
            },
            error: function(response){
                alert(response);
            },
            cache: false,
    		contentType: false,
    		processData: false
        });
});

$(document).on("click",".tactive",function(e){
        var data=$(this);
        var temp = JSON.parse(data.val());
        var tId = temp.tId;
        var tStatus = temp.tStatus;
        $.redirect("<?=base_url()?>template/active", {"tId":tId,"tStatus":tStatus}, "POST");
    });

});
    
</script>