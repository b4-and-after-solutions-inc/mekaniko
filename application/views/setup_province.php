    
    <div class="container-fluid">
        <section class="content pt-2">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title text-muted">Province</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">

                    <button class="btn btn-success" onclick="add_province()"><i class="glyphicon glyphicon-plus"></i> Add Province</button>

                    <div class="row mt-3">
                        <div class="col">
                            <table id="mytable" class="table table-sm table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white">Province Name</th>
                                        <th class="bg-info text-white text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($provinceData as $key=>$val){ 
                                        echo "<tr>"; 
                                        echo "<td>".$val['province_name']."</td>";
                                        echo "<td>".'<button class="btn btn-success" onclick="edit_province('.$val["id"].')" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_province('.$val["id"].')" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash fa"></i></button>'."</td>";
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
                    
                    <h3 class="modal-title">Province Name</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form" >
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="id"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Province:</label>
                                <div class="col-md-9">
                                    <input name="province_name" id="province_name" class="form-control" type="text">
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

function add_province(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.modal-title').text('Add Province');
    $('#modal_form').modal('show'); // show bootstrap modal

    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function save(){
var url;
//document.getElementById("loader").style.display = "block";
if(save_method == 'add'){
    url = "<?php echo site_url('main/province_add')?>";
}
else{
    url = "<?php echo site_url('main/province_update')?>";
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

function edit_province(id){  
save_method = 'update';
$('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_edit_province/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            $('[name="id"]').val(data.id);
            $('[name="province_name"]').val(data.province_name);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Province'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });

}

function delete_province(id){
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
            url : "<?php echo site_url('main/province_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Deleted", text: 'Province has been deleted.',  type: 
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

