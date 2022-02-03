<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>online mekaniko</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

    <link rel="stylesheet" href="<?=base_url('assets/');?>css/sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>
<body>

<div class="wrapper">


 <div class="container-fluid pt-4">
  <br>
  <br>
  <br>
  <div class="row">
      <div class="col-md-6 offset-md-3 shadow-lg rounded p-5">
        <div class="alert alert-danger display-hide" id="walert" style="display: none;">
            <button class="close" data-close="alert"></button>
            <span> Wrong Username or Password. </span>
        </div>
              <div class="form-group">


                  <center><img src="<?php echo base_url("assets/logo/logo.jpg") ?>" width = "20%"></center> <br>

                  <h3 class="text-center text-muted">Online Mekaniko</h3>
                  <br/>
                  <h2 class="text-center text-bold">Login</h2> <br>

                 <?php  if($this->session->flashdata('err')){
                  ?>
                  <div class = "alert alert-secondary ">
                  <span class="text-center text-danger "> <?php echo $this->session->flashdata('err'); ?> </span>
                  </div>
                  <?php } ?>
                  
                  <label class="text-muted"> Username </label>
                  <input type="text" name="username" id='username' class="form-control  " placeholder="Enter username">
                  <!--<span class="text-danger"> <?php //echo form_error("textusername") ?> </span>!-->

                  <label class="text-muted"> Password </label>
                  <input type="password" name="password" id='password' class="form-control " placeholder="Enter password">
                  <!--<span class="text-danger"> <?php //echo form_error("textpassword") ?> </span>-->
                  
                  <br>
                  <center>
                  <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="sign_in()">Sign In</button>
                  <a href="<?php echo base_url("access/choosep") ?>" class="nav-link">
                  <i class="nav-icon fas fa-regester"></i>
                  <p>Register</p>
                  </a>
                  </center>
          
              </div>
      </div>
  </div>

</div>
<script src="<?=site_url('assets/');?>js/jquery.min.js"></script>
<script src="<?=site_url('assets/');?>js/bootstrap.min.js"></script>
<script src="<?=base_url('assets/');?>js/sweetalert2.all.min.js"></script>
<script src="<?=base_url('assets/');?>js/sweetalert2.min.js"></script> 
<script>
  function sign_in(){
    console.log('hello');
    $.ajax({
      url: '<?php echo site_url()?>Access/sign_in',
      type:'post',
      data:{username:$('#username').val(), password:$('#password').val()},
      async: false,
      success: function(data){
        console.log(data);
          if(data == 1){
            

            swal({title: "Success!", type: 
                "success"}).then(function(){ 
                    window.location.replace('<?php echo base_url()?>');
                }
            );
          } else{
            $('#walert').show();
          }
      }
    });
  }
</script>
</body>
</html>
