<div class="container-fluid">
    <section class="content pt-4">
        <div class="card">
        <center>
       
        <h1 style="color:green;font-weight: bold;">Freelance Mekaniko</h1>
        <h2 style="color:green"><?php echo $this->session->cosfirstname ?> <?php echo $this->session->coslastname ?></h2>
      
        </center>  
        </div>
    </section>
</div>
<div class="container-fluid">
    <section class="content pt-2">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col">
                      <div id="googleMap" style="width:100%;height:700px;"></div>
                    </div>
                </div>
                
            </div>
          
        </div>
    </section>
</div>

<div class="container-fluid">
    <section class="content pt-2">
        <div class="card">
            <div class="card-header">
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
                                    <th class="bg-info text-white">Location Name</th>
                                    <th class="bg-info text-white">Info</th>
                                    <th class="bg-info text-white">Latitude</th>
                                    
                                    <th class="bg-info text-white">Longitude</th>
                                    <th class="bg-info text-white text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  foreach($locationData as $key=>$val){ 
                                      echo "<tr>"; 
                                      echo "<td>".$val['loc_name']."</td>";
                                      echo "<td>".$val['loc_info']."</td>";
                                      echo "<td>".$val['latitude']."</td>";
                                      echo "<td>".$val['longitude']."</td>";
                                      echo "<td>".'<button class="btn btn-success" onclick="edit_location('.$val["mapid"].')" data-toggle="tooltip" title="Edit" ><i class="fas fa-edit"></i></button>'." ".'<button class="btn btn-danger" onclick="delete_location('.$val["mapid"].')" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash fa"></i></button>'."</td>";
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
                        <input type="hidden" value="" name="id"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Location Name:</label>
                                <div class="col-md-9">
                                    <input name="location_name" id="location_name" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Location Info:</label>
                                <div class="col-md-9">
                                    <input name="location_info" id="location_info" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Latitude:</label>
                                <div class="col-md-9">
                                    <input name="latitude" id="latitude" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Longitude:</label>
                                <div class="col-md-9">
                                    <input name="longitude" id="longitude" class="form-control" type="text">
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

<script>
/*function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}*/

function initMap() {
  const myLatlng = { lat: Number(15.8949), lng: Number(120.2863) };
  const map = new google.maps.Map(document.getElementById("googleMap"), {
    zoom: 13,
    center: myLatlng,
  });
  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to get Lat/Lng!",
    position: myLatlng,
  });

  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)


    );
    latitude = mapsMouseEvent.latLng.toJSON().lat;
    longitude = mapsMouseEvent.latLng.toJSON().lng;
    save_method = 'add';
    $('.modal-title').text('Add Location');
    $('#modal_form').modal('show'); // show bootstrap modal

    $('[name="latitude"]').val(latitude);
    $('[name="longitude"]').val(longitude);

    console.log(mapsMouseEvent.latLng.toJSON())
    console.log(mapsMouseEvent.latLng.toJSON().lat)
    console.log(mapsMouseEvent.latLng.toJSON().lng)


    infoWindow.open(map);
  });
}
function save(){
var url;
//document.getElementById("loader").style.display = "block";
if(save_method == 'add'){
    url = "<?php echo site_url('main/location_freelance_add')?>";
}
else{
    url = "<?php echo site_url('main/location_freelance_update')?>";
}
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

function edit_location(id){  
save_method = 'update';
$('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_edit_location/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            $('[name="id"]').val(data[0].mapid);
            $('[name="location_name"]').val(data[0].loc_name);
            $('[name="location_info"]').val(data[0].loc_info);
            $('[name="latitude"]').val(data[0].latitude);
            $('[name="longitude"]').val(data[0].longitude);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Location'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });

}


function delete_location(id){
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
            url : "<?php echo site_url('main/location_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                Swal.fire({title: "Deleted", text: 'Location has been deleted.',  type: 
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3w7WmW2ZzEWrFQ3s94rLDQ76SaYEa1xY&callback=initMap"></script>


