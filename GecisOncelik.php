<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	$response = array();
	include("connect.php"); 	
	
	$link=Connection();

	$result=mysql_query("SELECT * FROM `GecisUstunlugu`  ORDER BY `ustunluk`",$link);
	
	 if($result!==FALSE){
	 		$response["oncelik"] = array();

		    while($row = mysql_fetch_array($result)) {
		        $kaza = array();
        		$kaza["aracID"] = $row["Aracid"];
       		    $kaza["Ustunluk"] = $row["ustunluk"];
       		    $kaza["Bilgi"] = $row["bilgi"];
       		  


       		    array_push($response["oncelik"], $kaza);		           
		    }
		     mysql_free_result($result);
		     mysql_close();

		     printf("<pre> %s </pre>",json_encode(($response), JSON_PRETTY_PRINT));
		  }
		  else{
		  	echo "Oncelikler atanmam";
		  	}
		  	
		  	?>