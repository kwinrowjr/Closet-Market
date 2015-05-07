<!DOCTYPE HTML>
<?php


require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

	





?>

<html>
<?php include 'header.php'; ?>

<?php
$post = $_GET['post'];
$title = $_GET['item'];
$sql = mysqli_query($con, "SELECT * FROM images WHERE post_id = '$post'");



$rowcount = mysqli_num_rows($sql);

if ($rowcount >= 5)
{
		
		
		echo '<br />';
		echo '<br />';
		echo '<br />';
		echo '<div class="error">You have reached maximum number (5) of pictures allowed for this post!!!!!<strong>';
		die;
}


?>
<script type="text/javascript"> 
$(document).ready(function() { 
//elements
var progressbox 		= $('#progressbox'); //progress bar wrapper
var progressbar 		= $('#progressbar'); //progress bar element
var statustxt 			= $('#statustxt'); //status text element
var submitbutton 		= $("#SubmitButton"); //submit button
var myform 				= $("#UploadForm"); //upload form
var output 				= $("#output"); //ajax result output element
var completed 			= '0%'; //initial progressbar value
var FileInputsHolder 	= $('#AddFileInputBox'); //Element where additional file inputs are appended
var MaxFileInputs		= 5 - <?php echo $rowcount; ?> //Maximum number of file input boxs

// adding and removing file input box
var i = $("#AddFileInputBox div").size() + 1;
$("#AddMoreFileBox").click(function (event) {
		event.returnValue = false;
		if(i < MaxFileInputs)
		{
			$('<span><input type="file" id="fileInputBox" size="20" name="file[]" class="addedInput" value=""/><a href="#" class="removeclass small2"><img src="images/close_icon.gif" border="0" /></a></span>').appendTo(FileInputsHolder);
			i++;
		}
		return false;
});

$("#uploaderform").on("click",".removeclass", function(event){
		event.returnValue = false;
		if( i > 1 ) {
				$(this).parents('span').remove();i--;
		}
		
}); 


	
$(myform).ajaxForm({
	beforeSend: function() { //brfore sending form
		submitbutton.attr('disabled', ''); // disable upload button
		statustxt.empty();
		progressbox.show(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color','#000'); //initial color of status text
		
	},
	uploadProgress: function(event, position, total, percentComplete) { //on progress
		progressbar.width(percentComplete + '%') //update progressbar percent complete
		statustxt.html(percentComplete + '%'); //update status text
		if(percentComplete>50)
			{
				statustxt.css('color','#fff'); //change status text to white after 50%
			}else{
				statustxt.css('color','#000');
			}
			
		},
	complete: function(response) { // on complete
		output.html(response.responseText); //update element with received data
		myform.resetForm();  // reset form
		submitbutton.removeAttr('disabled'); //enable submit button
		progressbox.hide(); // hide progressbar
	
	}
});

}); 
</script> 


<body class="homepage">
<?php include 'header_menu.php'; ?>
<div id="features-wrapper">
	<section id="features" class="container">

<h2>Multi Image Uploader</h2>



<link href="style.css" rel="stylesheet" type="text/css" />	


<form action="upload.php?post=<?php echo $post; ?>&&title=<?php echo $title; ?>&&count=<?php echo $rowcount; ?>" method="post" enctype="multipart/form-data" name="UploadForm" id="UploadForm">

	
     <!-- <span class="small"><a href="#" id="AddMoreFileBox">Add More Files</a></span> -->
	
	<?php 
	
		if ($rowcount == 4)
			{		
				echo'<div id="uploaderform">';
				echo'<div id="AddFileInputBox"><input id="fileInputBox" style="margin-bottom: 5px;" type="file"  name="file[]"/></div>';
				echo'<div class="sep_s"></div>';
				echo'</div>';
				echo'<br />';
	
				echo'<div class="container">';
				echo'<input type="submit" name="SubmitButton" value="Submit"/>';
				echo'<br />';
				echo'</div>';
    
  
				echo'<div id="uploaderform"><div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div></div>';
		
		
				die;
			}
	
	
	?>
	<div id="uploaderform">
	<span class="small"><a href="#" id="AddMoreFileBox">Add More Files</a></span>
    <div id="AddFileInputBox"><input id="fileInputBox" style="margin-bottom: 5px;" type="file"  name="file[]"/></div>
    <div class="sep_s"></div>
	</div>
	<br />
	
    <div class='container'>
    <input type="submit" name="SubmitButton" value="Submit"/>
	<br />
	</div>
    
  
	<div id="uploaderform"><div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div></div>

</form>






<div id="uploadResults">
	
    <div id="output"></div>
</div>
</section>
</div>


	<!-- Footer -->
		<div id="footer-wrapper">
			<?php include 'footer.php'; ?>
		</div>

	</body>
</html>
