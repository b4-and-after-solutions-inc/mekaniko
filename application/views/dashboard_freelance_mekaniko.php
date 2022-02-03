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
            <span style="font-weight: bold;"> Your Location</span>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col">
                      <div id="googleMap" style="width:100%;height:600px;"></div>
                    </div>
                </div>
                
            </div>
          
        </div>
    </section>
</div>
<script>
var map;
function initMap() {
var center = new google.maps.LatLng(15.8949, 120.2863);
var geocoder = new google.maps.Geocoder();


var mapOptions = {
zoom: 13,
center: center,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
  $.ajax({
      url : "<?php echo site_url('main/ajax_edit_location_plot/')?>",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        //console.log(data);

        for (var i = 0; i < data.length; i++) {
          //var latitude = data[i].latitude;
          //var longitude = data[i].longitude;
          displayLocation(data[i]);
          /*console.log(latitude);
          var myLatLng = { lat: Number(latitude), lng: Number(longitude) };
          var map = new google.maps.Map(document.getElementById("googleMap"), {
            zoom: 4,
            center: myLatLng,
          });

          new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
          });*/
          
          /*var myLatlng = new google.maps.LatLng(15.465055422241349,120.97963655355953);
          var mapOptions = {
            zoom: 4,
            center: myLatlng
          }
          var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

          var marker = new google.maps.Marker({
              position: myLatlng,
              title:"Hello World!"
          });*/
        }
      },
      error: function (jqXHR, textStatus, errorThrown){
          alert('Error get data from ajax');
      }
  });
  
}

function displayLocation(location) {
var infowindow = new google.maps.InfoWindow();
var content =   '<div class="infoWindow"><strong>'  + location.loc_name + '</strong>'
+ '<br/>'     + location.loc_info+ '</div>';

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

function save(){
var url;
//document.getElementById("loader").style.display = "block";
if(save_method == 'add'){
    url = "<?php echo site_url('main/location_add')?>";
}
else{
    url = "<?php echo site_url('main/location_update')?>";
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

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3w7WmW2ZzEWrFQ3s94rLDQ76SaYEa1xY&callback=initMap"></script>-->

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3w7WmW2ZzEWrFQ3s94rLDQ76SaYEa1xY&libraries=places&callback=initMap">
</script>


