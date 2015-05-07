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
<body class="homepage">
<?php include 'header_menu.php'; ?>
<div id="features-wrapper">
<h2><strong>Account Settings</strong></h2>

<p><a href='change-pwd.php'>Change password</a></p>
<p><a href='change-pwd.php'>View Posts</a></p>
<p><a href='uploadform.php'>Sell New Item</a></p>

<p><a href='access-controlled.php'>A sample 'members-only' page</a></p>
<br><br><br>
<p><a href='logout.php'>Logout</a></p>
</div>
	<div id="footer-wrapper">
		<?php include 'footer.php'; ?>
	</div>
</body>
</html>
