<?php include 'header.php'; ?>


<?php

//Define4 the query
$post = $_GET['post'];
$query = "DELETE FROM approve_post WHERE post_id='$post'";
//sends the query to delete the entry

if (!mysqli_query($con, $query)) { 
//if it updated


           echo '<strong>Deletion Failed</strong><br /><br />';


}else {


//if it failed
			echo "<br />";
			echo "<br />";
			
			 echo '<strong>Post Has Been Deleted</strong><br /><br />';
            
			$reset_query = "SELECT MAX( `id` ) FROM `approve_post`";

} 
?>