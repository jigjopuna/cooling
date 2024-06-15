<div id="map" style="width:100%; height: 400px;"></div>
    <script>
      function initMap() {
        var uluru = {lat: 13.523730282912313, lng: 99.80733727355484};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCEninHT4zh2BRAKt9CwoHik235Yc6IG0&callback=initMap"></script>
