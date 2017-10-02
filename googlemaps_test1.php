<!DOCTYPE html>
<html>
  <head>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyDn7_nt8d_wUPOVGmkzTtiMfZgeQzZ8jyI" type="text/javascript"></script>
  </head>
  <body>
    <div id="map" style="width: 100%; height: 300px;"></div>

    

<?php
mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
mysql_select_db("userInfromation");

$addresses=array();

$result = mysql_query("SELECT address FROM info");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    array_push($addresses,$row[0]); 
}

for ($i=0;$i<sizeof($addresses);$i++) {
     printf("address: %s", $addresses[$i]); 
}

mysql_free_result($result);
?>


<script type="text/javascript">// <![CDATA[


var mapOptions = {
    zoom: 16,
    center: new google.maps.LatLng(54.00, -3.00),
    mapTypeId: google.maps.MapTypeId.ROADMAP
};

var geocoder = new google.maps.Geocoder();

var address = <?php echo json_encode($addresses); ?>;
console.log(address);



var arr = [];

for(var x in address){
    console.log(address[x]);
  arr.push(address[x]);
}
console.log(address[x]);

// var address = ['55A Woodland Avenue, Kohuwala 10250','3410 Taft Blvd  Wichita Falls, TX 76308'];

for(var i=0;i<arr.length;i++){
geocoder.geocode( { 'address': arr[i]}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
    } else {
        alert("Geocode was not successful for the following reason: " + status);
    }
});
}

var map = new google.maps.Map(document.getElementById("map"), mapOptions);
// ]]></script>
  </body>
</html>





