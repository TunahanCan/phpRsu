<?php

if (isset($_POST['kazaDurum'])){
	$arac=$_POST["arac"];
	$kazaDurum=$_POST["kazaDurum"];
    $enlem=$_POST["enlem"];
    $boylam=$_POST["boylam"];
    $otobilgi=$_POST["OtoBilgi"];


include("connect.php");
      
      $link=Connection();

      $query = "INSERT INTO `sensorLog` (`aracID`,`kazaDurum`, `enlem`, `boylam`, `OtoBilgi`) 
      VALUES ('".$arac."','".$kazaDurum."','".$enlem."','".$boylam."','".$otobilgi."')"; 

  

      
      mysql_query($query,$link);
   mysql_close($link);

      header("Location: index.php");
}
else{
echo "Bilgiler eksik bro";
}

   	
?>
