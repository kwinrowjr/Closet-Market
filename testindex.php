<!DOCTYPE html>

<html>
<body>
<table>
<?php 
	$con = mysqli_connect("localhost","root","", "test")or die (mysqli_error()); 
	$query = mysqli_query($con, "SELECT * FROM nba") or die (mysqli_error());
	
	
		while ($row = mysqli_fetch_assoc($query)){	
	
		echo 'Player: '.$row['Player'];
			}
						
						
						


											

?>
			


</body>
</html>