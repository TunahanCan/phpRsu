<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	$response = array();
	include("connect.php"); 	
	
	$link=Connection();

	$result=mysql_query("SELECT * FROM `sensorLog` WHERE `kazaDurum` =1",$link);
	
	 if($result!==FALSE){
	 		$response["Kazalar"] = array();

		    while($row = mysql_fetch_array($result)) {

                $kaza = array();
        		$kaza["aracID"] = $row["aracID"];
       		    $kaza["tarih"] = $row["tarih"];
       		    $kaza["enlem"] = $row["enlem"];
       		    $kaza["boylam"] = $row["boylam"];


       		    array_push($response["Kazalar"], $kaza);		           
		    }
		     mysql_free_result($result);
		     mysql_close();

		      printf("%s",json_encode($response));
		  }
		  else{
		  	echo "Kaza Yok Bro";
		  }
?>