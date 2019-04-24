<!DOCTYPE html>
<html>
<head>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<title>User Login</title>
</head>
<body>
    <?php

if (($_POST['username']=="") || ($_POST['password']=="")){
    header("Location: LoginMenu.html");
    exit;
}
$display_block="";

//$mysqli = mysqli_connect("localhost", "root","","lisabalbach_rober260") or die(mysqli_error());
$mysqli = mysqli_connect("localhost", "lisabalbach_rober260", "CIT190118", "lisabalbach_Robertson") or die(mysqli_error());

$safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);

$sql = "SELECT firstName, lastName FROM auth_users WHERE username = '".$safe_username."' AND password = '".$safe_password."'";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($result) ==1){
    header("Location:MainMenu.html");
    exit;
}else {
    $display_block="<p stlye='text-align:center; font-weight:200%; font-size: 130%;'>Username and Password are Incorrect. Please Try Again.</p>";
    $display_block .="<p stye='text-align:center;font-size:2em;'><a href='LoginMenu.html'> Re-attempt Login</a></p>";
}

mysqli_close($mysqli);
?>


<?php echo $display_block; ?>
</body>
</html>