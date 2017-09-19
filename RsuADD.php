<?php

if (isset($_POST['AracID'])){
    $enlem=$_POST["Enlem"];
    $boylam=$_POST["Boylam"];
    $name=$_POST["AracADI"];
    $inf=$_POST["Information"];
    $aracid=$_POST["AracID"];


    include("connect.php");
      
      $link=Connection();

    $query = "INSERT INTO `RsuCrash` (`enlem`,`boylam`, `name`,`information`, `aracid`) 
      VALUES ('".$enlem."','".$boylam."','".$name."','".$inf."','".$aracid."')";

   mysql_query($query,$link);
   mysql_close($link);

      header("Location: index.php");
}
else{
echo "Bilgiler eksik bro";
}

   	
?>
