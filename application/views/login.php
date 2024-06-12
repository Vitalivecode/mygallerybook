<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keyword" content="">
  <title>My Gallerybook | Login</title>

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>assets/images/mgblogo.jpg" rel="icon">
  <link href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?php echo base_url(); ?>assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/swamy.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">
  
</head>

<body>
  
  
  <div id="login-page">
    <div class="container">
      <form class="form-login" id="formLogin" name="formLogin" method="post">
        <h2 class="form-login-heading">sign in now</h2>
        <div class="login-wrap">
            <img src="<?php echo base_url(); ?>assets/images/mgblogo.jpg" class="img-responsive center-block">
            <br>
          <input type="text" class="form-control" id="ownerId" name="ownerId" placeholder="Owner ID" autofocus required>
          <br>
          <input type="password" class="form-control" id="passWord" name="passWord" placeholder="Password" required>
          <br>
          <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN </button>
        </div>
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("<?php echo base_url(); ?>assets/images/1.jpg", {
      speed: 500
    });
  </script>
  

<script>
jQuery(function($){
    
$('#formLogin').on('submit',function(e){
    e.preventDefault();
   var formData = new FormData($(this)[0]);
         $.ajax({
            async: true,
            url:'<?=base_url()?>login/login',
            dataType: 'json',
            method:"post",
            data:formData,
            success: function(response){
                if(response.status == '200'){
                    if(response.role == 'Owner')
                        window.location.href = "<?=base_url()?>o/";
                    else if(response.role == 'Received')
                        window.location.href = "<?=base_url()?>r/";
                    else if(response.role == 'Printed')
                        window.location.href = "<?=base_url()?>p/";
                    else if(response.role == 'Dispatched')
                        window.location.href = "<?=base_url()?>d/";
                    else if(response.role == 'Delivered')
                        window.location.href = "<?=base_url()?>c/";
                }
                else if(response.status == '500'){
                    alert("Wrong Credentials");
                }
            },
            error: function(response){
                alert("Try Again Please");
            },
            cache: false,
    		contentType: false,
    		processData: false
        });
});

});
</script>

</body>

</html>