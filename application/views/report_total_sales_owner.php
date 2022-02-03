    
    <div class="container-fluid">
        <section class="content pt-2">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title text-muted">Total Sales</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <table id="mytable" class="table table-sm table-striped nowrap">
                            <!--<table style="width:100%;" border="1">-->    
                                <tr>
                                    <td class="bg-info text-white">Shop Name</td>
                                    <td class="bg-info text-white" colspan="2">Service Offered</td>
                                    <td class="bg-info text-white" colspan="2">Product Availed</td>
                                    <td class="bg-info text-white" >Product Quantity</td>

                                    <td class="bg-info text-white">Total</td>
                                </tr>

                                <tbody id="table_body" name='table_body'> 
                                    <?php
                                    $temp = "";
                                    $row_count = 0;
                                    $total =0;

                                    for($i = 0; $i < count($reportsData); $i++){
                                      $row = $reportsData[$i];

                                      if($temp != $row['res_id'] || $i == 0){
                                        $price = $row['price'];
                                        $quantity = $row['quantity'];

                                        $total = $price*$quantity;
                                        $temp = $row['res_id'];
                                        echo "<tr style ='background-color:#238796!important'>"."<td style='color:white'>".''."</td>";
                                        echo "<td style='color:white'>".'Service'."</td>";
                                        echo "<td style='color:white'>".'Service Amount'."</td>";

                                        echo "<td style='color:white'>".'Product'."</td>";
                                        echo "<td style='color:white'>".'Amount'."</td>";
                                        echo "<td style='color:white'>".''."</td>";
                                        echo "<td style='color:white'>".''."</td>";
                                        echo "</tr>";

                                        echo "<tr>";
                                        echo "<td>".$row['shop_name']."</td>";
                                        echo "<td>".$row['servicename']."</td>";
                                        echo "<td>".$row['amount']."</td>";
                                        echo "<td>".$row['product_name']."</td>";
                                        echo "<td>".$row['price']."</td>";
                                        echo "<td>".$row['quantity']."</td>";

                                        echo "<td>".$total."</td>";
                                        echo "</tr>";
                                        $row_count = 0;
                                      } 
                                      $row_count++;
                                      $amount = $row['amount'];
                                      $total = $total + $amount;
                                    }
                                    echo "<tr>"; 
                                    echo "<td colspan='5' style='font-size:15pt;font-weight:bold'>".'Total Sales'."</td>";
                                    echo "<td>".''."</td>";
                                    echo "<td style='font-size:15pt;'>".number_format($total,2)."</td>";
                                    echo "</tr>";
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
                                <label class="control-label col-md-3">Service:</label>
                                <div class="col-md-9">
                                    <input name="service" id="service" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Amount:</label>
                                <div class="col-md-9">
                                    <input name="amount" id="amount" class="form-control" type="text">
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
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Product:</label>
                                <div class="col-md-9">
                                    <input name="product_name" id="product_name" class="form-control" type="text">
                                </div>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save_product()" class="btn btn-primary">Save</button>
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


function add_product(id){
    save_method = 'add';
    $('#form1')[0].reset(); // reset form on modals
    $('.modal-title').text('Add Product');
    $('#modal_form1').modal('show'); // show bootstrap modal


    $('[name="serviceid"]').val(id);
}

function save(){
var url;
//document.getElementById("loader").style.display = "block";
if(save_method == 'add'){
    url = "<?php echo site_url('main/service_owner_add')?>";
}
else{
    url = "<?php echo site_url('main/service_owner_update')?>";
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


function save_product(){
var url;
//document.getElementById("loader").style.display = "block";
if(save_method == 'add'){
    url = "<?php echo site_url('main/product_add')?>";
}
else{
    url = "<?php echo site_url('main/product_update')?>";
}
    // ajax adding data to database 
    $.ajax({

        url : url,
        type: "POST",
        data: $('#form1').serialize(),
        dataType: "JSON",
        success: function(data){
            swal({title: "Successfully saved", type: 
                "success"}).then(function(){ 
                    location.reload();
                }
            );

            $('#modal_form1').modal('hide');
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

            $('[name="id"]').val(data[0].id);
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



function edit_product(id){  
save_method = 'update';
$('#form1')[0].reset(); // reset form on modals
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_edit_product/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            $('[name="id"]').val(data[0].id);
            $('[name="product_name"]').val(data[0].product_name);
            $('[name="quantity"]').val(data[0].quantity);


            $('#modal_form1').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Product'); // Set title to Bootstrap modal title
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
    confirmButtonText: 'Yes, Archive it!'
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



function delete_product(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Remove it!'
    }).then((result) => {
    if (result.value) {
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/product_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Remove", text: 'Product has been Removed.',  type: 
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

