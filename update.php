<noscript>
<div align="center"><a href="index.php">Go Back To Upload Form</a></div><!-- If javascript is disabled -->
</noscript>
<html>
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Thread Exchange</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Online Clothing Exchange" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		
		<script src="js/init.js"></script> 
		<script type='text/javascript' src='js/gen_validatorv31.js'></script>
		<script src="js/pwdwidget.js" type="text/javascript"></script>  
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="js/jquery.timeago.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/fg_membersite.css" />
			<link rel="STYLESHEET" type="text/css" href="css/pwdwidget.css" />
			<link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css" />
		</noscript>
		<?php $con = mysqli_connect("localhost","root","", "test")or die (mysqli_error()); ?>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
<?php

require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

 $username = $_SESSION['username'];


//If you face any errors, increase values of "post_max_size", "upload_max_filesize" and "memory_limit" as required in php.ini
 function check_input($data) 
	{ 
		$data = trim($data); 
		$data = stripslashes($data); 
		$data = htmlspecialchars($data); 
		return $data; 
	};


$item = check_input($_POST['item']);
$price    = check_input($_POST['price']);
$describe   = check_input($_POST['describe']);
$describe = nl2br($describe);
if(empty($item) || empty($price))
{
    echo "<div class='error'>You did not fill out the required fields.</div>";
	die;
} 
foreach($_FILES as $file)
{
// some information about image we need later.
$ImageName 		= $file['name'];
$ImageSize 		= $file['size'];
$TempSrc	 	= $file['tmp_name'];
$ImageType	 	= $file['type'];

}



 //Some Settings
$ThumbSquareSize 		= 200; //Thumbnail will be 200x200
$BigImageMaxSize 		= 500; //Image Maximum height or width
$ThumbPrefix			= "thumb_"; //Normal thumb Prefix
$DestinationDirectory	= 'uploads/'; //Upload Directory ends with / (slash)
$Quality 				= 90;

//ini_set('memory_limit', '-1'); // maximum memory!


	
	
	echo  '<ul>';
	
	$processImage			= true;	
	$RandomNumber			= rand(0, 9999999999);  // We need same random name for both files.
		
		if($ImageName == NULL)
		{
			$title = $item;
			$cost = $price;
			$comments = $describe;	
			$image = $_GET['image'];
			$query = 'UPDATE approve_post SET title="'.$title.'",cost="'.$cost.'", comments="'.$comments.'" WHERE post_id="'.$_GET['post'].'"';

							
				 if(!mysqli_query( $con ,$query))
					{		
						//echo mysqli_error($con);
						echo '<div class="error">Error, could not update post.!</div>';
						die;
					} 
			
		
		
			
			
						echo '<div id="features-wrapper">';
						echo '<section id="features" class="container">';
						echo '<br />';
						echo '<br />';
							echo '<strong>Updated the following information: </strong>';
							
								echo '<section>';
									
										echo '<strong>Item Name: </strong>'. $title;
										echo "<br />";
										echo '<strong>Price: </strong>'. $cost;
										//echo '<h3>Seller Contact:</h3>';
										echo "<br />";
										
									
									echo '<strong>Description: </strong>'. $comments;
									echo '<br />';
									echo '<br />';
								
									
									
									
								echo '</section>';

				
						echo '<ul class="top">';
									echo '<li><a href="index.php">Back Home</a></li>';
									echo '<li><a href="uploadform.php">Upload Another Item</a></li>';
									echo '</ul>';
						
					
					
			
			echo'</section>';
			
			echo'</div>';
			
			die;
			
		}
		else
		{
			//Validate file + create image from uploaded file.
			switch(strtolower($ImageType))
			{
				case 'image/png':
					$CreatedImage = imagecreatefrompng($TempSrc);
					break;
				case 'image/gif':
					$CreatedImage = imagecreatefromgif($TempSrc);
					break;
				case 'image/jpeg':
				case 'image/pjpeg':
					$CreatedImage = imagecreatefromjpeg($TempSrc);
					break;
				default:
					$processImage = false; //image format is not supported!
			}
			//get Image Size
			list($CurWidth,$CurHeight)=getimagesize($TempSrc);

			//Get file extension from Image name, this will be re-added after random name
			$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
			$ImageExt = str_replace('.','',$ImageExt);
	
			//Construct a new image name (with random number added) for our new image.
			$NewImageName = $RandomNumber.'.'.$ImageExt;

			//Set the Destination Image path with Random Name
			$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name
			$DestRandImageName 			= $DestinationDirectory.$NewImageName; //Name for Big Image
			$title = $item;
			$cost = $price;
			$comments = $describe;
			//Resize image to our Specified Size by calling resizeImage function.
			if($processImage && resizeImage($CurWidth,$CurHeight,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
			{
				//Create a square Thumbnail right after, this time we are using cropImage() function
				/* if(!cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
					{
						echo 'Error Creating thumbnail';
					} */
					/*
					At this point we have succesfully resized and created thumbnail image
					We can render image to user's browser or store information in the database
					For demo, we are going to output results on browser.
					*/
					
					//Get New Image Size
					//list($ResizedWidth,$ResizedHeight)=getimagesize($DestRandImageName);
					
					//echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
					//echo '<tr>';
					//echo '<td align="center"><img src="uploads/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail" height="'.$ThumbSquareSize.'" width="'.$ThumbSquareSize.'"></td>';
					//echo '<td align="center"><img src="uploads/'.$NewImageName.'" alt="Resized Image" height="'.$ResizedHeight.'" width="'.$ResizedWidth.'"></td>';
					//echo '</tr>';
					//echo '</table>';
					/*
					Insert info into database table!
					mysql_query("INSERT INTO myImageTable (ImageName, ThumbName, ImgPath)
					VALUES ($DestRandImageName, $thumb_DestRandImageName, 'uploads/')");
					*/
					
					
					
					$query = 'UPDATE approve_post SET title="'.$title.'",cost="'.$cost.'", comments="'.$comments.'", imagename="'.$DestRandImageName.'", originalimage="'.$OriginalImage .'" WHERE post_id="'.$_GET['post'].'"';
					if(!mysqli_query( $con ,$query))
					{		
						//echo mysqli_error($con);
						echo '<div class="error">Error, could not update post.!</div>'
						die;
					} 
			
					
						
						
						
						echo '<div id="features-wrapper">';
						echo '<section id="features" class="container">';
							echo '<strong>Updated the following information: </strong>';
							echo '<br />';
							echo '<br />';
							echo '<ul class="top">';
									echo '<li><a href="index.php">Back Home</a></li>';
									echo '<li><a href="uploadform.php">Upload Another Item</a></li>';
									echo '</ul>';
							
								echo '<section>';
									
										echo '<strong>Item Name: </strong>'. $title;
										echo "<br />";
										echo '<strong>Price: </strong>'. $cost;
										//echo '<h3>Seller Contact:</h3>';
										echo "<br />";
										
									
									echo '<strong>Description: </strong>'. $comments;
									echo '<br />';
									echo '<br />';
									echo '<strong>Image: </strong>';
									echo '<br />';
									echo '<img src="'.$DestRandImageName.'"/>';
								echo '</section>';

				
						
						
					
					
					
					
					

							
				  
						
					
					echo'</section>';
			
			echo'</div>';		
							
			}else{
				echo '<div class="error">Error occurred while trying to process <strong>'.$ImageName.'</strong>! Please check if file is supported</div>'; //output error
			}
			
		}
		

	echo '</ul>';
	


	
// This function will proportionally resize image 
function resizeImage($CurWidth,$CurHeight,$DestFolder,$SrcImage,$Quality,$ImageType)
{
	$MaxHeight = 200;
	$MaxWidth = 200;
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	//Construct a proportional size of new image
	$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 
	$NewWidth  			= ceil($ImageScale*$CurWidth);
	$NewHeight 			= ceil($ImageScale*$CurHeight);
	
	if($CurWidth < $NewWidth || $CurHeight < $NewHeight)
	{
		$NewWidth = $CurWidth;
		$NewHeight = $CurHeight;
	}
	$NewCanves 	= imagecreatetruecolor($NewWidth, $NewHeight);
	// Resize Image
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	if(is_resource($NewCanves)) { 
      imagedestroy($NewCanves); 
    } 
	return true;
	}

}

//This function corps image to create exact square images, no matter what its original size!
function cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{	 
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	//abeautifulsite.net has excellent article about "Cropping an Image to Make Square"
	//http://www.abeautifulsite.net/blog/2009/08/cropping-an-image-to-make-square-thumbnails-in-php/
	if($CurWidth>$CurHeight)
	{
		$y_offset = 0;
		$x_offset = ($CurWidth - $CurHeight) / 2;
		$square_size 	= $CurWidth - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($CurHeight - $CurWidth) / 2;
		$square_size = $CurHeight - ($y_offset * 2);
	}
	
	$NewCanves 	= imagecreatetruecolor($iSize, $iSize);	
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size))
	{
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	if(is_resource($NewCanves)) { 
      imagedestroy($NewCanves); 
    } 
	return true;

	}
	  
}
