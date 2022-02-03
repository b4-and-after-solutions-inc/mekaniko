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
        
        <div class="form-group">

            <center><img src="<?php echo base_url("assets/logo/logo.jpg") ?>" width = "20%"></center> <br>

            <h3 class="text-center text-muted">Online Mekaniko</h3>
            <br/>
            <h2 class="text-center text-bold">CHOOSE TO REGISTER</h2> <br>
            <br>
            <center>
            <a href="<?php echo base_url("access/chooses") ?>" class="nav-link">
            <i class="nav-icon fas fa-regester"></i>
            <p>Shop Owner</p>
            </a>
            <a href="<?php echo base_url("access/register") ?>" class="nav-link">
            <i class="nav-icon fas fa-regester"></i>
            <p>Customer</p>
            </a>

            <a href="<?php echo base_url("access/freelance_mekaniko") ?>" class="nav-link">
            <i class="nav-icon fas fa-regester"></i>
            <p>Freelance Mekaniko</p>
            </a>
            </center>
        </div>
    </div>
</div>

</div>


<script src="<?=site_url('assets/');?>js/jquery.min.js"></script>
<script src="<?=site_url('assets/');?>js/bootstrap.min.js"></script>
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
            window.location.replace('<?php echo base_url()?>');
          } else{
            $('#walert').show();
          }
      }
    });
  }
</script>
</body>
</html>
