<html>
<head>
    <script type='text/javascript' src='assets/js/jquery-1.6.2.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery-ui.min.js'></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <style>

        BODY {font-family : Verdana,Arial,Helvetica,sans-serif; color: #000000; font-size : 13px ; }

        #map { width:100%; height: 100%; z-index: 0; }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLCluzVKAugaQh2SeTkf_zoURjYr_SIrU "></script>

    <script type='text/javascript'>
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


            var map = new google.maps.Map(document.getElementById("map"), myOptions);
            map = new google.maps.Map(document.getElementById("map"), myOptions);


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



<div id='input'>

    <?php

    //Connect to the MySQL database that is holding your data, replace the x's with your data
    @mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
    mysql_select_db("googlemap");

    //Initialize your first couple variables
    $encodedString = ""; //This is the string that will hold all your location data
    $x = 0; //This is a trigger to keep the string tidy

    //Now we do a simple query to the database
    $result = mysql_query("SELECT * FROM `locations`");

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
            "<p class='content'><b>Lat:</b> ".$row[1].
            "<br><b>Long:</b> ".$row[2].
            "<br><b>Name: </b>".$row[3].
            "<br><b>Address: </b>".$row[4].
            "<br><b>Division: </b>".$row[5].
            "</p>&&&".$row[1]."&&&".$row[2];
        $x = $x + 1;
    }
    ?>

    <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
</div>
<div id="map"></div>

<div id="bilgileriGoster">

    <h1>   merhaba  </h1>

</div>
</body>
</html>