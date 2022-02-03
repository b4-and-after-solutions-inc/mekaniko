<!DOCTYPE html>
<html>

<head>

<link rel="shortcut icon" href="favicon.ico">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=$this->config->item('website_name');?></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="application-name" content="<?=$this->config->item('website_name');?>">

<!-- LINKS Starts cihead-->


<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="<?=base_url('assets/');?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('assets/');?>css/font-awesome.min.css">
<link rel="stylesheet" href="<?=base_url('assets/');?>css/ionicons.min.css">

<link rel="stylesheet" href="<?=base_url('assets/');?>css/select2.min.css">

<link rel="stylesheet" href="<?=base_url('assets/');?>css/AdminLTE.min.css">
<link rel="stylesheet" href="<?=base_url('assets/');?>css/skin-black-light.css">
<link rel="stylesheet" href="<?=base_url('assets/');?>css/google-apis.min.css">
<link rel="stylesheet" href="<?=base_url('assets/');?>css/calendar.css">

<link rel="stylesheet" href="<?=base_url('assets/');?>css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('bower_components/');?>bootstrap-daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="<?=base_url('bower_components/');?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<link rel="stylesheet" href="<?=base_url('assets/');?>css/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'; ?>">
bootstrap datepicker -->


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css') ?>">

<link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

<link rel="stylesheet" href="<?=base_url('bower_components/');?>bootstrap-daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="<?=base_url('bower_components/');?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<link rel="stylesheet" href="<?=base_url('assets/');?>css/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'; ?>">

<!-- LINKS End -->

<!-- SCRIPTS Start -->

<script src="<?=base_url('assets/');?>js/jquery.min.js"></script>

<script src="<?=base_url('assets/');?>js/bootstrap.min.js"></script>

<script src="<?=base_url('assets/');?>js/select2.full.min.js"></script>

<script src="<?=base_url('assets/');?>js/adminlte.min.js"></script>

<script src="<?=base_url('assets/');?>js/jquery.slimscroll.min.js"></script>
<script src="<?=base_url('assets/');?>js/fastclick.min.js"></script>

<script src="<?=base_url('assets/');?>js/jquery.dataTables.min.js"></script>

<script src="<?=base_url('assets/');?>js/dataTables.bootstrap.min.js"></script>

<!--<script src="<?=base_url('assets/');?>js/Chart.min.js"></script>-->
<script src="<?=base_url('plugins/');?>chart.js/Chart.min.js"></script>
<script src="<?=base_url('bower_components/');?>bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url('bower_components/');?>bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->

<script src="<?=base_url('assets/');?>js/sweetalert2.all.min.js"></script>
<script src="<?=base_url('assets/');?>js/sweetalert2.min.js"></script>
   
<script type="text/javascript" src="<?php echo base_url().'assets/js/moment.min.js'; ?>"></script>        
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'; ?>"></script>      
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar.js'; ?>"></script>  

<script>
// NOTE What is this shit?
function logOut() { // TODO LogOut Session Destroy (?) Functionality and Redirect to Login
	//$.get("loginQuery.php?logout", function( data ) {
	//	if(data["status"] == "true") {
			window.location = "<?=base_url('access/login/');?>";
	//	}
	//});
}
</script>

<!-- SCRIPTS End -->

<head>

<body class="hold-transition sidebar-mini layout-fixed">
    <nav class="main-header navbar navbar-expand navbar-light navbar-lightblue">

        <ul class="navbar-nav">
        <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item  d-big-inline-green">
                <a href="" class="nav-link">Online Mekaniko</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item"><a class="btn" onclick="logOut()"> <i class="fas fa-edit"></i>Logout</a>
            </li>
        
        </ul>
        
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="" class="brand-link">
            <img src="<?php echo base_url('assets/logo/logo.jpg') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .7">

            <?php if ($this->session->userdata("role") == 0){ ?>
            <span class="brand-text font-weight-light">Admin</span>
			<?php }?>

			<?php if ($this->session->userdata("role") == 1){ ?>
            <span class="brand-text font-weight-light">Customer</span>
			<?php }?>

			<?php if ($this->session->userdata("role") == 2){ ?>
            <span class="brand-text font-weight-light">Shop owner</span>
			<?php }?>

			<?php if ($this->session->userdata("role") == 3){ ?>
            <span class="brand-text font-weight-light">Freelance Mekaniko</span>
			<?php }?>
        </a>

        <div class="sidebar">
    

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!--<li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                    </li>-->

        			<!--FOR ADMIN MENU-->
        			<?php if ($this->session->userdata("role") == 0){ ?>
					<li class="nav-item">
						<a href="<?php echo base_url() ?>" class="nav-link">
							<i class="nav-icon fas fa-home"></i>
							<p>
								Home
							</p>
						</a>
					</li>

					<!--
					<li class="nav-item">
						<a href="" class="nav-link">
							<i class="nav-icon fas fa-user-alt"></i>
							<p>My Account</p>
						</a>
					</li>-->

					
					<li class="nav-header">SETUP</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/setup_user") ?>" class="nav-link">
						<i class="fas fa-user nav-icon">
							</i><p> All Account</p>
						</a>
					</li>

					<!--
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/province") ?>" class="nav-link">
						<i class="fas fa-user nav-icon">
							</i><p> Province</p>
						</a>
					</li>


					<li class="nav-item">
                    	<a href="<?php echo base_url("main/municipality") ?>" class="nav-link">
						<i class="fas fa-user nav-icon">
							</i><p> Municipality</p>
						</a>
					</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/barangay") ?>" class="nav-link">
						<i class="fas fa-user nav-icon">
							</i><p> Barangay</p>
						</a>
					</li>-->

					<li class="nav-header">SHOP MANAGEMENT</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/view_shop") ?>" class="nav-link">
						<i class="nav-icon fas fa-book-open">
							</i><p> View Shop</p>
						</a>
					</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/service_list/") ?>" class="nav-link">
						<i class="nav-icon fas fa-poll-h">
							</i><p> Common Services
							</p>
						</a>
					</li>

					<li class="nav-header">CUSTOMER MANAGEMENT</li>
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/view_customer/") ?>" class="nav-link">
						<i class="nav-icon fas fa-book-open">
							</i><p> View Customer
							</p>
						</a>
					</li>
        			<?php }?>

        			<!--FOR SHOP OWNER MENU-->
        			<?php if ($this->session->userdata("role") == 2){ ?>
					<li class="nav-item">
						<a href="<?php echo base_url() ?>" class="nav-link">
							<i class="nav-icon fas fa-home"></i>
							<p>
								Home
							</p>
						</a>
					</li>

					<li class="nav-header">SHOP MANAGEMENT</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/service_owner") ?>" class="nav-link">
						<i class="nav-icon fas fa-wrench">
							</i><p> Services</p>
						</a>
					</li>


					<li class="nav-item">
                    	<a href="<?php echo base_url("main/branch_owner") ?>" class="nav-link">
						<i class="nav-icon fas fa-plus">
							</i><p> Branch</p>
						</a>
					</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/location_owner") ?>" class="nav-link">
						<i class="nav-icon fas fa-edit">
							</i><p> Location</p>
						</a>
					</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/service_owner_archived") ?>" class="nav-link">
						<i class="nav-icon fas fa-archive">
							</i><p> Archived Services</p>
						</a>
					</li>
					<li class="nav-header">CUSTOMER</li>
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/customer/") ?>" class="nav-link">
						<i class="nav-icon fas fa-user">
							</i><p> Customer Account
							</p>
						</a>
					</li>

					<li class="nav-header">Transaction</li>
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/transaction_list_owner/") ?>" class="nav-link">
						<i class="nav-icon fas fa-poll-h">
							</i><p> List of Transaction
							</p>
						</a>
					</li>

					<li class="nav-header">REPORT</li>
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/report_total_sales_owner/") ?>" class="nav-link">
						<i class="nav-icon fas fa-poll-h">
							</i><p> Total Sales
							</p>
						</a>
					</li>

        			<?php }?>
        			<!--FOR SHOP CUSTOMER MENU-->
        			<?php if ($this->session->userdata("role") == 1){ ?>
					<li class="nav-item">
						<a href="<?php echo base_url() ?>" class="nav-link">
							<i class="fas fa-search"></i>
							<p>
								For Shop
							</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url("main/search_freelance_mekaniko/") ?>" class="nav-link">
							<i class="fas fa-search"></i>
							<p>
								For Freelance Mekaniko
							</p>
						</a>
					</li>

					<li class="nav-header">Transaction</li>
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/reservation_customer/") ?>" class="nav-link">
						<i class="nav-icon fal far fa-check-square">
							</i><p> My Transaction
							</p>
						</a>
					</li>

					<?php }?>

					<!--FOR FREELANCE MEKANIKO MENU-->
        			<?php if ($this->session->userdata("role") == 3){ ?>
					<li class="nav-item">
						<a href="<?php echo base_url() ?>" class="nav-link">
							<i class="nav-icon fas fa-home"></i>
							<p>
								Home
							</p>
						</a>
					</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/location_freelance_mekaniko") ?>" class="nav-link">
						<i class="nav-icon fas fa-edit">
							</i><p> Your Location</p>
						</a>
					</li>

					<li class="nav-item">
                    	<a href="<?php echo base_url("main/labor_list") ?>" class="nav-link">
						<i class="nav-icon fas fa-money-bill-alt">
							</i><p> Your Labor</p>
						</a>
					</li>

					<li class="nav-header">Transaction</li>
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/transaction_list_freelance/") ?>" class="nav-link">
						<i class="nav-icon fas fa-poll-h">
							</i><p> List of Transaction
							</p>
						</a>
					</li>

					<li class="nav-header">REPORT</li>
					<li class="nav-item">
                    	<a href="<?php echo base_url("main/report_total_sales_freelance/") ?>" class="nav-link">
						<i class="nav-icon fas fa-poll-h">
							</i><p> Total Sales
							</p>
						</a>
					</li>
        			<?php }?>
                    
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
<script>
function logOut() { 
	window.location = "<?=base_url('access/sign_out/');?>";
}
</script>