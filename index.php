<!DOCTYPE html>

<html>

	<?php include 'header.php'; ?>
	<script type="text/javascript"> 
	jQuery(document).ready(function() {
	jQuery("time.timeago").timeago();
		});
	</script> 
	<body class="homepage">
		<?php include 'header_menu.php'; ?>
		
			
		<!-- Features -->
			<div id="features-wrapper">
				<section id="features" class="container">
					<header>
						<h2>Browse Products <strong>HERE</strong>!</h2>
					</header>
					<div class="row">
					<?php
					
					

					
					
					$query = mysqli_query($con, "SELECT * FROM approve_post ORDER BY id ASC LIMIT 15") or die (mysqli_error());
	
	
					while ($row = mysqli_fetch_assoc($query)){	
						

							
								echo '<section>';
									echo "<a href='#' class='image featured'><img src='".$row['imagename']."'/></a>";
									echo '<header>';
										
										$date = $row['date'];
										//$date = strtotime($date);
										 
										
										echo '<strong>Created: </strong><time class="timeago" title="'.$date.'">'.$date.'</time>';
										//echo '<strong> Created: </strong> '.ago($date);
										//echo 'created: '.$date;
										echo "<br />";
										echo 'Item Name: '.$row['title'];
										echo "<br />";
										echo 'Price: '.$row['cost'];
										
										
									echo '</header>';
									echo '<a href="item_page.php?title='.$row['title'].'&&cost='.$row['cost'].'&&comments='.$row['comments'].'&&username='.$row['username'].'&&post='.$row['post_id'].'&&image='.$row['imagename'].'">View More</a>';
								echo '</section>';

				
						}
						
						
						
function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] 'ago' ";
}
											

						?>
					</div>
			
				</section>		
			</div>
		
		

	
		<!-- Footer -->
		<div id="footer-wrapper">
			<?php include 'footer.php'; ?>
		</div>

	</body>
</html>