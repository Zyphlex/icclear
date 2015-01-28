<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
      center: new google.maps.LatLng(44.5403, -78.5463),
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);
  }
  
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class='row'>
    <div class='col-md-12'>
        <h1>Routes</h1>
    </div>
</div>

<div class="row">  
    <?php foreach ($routes as $route) { ?>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class = "panel-heading">
                            <h3><?php $route->vertrekPunt ?></h3>
                        </div>
                        <div class="panel-body">
                            <p><?php $route->beschrijving ?></p>        
                        </div>
                    </div>  
                </div>
                <div class="col-md-5">
                    <div id="map-canvas"></div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
