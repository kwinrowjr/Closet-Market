<!DOCTYPE HTML>
<?php


require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}


$title = $_GET['title'];
$cost = $_GET['cost'];
$comments = $_GET['comments'];
$post = $_GET['post'];
$username = $_GET['username'];
$image = $_GET['image'];
?>
<html>
<?php include 'header.php'; ?>
	<body class="homepage">
		<?php include 'header_menu.php'; ?>
		<div id="features-wrapper">
			<section id="features" class="container">
			<div class="row">
			
		
					<div class="4u" >
						
						<a class='image featured'><img src='<?php echo $image; ?>'/></a>
					</div>	
					<?php 
						$query = mysqli_query($con, "SELECT * FROM images WHERE post_id = '$post' and username = '$username'") or die (mysqli_error());	
					
						while ($row = mysqli_fetch_assoc($query)){	
					
						echo '<div class="4u" >';
							
							
						echo "<a href='#' class='image featured'><img src='".$row['ImageName']."'/></a>";
								
						echo '</div>';	
						
						}
						
						
						
						$rowcount = mysqli_num_rows($query);
						$result = 5 - $rowcount;
						if ($result == 0)
						{
						
							
						}else{
							
							
						for ($i = $rowcount;   $i <= 4; $i++){	
					
						echo '<div class="4u" >';
							
							
						echo "<a href='#' class='image featured'><img src='images/223507071.png'/></a>";
								
						echo '</div>';	
						
						}
						}
						
						
					?>				

				</div>
						
						<br />
						<br />
						Info
					
					
						<section style="text-align:center"> 
									
							<header>
										<h3>Item : <?php echo $title; ?></h3>
										<h3>Price : <?php echo $cost; ?></h3>
										<h3>Contact : <?php echo $title; ?></h3>
							</header>
									<p><strong>Description :</strong> <?php echo $comments; ?></p>
								</section>
					
					
					
			
			
			</section>	
		</div>
		