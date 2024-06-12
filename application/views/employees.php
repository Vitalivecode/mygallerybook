<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Employees</h3>
        <div class="row mt">
            <div class="col-lg-6">
                <?php
                if($emp == null){
                ?>
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> Add Employee</h4>
                <div class="form-panel">
                    <div class="form" id="form">
                        <form id="empForm" name="empForm" class="cmxform form-horizontal style-form">
                            <div class="form-group ">
                                <label for="ownerId" class="control-label col-lg-2">Owner ID</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="ownerId" name="ownerId" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="emailId" class="control-label col-lg-2">Email</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="emailId" name="emailId" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="phoneNo" class="control-label col-lg-2">Phone</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="phoneNo" name="phoneNo" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="role" class="control-label col-lg-2">Role</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="Owner">Owner</option>
                                        <option value="Received">Received</option>
                                        <option value="Printed">Printed</option>
                                        <option value="Dispatched">Dispatched</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
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
                    $data = json_decode($emp);
                ?>
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> Edit Employee</h4>
                <div class="form-panel">
                    <div class="form" id="form">
                        <form id="empForm1" name="empForm1" class="cmxform form-horizontal style-form">
                            <div class="form-group ">
                                <label for="ownerId" class="control-label col-lg-2">Owner ID</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="ownerId" name="ownerId" value="<?= $data->ownerId ?>" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="emailId" class="control-label col-lg-2">Email</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="emailId" name="emailId" value="<?= $data->emailId ?>" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="phoneNo" class="control-label col-lg-2">Phone</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="phoneNo" name="phoneNo" value="<?= $data->phoneNo ?>" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="role" class="control-label col-lg-2">Role</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="<?= $data->role ?>"><?= $data->role ?></option>
                                        <option value="Owner">Owner</option>
                                        <option value="Received">Received</option>
                                        <option value="Printed">Printed</option>
                                        <option value="Dispatched">Dispatched</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <input class="form-control" id="id" name="id" value="<?= $data->id ?>"  type="hidden" required />
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
                <h4 style="color: #1fb6ff;"><i class="fa fa-angle-right"></i> View Employee</h4>
                <div class="content-panel" style="padding:5px;">
                    <div class="adv-table">
                      <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info" width="100%">
                        <thead>
                          <tr>
                            <th>Owner Id</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($employees as $row):
                        ?>
                        <tr>
                            <th><?= $row->ownerId ?></th>
                            <th><?= $row->emailId ?></th>
                            <th><?= $row->phoneNo ?></th>
                            <th><?= $row->role ?></th>
                            <th>
                                <button data-toggle="tooltip" title="Edit" class="btn btn-theme edit" value='<?= json_encode($row) ?>'>Edit</button>
                                <?php
                                if($row->status == 1){
                                ?>
                                    <button data-toggle="tooltip" title="De Active" class="btn btn-theme03 oactive" value='{"id" :<?= $row->id ?>,"statuss" : <?= $row->status ?> }'>De Active</button><?php
                                }
                                else if($row->status == 0){
                                ?>
                                    <button data-toggle="tooltip" title="Active" class="btn btn-theme02 oactive" value='{"id" :<?= $row->id ?>,"statuss" : <?= $row->status ?> }'>Active</button><?php
                                }
                                ?>
                                    <button data-toggle="tooltip" title="Delete" class="btn btn-theme04 oactive" value='{"id" :<?= $row->id ?>,"statuss" : 2 }'>Delete</button>
                            </th>
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
    </section>
</section>
<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery.redirect.js"></script>

<script>
jQuery(function($){
    
$('#empForm').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    console.log(formData);
         $.ajax({
            async: true,
            url:'<?=base_url()?>owner/eAdd',
            dataType: 'json',
            type:"post",
            data:formData,
            success: function(response){
                window.location.href = "employees";
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
    $.redirect("employees", {"emp":data}, "POST");
});

$('#empForm1').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    console.log(formData);
         $.ajax({
            async: true,
            url:'<?=base_url()?>owner/eEdit',
            dataType: 'json',
            type:"post",
            data:formData,
            success: function(response){
                window.location.href = "employees";
            },
            error: function(response){
                alert(response);
            },
            cache: false,
    		contentType: false,
    		processData: false
        });
});

$(document).on("click",".oactive",function(e){
        var data=$(this);
        var emp = JSON.parse(data.val());
        var id = emp.id;
        var status = emp.statuss;
        $.redirect("<?=base_url()?>owner/active", {"id":id,"status":status}, "POST");
    });

});
    
</script>