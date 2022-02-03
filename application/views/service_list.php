     
    <div class="container-fluid">
        <section class="content pt-2">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title text-muted">Service</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">

                    <button class="btn btn-success" onclick="add_service()"><i class="glyphicon glyphicon-plus"></i> Add Service</button>

                    <div class="row mt-3">
                        <div class="col">
                            <table id="mytable" class="table table-sm table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white">Shop Name</th>
                                        <th class="bg-info text-white">Owners Name</th>
                                        <th class="bg-info text-white">Services</th>
                                        <th class="bg-info text-white">Amount</th>
                                        <th class="bg-info text-white text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($serviceData as $key=>$val){ 
                                        echo "<tr>"; 
                                        echo "<td>".$val['shopname']."</td>";
                                        echo "<td>".$val['owners_name']."</td>";
                                        echo "<td>".$val['servicename']."</td>";
                                        echo "<td>"."&#8369;"." ".number_format($val['amount'])."</td>";
                                        echo "<td>".'<button class="btn btn-success" onclick="edit_service('.$val["serviceid"].')" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_service('.$val["serviceid"].')" data-toggle="tooltip" title="Archive" ><i class="fa fa-trash fa"></i></button>'."</td>";
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
                                    <select style='height:40px; width: 100%' class="form-control" name="shop_name" id="shop_name">
                                        <option value="">--Choose Shop--</span>
                                        <option value="All">All Shop</span>
                                        <?php
                                          foreach($shopData as $key=>$shop){
                                          echo "<option value='".$shop['cosid']."'>".$shop['shopname']."</span>";
                                          }
                                        ?>
                                        </option>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Service:</label>
                                <div class="col-md-9">
                                    <input name="service" id="service" class="form-control" type="text">
                                </div>
                            </div>
                            <!--
                            <div class="form-group">
                                <label class="control-label col-md-3">Amount:</label>
                                <div class="col-md-9">
                                    <input name="amount" id="amount" class="form-control" type="text">
                                </div>
                            </div>-->


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

function add_service(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.modal-title').text('Add Service');
    $('#modal_form').modal('show'); // show bootstrap modal

    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function save(){
var url;
//document.getElementById("loader").style.display = "block";
if(save_method == 'add'){
    url = "<?php echo site_url('main/service_add')?>";
}
else{
    url = "<?php echo site_url('main/service_update')?>";
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

function edit_service(id){  
save_method = 'update';
$('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_edit_service/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            $('[name="id"]').val(data[0].serviceid);
            $('[name="shop_name"]').val(data[0].ownersid);
            $('[name="service"]').val(data[0].servicename);
            $('[name="amount"]').val(data[0].amount);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Service'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });

}

function delete_service(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Archived it!'
    }).then((result) => {
    if (result.value) {
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/service_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Archived", text: 'Service has been Archived.',  type: 
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

