<?php 
include 'connect.php';

if (!$_POST){
    $display_block= <<<END_OF_BLOCK
    <form method="post" action="$_SERVER[PHP_SELF]">
    <fieldset>
    <legend>First and Last Names:</legend><br/>
    <input type="text" name="firstName" size="20"; maxlength="75" required="required" />
    <input type="text" name="lastName" size="30" maxlength="75" required="required"/>
    </fieldset>

    <p><label for="Computer"> Computer Serial Number:</label><br/>
    <input tytpe="text" id="serialNum" name="serialNum" size="30" /></p>

    <fieldset> 
    <legend> Model Number, Department, and Description: </legend><br/>
    <input type="text" name="modelNum" size="10" maxlength="10" />
    <input type="text" name="dept" size="5" maxlength="5"/>
    <input type="text" name="description" size="20" maxlength="20"/>
    </fieldset>

    <fieldset>
    <legend>Telephone Number:</legned><br/>
    <input type="text" name="tel_number" size="30" maxlength="25"/>
    </fieldset>

    <fieldset>
    <legend> Email Address:</legend><br/>
    <input type="email" name="email" size="30" maxlength="150"/>
    <input type="radio" id="email_type_h" name="email_type" value="home" checked />
    <label for ="email_type_h">home</label>
    <input type="radio" id="email_type_w" name="email_type" value="work" checked />
    <label for ="email_type_w">work</label>
    <input type="radio" id="email_type_o" name="email_type" value="other" checked />
    <label for ="email_type_o">other</label>
    </fieldset>

    <button type="submit" name="submit" value="send">Add Entry</button>
    </form>
END_OF_BLOCK;
}else if ($_POST){
    if (($_POST['firstName']=="") || ($_POST['lastName']=="")){
        header("Location: AddEntry.php");
        exit;
    }
doDB();
$safe_firstName = mysqli_real_escape_string($mysqli, $_POST['firstName']);
$safe_lastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);
$safe_serialNum = mysqli_real_escape_string($mysqli, $_POST['serialNum']);
$safe_modelNum = mysqli_real_escape_string($mysqli, $_POST['modelNum']);
$safe_dept = mysqli_real_escape_string($mysqli, $_POST['dept']);
$safe_descript = mysqli_real_escape_string($mysqli, $_POST['description']);
$safe_tel_number = mysqli_real_escape_string($mysqli, $_POST['tel_number']);
$safe_email = mysqli_real_escape_string($mysqli, $_POST['email']);

$add_master_sql = "INSERT INTO employeename (date_hired, firstName, lastName)
                   VALUES (now(), '".$safe_firstName."','".$safe_lastName."')";
$add_master_res= mysqli_query($mysqli, $add_master_sql) or die(mysqli_error($mysqli));

$top_id = mysqli_insert_id($mysqli);

if(($_POST['serialNum']) || ($_POST['modelNum']) || ($_POST['dept']) ||($_POST['description'])) {
    $add_computer_sql = "INSERT INTO computer (top_id, date_added, date_modified, 
                        serialNum, modelNum, dept, description) VALUES ('".$top_id."', now(), now(),
                        '".$safe_serialNum."', '".$safe_modelNum."', '".$safe_dept."', '".$safe_descript."')";
$add_computer_res = mysqli_query($mysqli, $add_computer_sql) or die(mysqli_error($mysqli));
}

if($_POST['tel_number']){
    $add_tel_sql= "INSERT INTO telephone (top_id, date_added, date_modified, tel_number)
                  VALUES('".$top_id."', now(), now(), '".$safe_tel_number."')";
$add_tel_res= mysqli_query($mysqli, $add_tel_sql) or die(mysqli_error($mysqli));
}

if($_POST['email']){
    $add_email_sql = "INSERT INTO email (top_id, date_added, date_modified, email, type)
                    VALUES('".$top_id."', now(),now(), '".$safe_email."', '".$_POST['email_type']."')";
$add_address_res= mysqli_query($mysqli, $add_email_sql) or die(mysqli_error($mysqli));
}

mysqli_close($mysqli);
$display_block = "<p> Your entry has been added. would you like to add another? <a href=\"AddEntry.php\">add another</a></p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add an Entry</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<h1>Add an Entry</h1>
<?php echo $display_block; ?>
<p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>