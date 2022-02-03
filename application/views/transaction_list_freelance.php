    
    <div class="container-fluid">
        <section class="content pt-2">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title text-muted">Transaction</h3>
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
                                        <th class="bg-info text-white">Customer Name</th>
                                        <th class="bg-info text-white">Issue</th>
                                        <th class="bg-info text-white">Service</th>
                                        <th class="bg-info text-white">Amount</th>
                                        <th class="bg-info text-white">Status</th>
                                        <th class="bg-info text-white text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($reservationOwnerData as $key=>$val){ 
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
                                        echo "<td>".$val['customername']."</td>";
                                        echo "<td>".$val['issue']."</td>";
                                        echo "<td>".$val['servicename']."</td>";
                                        echo "<td>".$val['amount']."</td>";
                                        echo "<td>".$status."</td>";

                                        if ($status == 'Cancelled'){
                                            echo "<td>".''."</td>";

                                        }else if($status == 'On-Process'){
                                            echo "<td>".'<button class="btn btn-primary" data-toggle="tooltip" title="On-Process"><i class="fas fa-spinner fa-spin"></i></button>'.' '.'<button class="btn btn-primary" onclick="finish_reservation('.$val["res_id"].')" data-toggle="tooltip" title="On-Process"><i class="fas fa-wrench"></i>Finish</button>'.' '.'<button class="btn btn-danger" onclick="unsolve_reservation('.$val["res_id"].')" data-toggle="tooltip" title="Unsolve"><i class="fas fa-window-close"></i>Unsolve</button>'."</td>";
                                        }
                                        else if($status == 'Unsolve'){
                                            echo "<td>".'<span class="btn btn-danger" data-toggle="tooltip"><i class="fas fa-window-close"> Unsolve</i></span>'."</td>";
                                        }else if($status == 'Finished'){
                                            echo "<td>".'<span class="btn btn-success" data-toggle="tooltip"><i class="fas fa-check"></i>Finished</span>'."</td>";
                                        }
                                        else{
                                            echo "<td>".'<button class="btn btn-primary" onclick="process_reservation('.$val["res_id"].')" data-toggle="tooltip" title="Process" ><i class="fas fa-sync"></i>Process</button>'.' '.'<button class="btn btn-danger" onclick="cancel_reservation('.$val["res_id"].')" data-toggle="tooltip" title="Cancel" ><i class="fas fa-phone-slash"></i>Cancel</button>'.' '.'<button class="btn btn-warning" onclick="view_reservation('.$val["res_id"].')" data-toggle="tooltip" title="View" ><i class="fas fa-eye"></i>View</button>'."</td>";
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
        <div class="modal-dialog" >
            <div class="modal-content" >
                <div class="modal-header">
                    
                    <h3 class="modal-title">Location</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form" >
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" id='id' name="id"/>

                        <input type="hidden" value="" id ='mapuserid' name="mapuserid"/>
                        <input type="hidden" value="" id ='latitude' name="latitude"/>
                        <input type="hidden" value="" id ='longitude' name="longitude"/>
                        <div class="form-body">

                            <div class="form-group">
                                <div class="form-group">
                                    <div class="col">
                                      <div id="googleMap" style="width:100%;height:400px;"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
<script>

$(document).ready( function () {
  $('#table_id').DataTable();
} );
var map;
//var id ='';
function initMap(id) {
var center = new google.maps.LatLng(15.8949, 120.2863);
var geocoder = new google.maps.Geocoder();


var mapOptions = {
zoom: 13,
center: center,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
if (typeof id == 'undefined'){

}else{
    $.ajax({

    url : "<?php echo site_url('main/ajax_edit_location_customer_plot/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        //console.log(data);

        for (var i = 0; i < data.length; i++) {
          displayLocation(data[i]);
        }
      },
      error: function (jqXHR, textStatus, errorThrown){
          alert('Error get data from ajax');
      }
  });
}
  
}

function displayLocation(location) {
var infowindow = new google.maps.InfoWindow();
var content =   '<div class="infoWindow"><strong>'  + location.customername + '</strong>'
+ '<br/>'     +'Issue :'+ location.issue
+ '<br/>'     +'Service Needed :'+ location.servicename + '</div>';

  if (parseInt(location.latitude) == 0) {
    geocoder.geocode( { 'address': location.loc_name }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {

      var marker = new google.maps.Marker({
      map: map,
      position: results[0].geometry.location,
      title: location.branch_name
      });

      google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent(content);
      infowindow.open(map,marker);
      });
    }
    });
  } 
  else {
    var position = new google.maps.LatLng(parseFloat(location.latitude), parseFloat(location.longitude));
    var marker = new google.maps.Marker({
    map: map,
    position: position,
    title: location.branch_name
    });

    google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(content);
    infowindow.open(map,marker);
    });
  }
}


var save_method; //for save method string
var table;

function process_reservation(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "Do you want to Process this Transaction?",
    showCancelButton: true,
    confirmButtonColor: '#548ce8',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Process it!'
    }).then((result) => {
    if (result.value) {
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/reservation_process')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Process", text: 'Reservation has been processed.',  type: 
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

function finish_reservation(id){
    Swal.fire({
    title: 'Are you sure?',
    showCancelButton: true,
    confirmButtonColor: '#22bbe6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
    }).then((result) => {
    if (result.value) {
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/reservation_finish')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Finish", text: 'Sucessfully Finished.',  type: 
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

function unsolve_reservation(id){
    Swal.fire({
    title: 'Are you sure this Transaction is Unsolved?',
    showCancelButton: true,
    confirmButtonColor: '#22bbe6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
    }).then((result) => {
    if (result.value) {
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('main/reservation_unsolve')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Unsolve", text: 'Unsolved Transaction.',  type: 
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

function view_reservation(id){
    $('#form')[0].reset(); // reset form on modals
    $('.modal-title').text('View Customer');
    $('#modal_form').modal('show'); // show bootstrap modal


    initMap(id);

    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3w7WmW2ZzEWrFQ3s94rLDQ76SaYEa1xY&libraries=places&callback=initMap">
</script>


