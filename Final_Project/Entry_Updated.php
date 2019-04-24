<?php
session_start();
include 'connect.php';

if(($_POST['firstName']=="") || ($_POST['lastName']=="")){
    header("Location: Entry_Updated.php");
    exit;
}
doDB();

$top_id=$_SESSION["id"];
$safe_firstName = mysqli_real_escape_string($mysqli, $_POST['firstName']);
$safe_lastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);
$safe_serialNum = mysqli_real_escape_string($mysqli, $_POST['serialNum']);
$safe_modelNum = mysqli_real_escape_string($mysqli, $_POST['modelNum']);
$safe_dept = mysqli_real_escape_string($mysqli, $_POST['dept']);
$safe_descript = mysqli_real_escape_string($mysqli, $_POST['description']);
$safe_tel_number = mysqli_real_escape_string($mysqli, $_POST['tel_number']);
$safe_email = mysqli_real_escape_string($mysqli, $_POST['email']);

$add_master_sql = "UPDATE employeename SET date_hired=now(), firstName='".$safe_firstName."',lastName='".$safe_lastName."' WHERE id=".$top_id;
$add_master_res= mysqli_query($mysqli, $add_master_sql) or die(mysqli_error($mysqli));

if($_SESSION["computer"]=="true"){
    $add_computer_sql = "UPDATE computer SET top_id=".$top_id.",date_added=now(), date_modified=now(), serialNum = '".$safe_serialNum."',modelNum='".$safe_modelNum."', dept='".$safe_dept."', description='".$safe_descript."' WHERE top_id=".$top_id;
$add_computer_res= mysqli_query($mysqli, $add_computer_sql) or die(mysqli_error($mysqli));
}
else if (($_POST['serialNum']) || ($_POST['modelNum']) || ($_POST['dept']) || ($_POST['description'])){
$add_computer_sql="INSERT INTO computer(top_id, date_added, date_modified, serialNum, modelNum, dept, description) VALUES('".
$top_id."',now(),now(),'".$safe_serialNum."','".$safe_modelNum."','".$safe_dept."','".$safe_descript."')";
$add_computer_res=mysqli_query($mysqli,$add_computer_sql)or die(mysqli_error($mysqli));
}

if ($_SESSION["telephone"]=="true"){
    $add_tel_sql="UPDATE telephone SET top_id='".$top_id."', date_added=now(), date_modified=now(), tel_number='".$safe_tel_number."' WHERE top_id=".$top_id;
$add_tel_res = mysqli_query($mysqli, $add_tel_sql) or die(mysqli_error($mysqli));
}
else if($_POST['tel_number']){
    $add_tel_sql="INSERT INTO telephone(top_id, date_added, date_modified, tel_number) 
    VALUES ('".$top_id."', now(), now(), '".$safe_tel_number."')";
$add_tel_res=mysqli_query($mysqli, $add_tel_sql) or die(mysqli_error($mysqli));
}

if($_SESSION["email"]=="true"){
    $add_email_sql = "UPDATE email SET top_id=".$top_id.",date_added=now(), date_modified=now()".
                    ",email='".$safe_email."',type='".$_POST['email_type']."'".
                    "WHERE top_id=".$top_id;
$add_email_res = mysqli_query($mysqli, $add_email_sql) or die(mysqli_error($mysqli));
}else if ($_POST['email']){
    $add_email_sql="INSERT INTO email(top_id, date_added, date_modified,
    email, type) VALUES ('".$top_id."',now(), now(), 
    '".$safe_email."','".$_POST['email_type']."')";
$add_email_res = mysqli_query($mysqli, $add_email_sql) or die(mysqli_error($mysqli)); 
}
mysqli_close($mysqli);
$display_block = "<p>Your record has been updated. would you like to return to the <a href='MainMenu.html'>Main Menu</a> or <a href='Update_Entry.php'>Change Another record</a>.</p>";

?>
<!DOCTYPE html>
<html>
<head>
<title>Update Records</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>