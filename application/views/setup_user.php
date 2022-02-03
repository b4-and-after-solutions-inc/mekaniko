    
    <div class="container-fluid">
    <section class="content pt-2">
        <div class="card">

            <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="card card-primary card-tabs">
                      <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Shop Owner</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Customer</a>
                          </li>
                        </ul>
                      </div>

                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                          <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                             <table id="mytable" class="table table-sm table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white">Name</th>
                                        <th class="bg-info text-white">Contact#</th>
                                        <th class="bg-info text-white">Email Address</th>
                                        <th class="bg-info text-white">Role</th>
                                        <th class="bg-info text-white text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($userData as $key=>$val){ 

                                    $role = $val['role'];

                                    if ($role == 0){
                                        $role ='Super Admin';
                                    }else if($role == 1){
                                        $role = 'Customer';
                                    }else if($role == 2){
                                        $role ='Shop Owner';
                                    }else{
                                        $role ='Admin';
                                    }
                                        echo "<tr>"; 
                                        echo "<td>".$val['owners_name']."</td>";
                                        echo "<td>".$val['coscontactnum']."</td>";
                                        echo "<td>".$val['email_address']."</td>";
                                        echo "<td>".$role."</td>";
                                        echo "<td>".'<button class="btn btn-success" onclick="edit_user('.$val["cosid"].')" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_user('.$val["cosid"].')" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash fa"></i></button>'."</td>";
                                        echo "</tr>"; 
                                    } 
                                    ?>
                                </tbody>
                            </table>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                             <table id="mytable2" class="table table-sm table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white">Name</th>
                                        <th class="bg-info text-white">Contact#</th>
                                        <th class="bg-info text-white">Email Address</th>
                                        <th class="bg-info text-white">Role</th>
                                        <th class="bg-info text-white text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($userCustomerData as $key=>$val){ 

                                    $role = $val['role'];

                                    if ($role == 0){
                                        $role ='Super Admin';
                                    }else if($role == 1){
                                        $role = 'Customer';
                                    }else if($role == 2){
                                        $role ='Shop Owner';
                                    }else{
                                        $role ='Admin';
                                    }
                                        echo "<tr>"; 
                                        echo "<td>".$val['owners_name']."</td>";
                                        echo "<td>".$val['coscontactnum']."</td>";
                                        echo "<td>".$val['email_address']."</td>";
                                        echo "<td>".$role."</td>";
                                        echo "<td>".'<button class="btn btn-success" onclick="edit_user('.$val["cosid"].')" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_user('.$val["cosid"].')" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash fa"></i></button>'."</td>";
                                        echo "</tr>"; 
                                    } 
                                    ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    </div>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog" >
        <div class="modal-dialog" style="width: 70%">
            <div class="modal-content" >
                <div class="modal-header">
                    
                    <h3 class="modal-title">Shop Name</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form" >
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="id"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Shop Name:</label>
                                <div class="col-md-9">
                                    <input name="shop_name" id="shop_name" class="form-control" type="text">
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
                                <label class="control-label col-md-3">Contact#:</label>
                                <div class="col-md-9">
                                    <input name="contact" id="contact" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Province:</label>
                                <div class="col-md-9">
                                    <input name="province" id="province" class="form-control" type="text">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Municipality:</label>
                                <div class="col-md-9">
                                    <input name="municipality" id="municipality" class="form-control" type="text">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Barangay:</label>
                                <div class="col-md-9">
                                    <input name="barangay" id="barangay" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Email Address:</label>
                                <div class="col-md-9">
                                    <input name="email_address" id="email_address" class="form-control" type="text">
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
                                <label class="control-label col-md-3">Role:</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="role" id="role">
                                      <option value="" selected>--Choose Role--</option>
                                      <option value="0">Super Admin</option>
                                      <option value="3">Admin</option>
                                      <option value="1">Customer</option>
                                      <option value="2">Shop Owner</option>
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

var save_method; //for save method string
var table;

function add_user(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.modal-title').text('Add User');
    $('#modal_form').modal('show'); // show bootstrap modal
}

function save(){
var url;
if(save_method == 'add'){
    url = "<?php echo site_url('main/user_add')?>";
}
else{
    url = "<?php echo site_url('main/user_update')?>";
}
    // ajax adding data to database 
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



function edit_user(id){  
save_method = 'update';
$('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_edit_user/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            $('[name="id"]').val(data.cosid);
            $('[name="shop_name"]').val(data.shopname);
            $('[name="firstname"]').val(data.cosfirstname);
            $('[name="lastname"]').val(data.coslastname);
            $('[name="contact"]').val(data.coscontactnum);
            $('[name="province"]').val(data.province);
            $('[name="municipality"]').val(data.municipality);
            $('[name="barangay"]').val(data.barangay);
            $('[name="email_address"]').val(data.email_address);
            $('[name="username"]').val(data.cosusername);
            $('[name="password"]').val(data.cospassword);
            $('[name="role"]').val(data.role);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Shop'); // Set title to Bootstrap modal title
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

