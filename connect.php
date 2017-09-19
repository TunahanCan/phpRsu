<?php

	function Connection(){
		// configuration
        $dbhost 	= "localhost";
        $dbname		= "tunahanc_Data";
        $dbuser		= "root";
        $dbpass		= "";

// database connection
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

        if(!$conn)
		{
		   echo "baglanti hatasi" ;
		   return null;
		}

        return $conn;
	}
?>
