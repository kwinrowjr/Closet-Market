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
var MaxFileInputs		= 4; //Maximum number of file input boxs

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

$("#ShowForm").click(function () {
  $("#uploaderform").slideToggle(); //Slide Toggle upload form on click
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




<h2>Edit Information <strong>HERE</strong>!</h2>
<div id="form">

<link href="style.css" rel="stylesheet" type="text/css" />	

<header>

</header>
<?php 

$title = $_GET['item'];
$price = $_GET['price'];
$describe = $_GET['describe'];
$post = $_GET['post'];
$image = $_GET['image'];



?>
<form action="update.php?post=<?php echo $post;?>&&image=<?php echo $image;?>" method="post" enctype="multipart/form-data" name="UploadForm" id="UploadForm">

	<br />
     <!-- <span class="small"><a href="#" id="AddMoreFileBox">Add More Files</a></span> -->
    </label>
	 <span class="small">Upload New Image</span>
     <div id="uploaderform"><div id="AddFileInputBox"><input id="fileInputBox" style="margin-bottom: 5px;" type="file"  name="file" /></div></div>
    <div class="sep_s"></div>
	<div class='container'>
    <span class="small">Update Item Name</span>
    <div><input name="item" type="text" id="name" value="<?php echo $title;?>" /></div>
	</div>
    
	<div class='container'>
    <span class="small">Change Your Price</span>
    <div><input name="price" type="text" id="price" value="<?php echo $price;?>" /></div>
	</div>
	
	<div class='container'>
	<span class="small">Update Description</span>
	<textarea name="describe" ROWS=4 COLS=6><?php echo $describe;?></textarea>
	</div>
	<br />


	
   
    
  
    
    <div class='container'>
    <input type="submit" name="SubmitButton" value="Update"/>
	<br />
	</div>
    
  
  <div id="uploaderform"><div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div></div>

</form>
</div>





<div id="uploadResults">
	
    <div id="output"></div>
</div>

</div>


	<!-- Footer -->
		<div id="footer-wrapper">
			<?php include 'footer.php'; ?>
		</div>

	</body>
</html>
