<?php
include 'connect.php';
doDB();

if(!$_POST){
    $display_block = "<h1>Select an Employee</h1>";

$get_list_sql  ="SELECT id,
                CONCAT_WS(',',lastName,firstName) AS employeename
                FROM employeename ORDER BY lastName, firstName";
$get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_list_res) < 1) {

    $display_block .="<p><em>Sorry, no record to select.</em></p>";

} else{
    $display_block .="
    <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
    <p><label for=\"sel_id\">Select a Record:</label></br/>
    <p><select id=\"sel_id\" name=\"sel_id\" required=\"required\">
    <option value=\"\"> --Select One --</option>";
    
while($recs = mysqli_fetch_array($get_list_res)){
    $id=$recs['id'];
    $employeename= stripslashes($recs['employeename']);
    $display_block .= "<option value=\"".$id."\">".$employeename."</option>";
}

$display_block .="
</select></p>
<button type=\"submit\" name=\"submit\" value=\"view\">View Selected Entry</button>
</form>";
}
mysqli_free_result($get_list_res);

}else if ($_POST){
    if($_POST['sel_id']==""){
        header("Location: Select_Entry.php");
        exit;
    }

$safe_id= mysqli_real_escape_string($mysqli,$_POST['sel_id']);

$get_master_sql = "SELECT CONCAT_WS(' ',firstName, lastName) as employeename
                    FROM employeename WHERE id= '".$safe_id."'";
$get_master_res = mysqli_query($mysqli, $get_master_sql) or die(mysqli_error($mysqli));

while($name_info=mysqli_fetch_array($get_master_res)){
    $employeename = stripslashes($name_info['employeename']);
}

$display_block = "<h1> Showing Record For ".$employeename."</h1>";

mysqli_free_result($get_master_res);

$get_computer_sql= "SELECT serialNum, modelNum, dept, description 
                    FROM computer WHERE top_id='".$safe_id."'";
$get_computer_res = mysqli_query($mysqli, $get_computer_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_computer_res) >0){
    $display_block .="<p><strong>Computer: </strong><br/>";

    while ($add_info = mysqli_fetch_array($get_computer_res)){
        $serialNum=stripslashes($add_info['serialNum']);
        $modelNum = stripslashes($add_info['modelNum']);
        $dept = stripslashes($add_info['dept']);
        $descript=stripslashes($add_info['description']);

        $display_block .="<p><strong>Serial Number: </strong>$serialNum <br/>
        <strong>Model Number: </strong>$modelNum <br/>
        <strong>Department: </strong>$dept <br/>
        <strong>Description:  </strong>$descript</p>";
    }
    $display_block .="</p><br/>";
}
mysqli_free_result($get_computer_res);


$get_tel_sql = "SELECT tel_number FROM telephone
	                WHERE top_id = '".$safe_id."'";
	$get_tel_res = mysqli_query($mysqli, $get_tel_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_tel_res) > 0) {

		$display_block .= "<p><strong>Telephone:</strong><br/>";

		while ($tel_info = mysqli_fetch_array($get_tel_res)) {
			$tel_number = stripslashes($tel_info['tel_number']);
            $display_block .= "<p>$tel_number</p>";
		}
		$display_block .= "</p><br/>";
	}

	mysqli_free_result($get_tel_res);

	
	$get_email_sql = "SELECT email, type FROM email
	                  WHERE top_id = '".$safe_id."'";
	$get_email_res = mysqli_query($mysqli, $get_email_sql) or die(mysqli_error($mysqli));

	 if (mysqli_num_rows($get_email_res) > 0) {

		$display_block .= "<p><strong>Email:</strong><br/>";

		while ($email_info = mysqli_fetch_array($get_email_res)) {
			$email = stripslashes($email_info['email']);
			$email_type = $email_info['type'];

			$display_block .= "<p>$email ($email_type)</p>";
		}

		$display_block .= "</p>";
	}

	mysqli_free_result($get_email_res);

    $display_block .="<br/>
        <p style=\"text-align: center\"><a href=\"Update_Entry.php?top_id=".$_POST['sel_id']."\">add info</a> <a href=\"".$_SERVER['PHP_SELF']."\">Select another</a></p>";
 }

 mysqli_close($mysqli);
 ?>
 <!DOCTYPE html>
 <html>
    <head>
        <title>My Employees</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <?php echo $display_block;?>
    <p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>