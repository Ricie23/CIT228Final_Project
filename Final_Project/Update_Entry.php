<?php
session_start();
include 'connect.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<h1>Select an Entry to Update</h1>";

	//get parts of records
	$get_list_sql = "SELECT id,
	                 CONCAT_WS(', ', lastName, firstName) AS employee_name
	                 FROM employeename ORDER BY lastName, firstName";
	$get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_list_res) < 1) {
		//no records
		$display_block .= "<p><em>Sorry, no records to select.</em></p>";

	} else {
		//has records, so get results and print in a form
		$display_block .= "
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		<p><label for=\"change_id\">Select an employee to Update:</label><br/>
		<select id=\"change_id\" name=\"change_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['id'];
			$display_name = stripslashes($recs['employee_name']);
			$display_block .= "<option value=\"".$id."\">".$display_name."</option>";
		}

		$display_block .= "
		</select></p>
		<button type=\"submit\" name=\"submit\" value=\"change\">Change Selected Employee</button>
		</form>";
	}
	//free result
	mysqli_free_result($get_list_res);

} else if ($_POST) {
	//check for required fields
	if ($_POST['change_id'] == "")  {
		header("Location: Update_Entry.php");
		exit;
	}

	//create safe version of ID
	$safe_id = mysqli_real_escape_string($mysqli, $_POST['change_id']);
	$_SESSION["id"]=$safe_id;
	$_SESSION["computer"]="true";
	$_SESSION["telephone"]="true";
	$_SESSION["email"]="true";
	//get master_info
	$get_master_sql = "SELECT firstName, lastName FROM employeename WHERE id = '".$safe_id."'";
	$get_master_res = mysqli_query($mysqli, $get_master_sql) or die(mysqli_error($mysqli));

	while ($name_info = mysqli_fetch_array($get_master_res)) {
		$display_firstName = stripslashes($name_info['firstName']);
		$display_lastName = stripslashes($name_info['lastName']);		
	}

	$display_block = "<h1>Record Update</h1>";
	$display_block.="<form method='post' action='Entry_Updated.php'>";
	$display_block.="<fieldset><legend>First/Last Names:</legend><br/>";
	$display_block.="<input type='text' name='firstName' size='20' maxlenn employee' required='required' value='" . $display_firstName . "'/>";
	$display_block.="<input type='text' name='lastName' size='30' maxlength='75' required='required' value='" . $display_lastName . "'/></fieldset>";
	//free result
	mysqli_free_result($get_master_res);
	//get all addresses
	$get_computer_sql = "SELECT serialNum, modelNum, dept, description
	                      FROM computer WHERE top_id = '".$safe_id."'";
	$get_computer_res = mysqli_query($mysqli, $get_computer_sql) or die(mysqli_error($mysqli));

 	if (mysqli_num_rows($get_computer_res) > 0) {

		$display_block .= "<p><strong>Computer:</strong></p>";

		while ($add_info = mysqli_fetch_array($get_computer_res)) {
			$serialNum = stripslashes($add_info['serialNum']);
			$modelNum = stripslashes($add_info['modelNum']);
			$dept = stripslashes($add_info['dept']);
			$descript = stripslashes($add_info['description']);
			

			$display_block .="<p><l_Entrys'>Computer:</label><br/>";
			$display_block .="<input type='text' id='serialNum' name='serialNum' size='30' value='".$serialNum."'/></p>";
			$display_block .="<fieldset><legend>Model Number, Department, Description:</legend><br/>";
			$display_block .="<input type='text' name='modelNum' size='30' maxlength='50' value='" . $modelNum . "'/>";
			$display_block .="<input type='text' name='dept' size='5' maxlength='5' value='".$dept."'/>";
			$display_block .="<input type='text' name='description' size='20' maxlength='25' value='".$descript."'/></fieldset>";
		}
	$display_block .="</fieldset>";
	}
	else{
	$_SESSION["computer"]='false';
	$display_block .= <<<END_OF_BLOCK
	<p><label for="computer">Computer:</label><br/>
	<input type="text" id="serialNum" name="serialNum" size="30" /></p>

	<fieldset>
	<legend>Model Number, Department, Description:</legend><br/>
	<input type="text" name="modelNum" size="30" maxlength="50" />
	<input type="text" name="dept" size="5" maxlength="5" />
	<input type="text" name="Description" size="20" maxlength="25" />
	</fieldset>
END_OF_BLOCK;
    
    }

	//free result
	mysqli_free_result($get_computer_res);

	$get_tel_sql = "SELECT tel_number FROM telephone
	                WHERE top_id = '".$safe_id."'";
	$get_tel_res = mysqli_query($mysqli, $get_tel_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_tel_res) > 0) {
$display_block .= "<p><strong>Telephone:</strong></p>";

		while($tel_info = mysqli_fetch_array($get_tel_res)) {
			$tel_number = stripslashes($tel_info['tel_number']);
			
			$display_block .="<fieldset><legend>Telephone Number:</legend><br/>";
			$display_block .="<input type='text' name='tel_number' size='30' maxlength='25' value='".$tel_number."'/>";
			
		}
	$display_block .="</fieldset>";
	}
	else{
	$_SESSION["telephone"]='false';	
	$display_block .= <<<END_OF_BLOCK
	<fieldset>
	<legend> Telephone Number:</legend><br/>
	<input type="text" name="tel_number" size="30" maxlength="25" />
	</fieldset>
END_OF_BLOCK;
    
    }
	

	 $get_email_sql = "SELECT email, type FROM email
	                  WHERE top_id = '".$safe_id."'";
	$get_email_res = mysqli_query($mysqli, $get_email_sql) or die (mysqli_error($mysqli));
	 if (mysqli_num_rows($get_email_res) > 0){
         $display_block .= "<p><strong>Email:</strong></p>";

		while ($email_info = mysqli_fetch_array($get_email_res)) {
            $email = stripslashes ($email_info['email']);
            $email_type = $email_info['type'];
			$display_block .= "<fieldset><legend>Email Address:</legend><br/>";
			$display_block .= "<input type='email' name='email' size='30' maxlength='150' value='".$email."' />";
			if ($email_type=="home"){
				$display_block .= "<input type='radio' id='email_type_h' name='email_type' value='home' checked='checked' /><label for='email_type_h'>home</label>";
	    		$display_block .= "<input type='radio' id='email_type_w' name='email_type' value='work' /><label for='email_type_w'>work</label>";
	    		$display_block .= "<input type='radio' id='email_type_o' name='email_type' value='other' /><label for='email_type_o'>other</label>";
		    } else if ($email_type=="work"){
				$display_block .= "<input type='radio' id='email_type_h' name='email_type' value='home'  /><label for='email_type_h'>home</label>";
	    		$display_block .= "<input type='radio' id='email_type_w' name='email_type' value='work' checked='checked'/><label for='email_type_w'>work</label>";
	    		$display_block .= "<input type='radio' id='email_type_o' name='email_type' value='other' /><label for='email_type_o'>other</label>";
		    } else{
				$display_block .= "<input type='radio' id='email_type_h' name='email_type' value='home'  /><label for='email_type_h'>home</label>";
	    		$display_block .= "<input type='radio' id='email_type_w' name='email_type' value='work' /><label for='email_type_w'>work</label>";
	    		$display_block .= "<input type='radio' id='email_type_o' name='email_type' value='other' checked='checked'/><label for='email_type_o'>other</label>";
		    }
		}

		$display_block .= "</fieldset>";
	}
	else{
	$_SESSION["email"]='false';
	$display_block .= '<fieldset><legend>Email Address:</legend><br/><input type="email" name="email" size="30" maxlength="150" />	<input type="radio" id="email_type_h" name="email_type" value="home" checked />';
	$display_block.= '<label for="email_type_h">home</label><input type="radio" id="email_type_w" name="email_type" value="work" /><label for="email_type_w">work</label>';
	$display_block.='<input type="radio" id="email_type_o" name="email_type" value="other" /><label for="email_type_o">other</label></fieldset>';
    }
    

	$display_block .= "<p style=\"text-align: center\"><button type='submit' name='submitChange' id='submitChange' value='submitChange'>Change Entry</button>";
	$display_block .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href='MainMenu.html' style='color:slate grey';>Cancel and return to main menu</a></p></form>";
}

    mysqli_close($mysqli);

?>
<!DOCTYPE html>
<html>
<head>
<title>Update Employee</title>
<link href="css/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php echo $display_block; ?>
<p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>