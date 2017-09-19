<?php
@mysql_connect("localhost", "root", "") or
die("Could not connect: " . mysql_error());
mysql_select_db("tunahanc_data");

//Initialize your first couple variables
$encodedString = ""; //This is the string that will hold all your location data
$x = 0; //This is a trigger to keep the string tidy

//Now we do a simple query to the database
$result = mysql_query("SELECT * FROM `rsucrash` WHERE `kazaDurum` = 1  ORDER BY `tarih` DESC LIMIT 30");

//Multiple rows are returned
while ($row = mysql_fetch_array($result, MYSQL_NUM))
{
    //This is to keep an empty first or last line from forming, when the string is split
    if ( $x == 0 )
    {
        $separator = "";
    }
    else
    {
        //Each row in the database is separated in the string by four *'s
        $separator = "****";
    }
    //Saving to the String, each variable is separated by three &'s
    //this is for the shows the details in the map
    $encodedString = $encodedString.$separator.
        "<p class='content'><b>Lat:</b> ".$row[3].
        "<br><b>Long:</b> ".$row[4].
        "<br><b>Name: </b>".$row[5].
        "<br><b>AracID: </b>".$row[1].
        "<br><b>Kaza ID </b>".$row[0].
        "</p>&&&".$row[3]."&&&".$row[4];
    $x = $x + 1;
}
?>


<html>

<head>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLCluzVKAugaQh2SeTkf_zoURjYr_SIrU "></script>
    <script>

        jQuery(document).ready( function($){
            var geocoder;
            var map;
            var markersArray = [];
            var infos = [];

            geocoder = new google.maps.Geocoder();

            var myOptions = {
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }


            var map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
            map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
            var bounds = new google.maps.LatLngBounds();
            var encodedString;
            var stringArray = [];
            encodedString = document.getElementById("encodedString").value;
            stringArray = encodedString.split("****");
            var x;
            for (x = 0; x < stringArray.length; x = x + 1){
                var addressDetails = [];
                var marker;
                addressDetails = stringArray[x].split("&&&");
                var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);
                marker = new google.maps.Marker({
                    map: map,
                    position: lat,
                    content: addressDetails[0]
                });

                markersArray.push(marker);
                google.maps.event.addListener( marker, 'click', function () {
                    closeInfos();
                    var info = new google.maps.InfoWindow({content: this.content});
                    //On click the map will load the info window
                    info.open(map,this);
                    infos[0]=info;
                });
                bounds.extend(lat);
            }
            map.fitBounds(bounds);

            //Manages the info windows
            function closeInfos(){
                if(infos.length > 0){
                    infos[0].set("marker",null);
                    infos[0].close();
                    infos.length = 0;
                }
            }

        });


    </script>

</head>



<body>

<div id="googleMap" style="width:500px;height:380px;"></div>

</body>

</html>