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

    <script src="<?=site_url('assets/');?>js/city.js"></script>
</head>
<body>

<div class="wrapper">
<div class="container-fluid pt-4">

<br>
<br>
<br>

<div class="row">
    <div class="col-md-8 offset-md-2 shadow-lg rounded p-5">
        <form method="post" id="form" class="form-horizontal" action="<?php echo site_url()?>main/user_add" enctype="multipart/form-data">
            <div class="form-group">

                <center><img src="<?php echo base_url("assets/logo/logo.jpg") ?>" width = "20%"></center> <br>

                <h3 class="text-center text-muted">Online Mekaniko</h3>
                <br/>
                <h2 class="text-center text-bold">Freelance-Mekaniko Register</h2> <br>
                <div class="form-group">
                    <?php 
                    if($this->session->flashdata('true')){
                    ?>
                    <div class="alert alert-success"> 
                        <span class="text-center text-bold"> <?php echo $this->session->flashdata('true'); ?> </span>
                        <?php    
                        } else if($this->session->flashdata('err')) {
                        ?>
                        <div class = "alert alert-danger">
                        <span class="text-center text-bold"> <?php echo $this->session->flashdata('err'); ?> </span>
                        </div>
                        <?php  ?>
                        <?php    
                        } else if($this->session->flashdata('error')){
                        ?>
                        <div class = "alert alert-danger">
                        <span class="text-center text-bold"> <?php echo $this->session->flashdata('error'); ?> </span>
                        </div>
                        <?php } ?>

                    </div>

                    <label class="text-muted"> First Name </label>
                    <input type="text" name="firstname" id="firstname" class="form-control " placeholder="Enter first name">

                    <label class="text-muted"> Last Name </label>
                    <input type="text" name="lastname" id="lastname" class="form-control " placeholder="Enter last name">

                    <label class="text-muted"> Contact Number </label>
                    <input type="text" name="contact" id="contact" class="form-control " placeholder="Enter contact number">

                    <label class="text-muted">Province:</label>
                        <select style='height:40px; width: 100%' class="form-control" name="province" id="province">
                            </option>
                        </select> 

                    <label class="text-muted">Municipality:</label>
                        <select style='height:40px; width: 100%' class="form-control" name="city" id="city">
                            </option>
                        </select> 

                    <label class="text-muted"> Email Address </label>
                    <input type="text" name="email_address" id="email_address" class="form-control " placeholder="Enter email">


                    <!--<label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">-->
                    <small id="emailHelp" class="form-text text-muted">Never share your email with anyone else.</small>


                    <label class="text-muted"> Username </label>
                    <input type="text" name="username" id="username" class="form-control " placeholder="Enter Username">

                    <label class="text-muted"> Password </label>
                    <input type="password" name="password" id='password' class="form-control " placeholder="Enter password">
                    
                    <br>
                    <center>

                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <a href="<?php echo base_url("access/login") ?>" class="nav-link">
                            <i class="nav-icon fas fa-login"></i>
                            <p>Go to login</p>
                            </a>
                    
                    </center>
                </div>
            </div>

        </form>
</div>

</div>

<link rel="stylesheet" href="<?=base_url('assets/');?>css/sweetalert2.min.css">

<script src="<?=site_url('assets/');?>js/jquery.min.js"></script>
<script src="<?=site_url('assets/');?>js/bootstrap.min.js"></script>

<script src="<?=base_url('assets/');?>js/sweetalert2.all.min.js"></script>
<script src="<?=base_url('assets/');?>js/sweetalert2.min.js"></script>
<script>
/*function save(){
var url = "<?php echo site_url('main/owner_shop_add')?>";
    // ajax adding data to database 
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data){

            swal({title: "Successfully saved", type: 
                "success"}).then(function(){ 
                    location.reload();
                }
            );
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error adding / update data');
        }

    });
}*/
window.onload = function() {    

    // ---------------
    // basic usage
    // ---------------
    var $ = new City();
    $.showProvinces("#province");
    $.showCities("#city");

    // ------------------
    // additional methods 
    // -------------------

    // will return all provinces 
    console.log($.getProvinces());
    
    // will return all cities 
    console.log($.getAllCities());
    
    // will return all cities under specific province (e.g Batangas)
    console.log($.getCities("Batangas"));   
    
}
function save(){
    var url;

    var fd = new FormData();    
    //fd.append('picture', $('#upload_file')[0].files[0]);
    fd.append('cosfirstname', $('#firstname').val());
    fd.append('coslastname', $('#lastname').val());
    fd.append('coscontactnum', $('#contact').val());
    fd.append('cosusername', $('#username').val());
    fd.append('cospassword', $('#password').val());
    fd.append('email_address', $('#email_address').val());
    fd.append('province', $('#province').val());
    fd.append('municipality', $('#city').val());
    fd.append('role', 3);

    url = "<?php echo site_url('main/freelance_mekaniko_add')?>";

    // ajax adding data to database
    $.ajax({

        url : url,
        type: "POST",
        data: fd,
        
        contentType: false,
        processData: false,
        success: function(){
           //if success close modal and reload ajax table
            
            swal({title: "Successfully saved", type: 
                "success"}).then(function(){ 
                    location.reload();
                }
            );

            $('#modal_form').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error adding / update data');
        }

    });
        
}
</script>
</body>
</html>