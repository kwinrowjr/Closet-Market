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
	<head>

<title>Untitled Document</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Online Clothing Exchange" />
<meta name="keywords" content="" />
<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dropotron.min.js"></script>
<script src="js/skel.min.js"></script>
<script src="js/skel-layers.min.js"></script>
<script src="js/init.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<noscript>
	<link rel="stylesheet" href="css/skel.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/style-desktop.css" />
</noscript>
<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->

</head>
Welcome back <?= $_SESSION['username'] ?>!
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

			<div id="header-wrapper">
				<div id="header" class="container">
					
					<!-- Logo -->
						<h1 id="logo"><a href="index.html">Closet Market</a></h1>
						<p>"Online Clothing Exchange"</p>
						
					
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a class="icon fa-home" href="index.html"><span>Home</span></a></li>
								<li>
									<a href="" class="icon fa-bar-chart-o"><span>Search</span></a>
											<ul>
												<li><a href="#">Magna phasellus</a></li>
												<li><a href="#">Etiam dolore nisl</a></li>
												<li><a href="#">Phasellus consequat</a></li>
											</ul>
								</li>
								<!-- <li><a class="icon fa-cog" href="left-sidebar.html"><span>Left Sidebar</span></a></li>
								<li><a class="icon fa-retweet" href="right-sidebar.html"><span>Right Sidebar</span></a></li>
								<li><a class="icon fa-sitemap" href="no-sidebar.html"><span>No Sidebar</span></a></li> -->
							</ul>
						</nav>

				</div>
			</div>





<h2>Sell New Item <strong>HERE</strong>!</h2>
<div id="form">

<link href="style.css" rel="stylesheet" type="text/css" />	

<header>

</header>
<form action="upload_editor.php" method="post" enctype="multipart/form-data" name="UploadForm" id="UploadForm">

	<br />
     <!-- <span class="small"><a href="#" id="AddMoreFileBox">Add More Files</a></span> -->
    </label>
	 <span class="small">Upload a Image</span>
     <div id="uploaderform"><div id="AddFileInputBox"><input id="fileInputBox" style="margin-bottom: 5px;" type="file"  name="file"/></div></div>
    <div class="sep_s"></div>
	 <span class="small">* Required Field</span>
	<div class='container'>
    <span class="small">Item Name *</span>
    <div><input name="item" type="text" id="name" placeholder="Item Name" /></div>
	</div>
    
	<div class='container'>
    <span class="small">Price your item *</span>
    <div><input name="price" type="text" id="price" placeholder="Price" /></div>
	</div>
	
	<div class='container'>
	<span class="small">Description</span>
	<textarea name="describe" ROWS=4 COLS=6></textarea>
	</div>
	<br />


	
   
    
  
    
    <button type="submit" class="button" id="SubmitButton">Upload</button>
	<br />
    
  
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
