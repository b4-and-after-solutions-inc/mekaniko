    
    <div class="container-fluid">
        <section class="content pt-2">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title text-muted">Reservation</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <table id="mytable" class="table table-sm table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white">Shop Name</th>
                                        <th class="bg-info text-white">Location Name</th>
                                        <th class="bg-info text-white">Location Info</th>
                                        <th class="bg-info text-white">Branch Name</th>
                                        <th class="bg-info text-white">Service</th>
                                        <th class="bg-info text-white">Issue</th>
                                        <th class="bg-info text-white">Amount</th>
                                        <th class="bg-info text-white">Status</th>
                                        <th class="bg-info text-white text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($reservationData as $key=>$val){ 
                                    $status = $val['status'];
                                    if($status == 1){
                                        $status = 'Pending';
                                    }else if ($status == 2){
                                        $status = 'On-Process';
                                    }else if($status == 3){
                                        $status = 'Unsolve';
                                    }else if($status == 4){
                                        $status = 'Finished';
                                    }else if($status == 5){
                                        $status = 'Cancelled';
                                    }
                                        echo "<tr>"; 
                                        echo "<td>".$val['shop_name']."</td>";
                                        echo "<td>".$val['loc_name']."</td>";
                                        echo "<td>".$val['loc_info']."</td>";
                                        echo "<td>".$val['branch_name']."</td>";
                                        echo "<td>".$val['servicename']."</td>";
                                        echo "<td>".$val['issue']."</td>";
                                        echo "<td>"."&#8369;"." ".number_format($val['amount'])."</td>";
                                        echo "<td>".$status."</td>";

                                        if ($status == 'Cancelled'){
                                            echo "<td>".''."</td>";
                                        }else if($status == 'On-Process'){
                                            echo "<td>".'<button class="btn btn-primary" data-toggle="tooltip" title="On-Process"><i class="fas fa-spinner fa-spin"></i></button>'."</td>";
                                        }else if($status == 'Finished'){
                                            echo "<td>".'<span class="btn btn-success" data-toggle="tooltip"><i class="fas fa-check"></i></span>'."</td>";
                                        }else if($status == 'Pending'){
                                            echo "<td>".'<button class="btn btn-danger" onclick="cancel_reservation('.$val["res_id"].')" data-toggle="tooltip" title="Cancel" ><i class="fas fa-phone-slash"></i>Cancel</button>'."</td>";
                                        }else{
                                            echo "<td>".''."</td>";
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
                    
                    <h3 class="modal-title">Product Name</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form" >
                    <form action="#" id="form" class="form-horizontal">

                        <input type="hidden" value="" id ='id' name="id"/>
                        <input type="hidden" value="" id ='serviceid' name="serviceid"/>
                        <input type="hidden" value="" id ='resid' name="resid"/>

                        <div class="form-group">
                            <label class="control-label col-md-3">Product:</label>
                            <div class="col-md-9">
                                <select style='height:40px; width: 100%' class="form-control" name="product_name" id="product_name" onchange="populate_details()">
                                    <option value="">--Choose Product--</span></option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Quantity:</label>
                                <div class="col-md-9">
                                    <input name="quantity" id="quantity" class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Price:</label>
                                <div class="col-md-9">
                                    <input disabled name="price" id="price" class="form-control" type="text">
                                    <input name="price_hidden" id="price_hidden" class="form-control" type="hidden">
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Category:</label>
                                <div class="col-md-9">
                                    <input disabled name="category" id="category" class="form-control" type="text">
                                    <input name="category_hidden" id="category_hidden" class="form-control" type="hidden">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save_product()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form1" role="dialog" >
        <div class="modal-dialog" style="width: 70%">
            <div class="modal-content" >
                <div class="modal-header">
                    
                    <h3 class="modal-title">Product Name</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form" >
                    <form action="#" id="form1" class="form-horizontal">

                        <input type="hidden" value="" id ='id' name="id"/>
                        <input type="hidden" value="" id ='serviceid' name="serviceid"/>
                        <input type="hidden" value="" id ='resid' name="resid"/>

                        <div class="form-group">

                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save_product()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
<script>

$(document).ready( function () {
  $('#table_id').DataTable();
} );

var save_method; //for save method string
var table;
function add_product(serviceid, resid){

    $.ajax({
        url : "<?php echo site_url('main/ajax_reservation_product/')?>/" + serviceid,
        type: "GET",
        dataType: "JSON",
        success: function(data){

        $('[name="resid"]').val(resid);
        $('[name="serviceid"]').val(serviceid);
            var product = data['dropdown_data'];
            for(var i = 0; i < product.length; i++){
                $('#product_name').append($('<option>', {
                    value: product[i]['id'],
                    text: product[i]['product_name']
                }));
            }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Add Product'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}


function cancel_reservation(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Cancel it!'
    }).then((result) => {
    if (result.value) {
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/reservation_cancel')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Cancel", text: 'Reservation has been cancelled.',  type: 
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

//DROP DOWN PRODUCT DETAILS
function populate_details(){ 

    var  product_name = document.getElementById("product_name").value;
    
    //console.log(department);
    $.ajax({
        url : "<?php echo site_url('main/ajax_select_product_data/')?>/" + product_name,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            //$('[name="id"]').val(data[0].id);
            $('[name="quantity"]').val(data[0].quantity);
            $('[name="price"]').val(data[0].price);
            $('[name="price_hidden"]').val(data[0].price);
            $('[name="category"]').val(data[0].category);
            $('[name="category_hidden"]').val(data[0].category);

            //$('#modal_form2').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });

}


function save_product(){
var url;
url = "<?php echo site_url('main/reservation_product_add')?>";

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

            $('#modal_form').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error adding / update data');
        }

    });
}

</script>

