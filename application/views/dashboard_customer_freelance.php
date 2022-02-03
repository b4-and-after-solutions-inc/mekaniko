<div class="container-fluid">
    <section class="content pt-4">
        <div class="card">
        <center>
        <h1 style="color:green;">WELCOME</h1>
        <h2 style="color:green;font-weight: bold;"><?php echo $this->session->cosfirstname ?> <?php echo $this->session->coslastname ?></h2>
      
        </center>  
        </div>
    </section>
</div>
<div class="container-fluid">
    <section class="content pt-2">
        <div class="card">
            <div class="card-header">
            <span style="font-weight: bold;"> Freelance Mekaniko Tracker</span>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col">
                      <div id="googleMap" style="width:100%;height:400px;"></div>
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
                                    <label class="control-label col-md-3">Location:</label>
                                    <div class="col-md-9">
                                        <input name="location_name" id="location_name" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Location Info:</label>
                                    <div class="col-md-9">
                                        <input name="location_info" id="location_info" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Services:</label>
                                <div class="col-md-9">
                                    <select style='height:40px; width: 100%' class="form-control" name="service_name" id="service_name">
                                        <option value="">--Choose Services--</span></option>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Issue Description:</label>
                                    <div class="col-md-9">
                                        <input name="issue" id="issue" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Process Reservation</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script>
//GET CURRENT LOCATION
let map, infoWindow;
function initMap() {
  map = new google.maps.Map(document.getElementById("googleMap"), {
    center: { lat: Number(15.8949), lng: Number(120.2863) },
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  infoWindow = new google.maps.InfoWindow();

  const locationButton = document.createElement("button");

  locationButton.textContent = "CLICK HERE";
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          infoWindow.setPosition(pos);
          infoWindow.setContent("Your Location.");
          infoWindow.open(map);
          map.setCenter(pos);

          //console.log(pos);
            
            var lat = pos.lat;
            var lng = pos.lng;
            var R = 6371; // radius of earth in km
            var distances = [];
            var closest = -1;

            
            $.ajax({
              url : "<?php echo site_url('main/ajax_edit_location_plot_all_freelance/')?>",
              type: "GET",
              dataType: "JSON",
              success: function(data){
                //console.log(data);

                for (var i = 0; i < data.length; i++) {

                    //displayLocation(data[i]);

                    var mlat = data[i].latitude;
                    var mlng = data[i].longitude;
                    var dLat  = rad(mlat - lat);
                    var dLong = rad(mlng - lng);

                    //console.log(mlat);

                    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                    Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                    var d = R * c;
                    distances[i] = d;
                    if ( closest == -1 || d < distances[closest] ) {
                        closest = i;
                        displayLocation(data[i],lat,lng);
                    }

                    //displayLocation(data[i]);
                    //alert(data[closest].title);
                }
              },
              error: function (jqXHR, textStatus, errorThrown){
                  alert('Error get data from ajax');
              }
            });

        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
}
function rad(x) {return x*Math.PI/180;}

//FOR ERROR
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}

//DISPLAY PIN
function displayLocation(location,lat,lng) {
//console.log(location);

var infowindow = new google.maps.InfoWindow();
var content =   '<div class="infoWindow"><strong>'  + location.owners_name + '</strong>'
+ '<br/>'     + location.loc_name
+ '<br/>'     + location.loc_info + '</div>';

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

    //console.log(lat);
    reservation(location.mapid,lat,lng);

    });
  }
}


function reservation(id,lat,lng) {
    //Ajax Load data from ajax edit
    $.ajax({
        url : "<?php echo site_url('main/ajax_reservation/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){

            $('[name="id"]').val(data[0].mapid);
            $('[name="mapuserid"]').val(data[0].mapuserid);
            $('[name="location_name"]').val(data[0].loc_name);
            $('[name="location_info"]').val(data[0].loc_info);
            $('[name="latitude"]').val(lat);
            $('[name="longitude"]').val(lng);

            var services = data['dropdown_data'];
            for(var i = 0; i < services.length; i++){
                $('#service_name').append($('<option>', {
                    value: services[i]['serviceid'],
                    text: services[i]['servicename'] +' ('+ 'Amount:' +services[i]['amount'] +')'
                }));
            }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Transaction'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}




function save(){
var url;
url = "<?php echo site_url('main/reservation_add')?>";

    // ajax adding data to database 
    $.ajax({

        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data){
            swal({title: "Reservation Success", type: 
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
            $('[name="branch_name"]').val(data[0].branch_id);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Shop'); // Set title to Bootstrap modal title
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


