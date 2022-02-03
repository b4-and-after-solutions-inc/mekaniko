
<div class="box box-default color-palette-box">

  <div class="box-header with-border">
    <button class="btn btn-primary" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i> Add User</button>
  </div>

  <div class="box-body">
    <div class="row">
      <div class="col-xs-12">
        <div class="form-group">
           <!--for filter if any--> 
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table id ="table_id" class="table table-bordered table-hover datatable" style="width:100%">
          <thead> 
            <tr> 
             <th style='display:none;'>#</th> 
             <th>Signature</th> 
             <th>Name</th> 
             <th>Department</th> 
             <th>Email Address</th> 
             <th>Username</th>
             <th>Password</th>
             <th>User Type</th> 
             <th>Action</th>
            </tr> 
           </thead>
           <tbody> 
           <?php
            foreach($adminData as $key=>$val){ 
                $user_type = $val['user_type'];
            if($user_type == 1){
                $user_type = 'Admin';
            }else if($user_type == 2){
                $user_type = 'Manager';
            }else if($user_type == 3){
                $user_type = 'Approver';
            }else if($user_type == 5){
                $user_type = 'Accounting';
            }else if($user_type == 6){
                $user_type = 'Cashier';
            }else{
                $user_type = 'Requestor';  
            }
            $site_image_url = site_url('/assets/img/employee_signature/'.$val['picture'].'');
                echo "<tr>"; 
                echo "<td style='display:none;'>".$val['id']."</td>";
                echo "<td>"."<img src=".$site_image_url." style ='width:80px;height:80px'></img>"."</td>";
                echo "<td>".$val['firstname'].' '.$val['lastname']."</td>";
                echo "<td>".$val['department_name']."</td>";
                echo "<td>".$val['email_address']."</td>";
                echo "<td>".$val['username']."</td>";
                echo "<td>".$val['password']."</td>";
                echo "<td>".$user_type."</td>";
                echo "<td>".'<button class="btn btn-success" onclick="edit_user('.$val["id"].')" data-toggle="tooltip" title="Edit" ><i class="fa fa-pencil fa"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_user('.$val["id"].')" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash fa"></i></button>'."</td>";
                echo "</tr>"; 
            } 
            ?> 
           </tbody> 
        </table>
        
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">User Form</h3>
            </div>
            <div class="modal-body form">
                <!--<form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">-->
                <form method="post" id="form" class="form-horizontal" action="<?php echo site_url()?>main/user_add" enctype="multipart/form-data">

                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Signature</label>
                            
                            <div class="col-md-9">
                                <input type="file" id="upload_file" name='upload_file'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Pincode:</label>
                            <div class="col-md-9">
                                <input name="pincode" id="pincode" class="form-control" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Firstname:</label>
                            <div class="col-md-9">
                                <input name="firstname" id="firstname" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Lastname:</label>
                            <div class="col-md-9">
                                <input name="lastname" id="lastname" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Department:</label>
                            <div class="col-md-9">
                                <select style='height:40px; width: 100%' class="form-control" name="department" id="department">
                                    <option value="">--Choose Department--</span>
                                    <?php
                                      foreach($userDepartment as $key=>$dep){
                                      echo "<option value='".$dep['id']."'>".$dep['department_name']."</span>";
                                      }
                                    ?>
                                    </option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Username:</label>
                            <div class="col-md-9">
                                <input name="username" id="username" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password:</label>
                            <div class="col-md-9">
                                <input name="password" id="password" class="form-control" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email Address:</label>
                            <div class="col-md-9">
                                <input name="email_address" id="email_address" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">User Type:</label>
                            <div class="col-md-9">
                                <select class="form-control" name="user_type" id="user_type">
                                  <option value="-">-</option>
                                  <option value="1">Admin</option>
                                  <option value="2">Manager</option>
                                  <option value="3">Approver</option>
                                  <option value="4">Requestor</option>
                                  <option value="5">Accounting</option>
                                  <option value="6">Cashier</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
  
$(document).ready( function () {
  $('#table_id').DataTable();
  $('#equipment_period').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
} );

var save_method; //for save method string
var table;

function add_user(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.modal-title').text('Add User');
    $('#modal_form').modal('show'); // show bootstrap modal

    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function save(){
    var url;

    var fd = new FormData();    
    fd.append('picture', $('#upload_file')[0].files[0]);
    fd.append('firstname', $('#firstname').val());
    fd.append('lastname', $('#lastname').val());
    fd.append('department', $('#department').val());
    //fd.append('contact_number', $('#contact_number').val());

    fd.append('username', $('#username').val());
    fd.append('password', $('#password').val());
    fd.append('email_address', $('#email_address').val());
    fd.append('pincode', $('#pincode').val());
    fd.append('user_type', $('#user_type').val());

    var upload_file = document.getElementById("upload_file").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (username == "") {
      Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<p><b>Username</b> field must be filled out </p>'
        })
        return false;
    }
    if (password == "") {
      Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<p><b>Password</b> field must be filled out </p>'
        })
        return false;
    }

    if(save_method == 'add'){
        url = "<?php echo site_url('main/user_add')?>";

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
    else{
        url = "<?php echo site_url('main/user_update')?>";

        $.ajax({

            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
               //if success close modal and reload ajax table
                
                //document.getElementById("loader").style.display = "none";
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
        
}

function edit_user(id){  
save_method = 'update';
$('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_edit_user/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            $('[name="id"]').val(data.id);

            $('[name="pincode"]').val(data.pincode);
            $('[name="firstname"]').val(data.firstname);
            $('[name="lastname"]').val(data.lastname);
            $('[name="department"]').val(data.department);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="email_address"]').val(data.email_address);
            $('[name="user_type"]').val(data.user_type);
            //$('[name="upload_file"]').val(data.picture);
            //$('[name="contact_number"]').val(data.contact_number);
            //$('[name="location"]').val(data.location);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });

}

function delete_user(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {

        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/user_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Deleted", text: 'User has been deleted.',  type: 
                "success"}).then(function(){ 
                    location.reload();
                }
                );
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

        
    }
    })
}

</script>




