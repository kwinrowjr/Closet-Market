<?php
$itemname = check_input($_POST['item'], "Enter your name");
$price    = check_input($_POST['price']);
$describ   = check_input($_POST['describ']);
$comments = check_input($_POST['comments'], "Write your comments");
?>

<html>
<body>

Your name is: <?php echo $itemname; ?><br />
Your e-mail: <?php echo $price; ?><br />
<br />

Do you like this website? <?php echo $likeit; ?><br />
<br />

Description:<br />
<?php echo $describ; ?>

</body>
</html>

<?php
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>
