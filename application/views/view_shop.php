    
    <div class="container-fluid">
        <section class="content pt-2">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title text-muted">Shops</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <!--<a href="<?php echo base_url("index.php/admin/addshopview") ?>" class="btn btn-sm btn-success">Add shop</a>-->

                    <!--<button class="btn btn-success" onclick="add_shop()"><i class="glyphicon glyphicon-plus"></i> Add shop</button>-->

                    <div class="row mt-3">
                        <div class="col">
                            <table id="mytable" class="table table-sm table-striped nowrap">
                                <thead>
                                    <tr>    
                                        <th class="bg-info text-white">Business Permit</th>
                                        <th class="bg-info text-white">Shop Name</th>
                                        <th class="bg-info text-white">Owners Name</th>
                                        <th class="bg-info text-white">Address</th>
                                        <th class="bg-info text-white">Business Number</th>
                                        <th class="bg-info text-white">Phone Number</th>
                                        <th class="bg-info text-white">Role</th>
                                        <th class="bg-info text-white">Status</th>
                                        <th class="bg-info text-white text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($shopData as $key=>$val){ 
                                        $site_image_url = site_url('/assets/img/shop_picture/'.$val['picture'].'');
                                        $status = $val['status'];
                                        $role = $val['role'];
                                        
                                        if($status == 1){
                                            $status = 'For Approval';
                                            $status_text = '<span style="color:red">For Approval</span>';

                                        }else if($status == 2){
                                            $status = 'Approved';
                                            $status_text = '<span style="color:blue">Approved</span>';
                                        }

                                        if($role == 2){
                                            $role = 'Shop Owner';
                                        }else if($role == 3)
                                        {
                                            $role = 'Freelance Mekaniko';
                                        }

                                        echo "<tr>"; 
                                        echo "<td>"."<img src=".$site_image_url." style ='width:130px;height:130px'></img>"."</td>";
                                        echo "<td>".$val['shopname']."</td>";
                                        echo "<td>".$val['owners_name']."</td>";
                                        echo "<td>".$val['address']."</td>";
                                        echo "<td>".$val['business_number']."</td>";
                                        echo "<td>".$val['coscontactnum']."</td>";
                                        echo "<td>".$role."</td>";
                                        echo "<td>".$status_text."</td>";

                                        if($status != 'Approved'){
                                            echo "<td>".'<button class="btn btn-success" onclick="edit_shop('.$val["cosid"].')" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>'." ".'<button class="btn btn-primary" onclick="approval_shop('.$val["cosid"].')" data-toggle="tooltip" title="Approval" ><i class="fa fa-thumbs-up fa"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_shop('.$val["cosid"].')" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash fa"></i></button>'."</td>";

                                        }else{

                                            echo "<td>".'<button class="btn btn-success" onclick="edit_shop('.$val["cosid"].')" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_shop('.$val["cosid"].')" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash fa"></i></button>'."</td>";
                                        }
                                        
                                        echo "</tr>"; 
                                    } 
                                    ?>
                                </tbody>
                            </table>
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
} );

var save_method; //for save method string
var table;

function add_shop(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.modal-title').text('Add Shop');
    $('#modal_form').modal('show'); // show bootstrap modal

    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function save(){
var url;
//document.getElementById("loader").style.display = "block";
if(save_method == 'add'){
    url = "<?php echo site_url('main/shop_add')?>";
}
else{
    url = "<?php echo site_url('main/shop_update')?>";
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

function edit_shop(id){  
save_method = 'update';
$('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_edit_shop/')?>/" + id,
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


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Shop'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });

}

function delete_shop(id){
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
            url : "<?php echo site_url('main/shop_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Deleted", text: 'Shop has been deleted.',  type: 
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


function approval_shop(id){
    Swal.fire({
    title: 'APPROVAL',
    text: "You want to approved this?",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
    if (result.value) {
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/shopowner_approved')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Success", text: 'Approved Successfully.',  type: 
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

