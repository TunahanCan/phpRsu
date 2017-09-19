<!DOCTYPE html>
<html>
<head>
    <title>Harita Goster</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/css/bootstrap.css" rel="stylesheet" media="screen">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
    <![endif]-->
    <style>
        html { height: 100% }
        body { height: 100%; background-color:#CCC }
        #map-outer {height: 440px; padding: 20px; border: 2px solid #CCC; margin-bottom: 20px; background-color:#FFF }
        #map-container { height: 400px }
        @media all and (max-width: 991px) {
            #map-outer  { height: 650px }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div id="map-outer" class="col-md-12">
            <div id="address" class="col-md-4">
                <h2>Lokasyon Bilgileri</h2>
                <address>
                    <strong>Rsu Bilgileri</strong>
                    <br>Serdivan<br>
                    30123<br>
                    Sakarya<br>
                    Türkiye<br>

                </address>
            </div>
            <div id='input'>

                <?php

                //Connect to the MySQL database that is holding your data, replace the x's with your data
                @mysql_connect("localhost", "root", "") or
                die("Could not connect: " . mysql_error());
                mysql_select_db("tunahanc_data");

                //Initialize your first couple variables
                $encodedString = ""; //This is the string that will hold all your location data
                $x = 0; //This is a trigger to keep the string tidy

                //Now we do a simple query to the database
                $result = mysql_query("SELECT * FROM `rsucrash` ORDER BY `tarih` DESC LIMIT 7");

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
            <div id="map-container" class="col-md-8"></div>

        </div><!-- /map-outer -->
    </div> <!-- /row -->

    <div class="row">
        <form class="form-horizontal" name="commentform">

            <div class="form-group">
                <div class="col-md-12">
                    <textarea rows="6" class="form-control" id="comments" name="comments" placeholder="Your question or comment here"></textarea>
                </div>
            </div>
            <div class="form-group">

            </div>
        </form>
    </div><!-- /row -->
</div><!-- /container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/js/bootstrap.min.js"></script>
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


        var map = new google.maps.Map(document.getElementById("map-container"), myOptions);
        map = new google.maps.Map(document.getElementById("map-container"), myOptions);


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
</body>
</html>