<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	include("connect.php"); 	
	
	$link=Connection();

	$result=mysql_query("SELECT * FROM `RsuCrash` ",$link);
?>

<html>
   <head>
      <title>Kaza Yapan Araclar</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   </head>
<body>
   
<div class="thumbnail" style="width: 50%;margin:0 auto;">
   <table class="table table-striped" >
   <thead style="background-color: #e2e2e2;
    color: #636363;">
		<tr>
			<th>Arac ID</th>
			<th>Arac Adi</th>
			<th>Location</th>
			<th>information</th>
		</tr>
		</thead>
<tbody>
      <?php 
		  if($result!==FALSE){
		     while($row = mysql_fetch_array($result)) {
		       
		        printf("<tr class='danger'><td> %s </td><td> %s </td><td> %s </td><td> %s </td></tr>", 
		           $row["aracid"], $row["aracadi"], $row["location"], $row["information"]);
		           
		          
		     }
		     mysql_free_result($result);
		     mysql_close();
		  }
      ?>
</tbody>
   </table>
   </div>
  
</body>
</html>
