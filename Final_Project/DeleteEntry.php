<?php 
include 'connect.php';
doDB();

if(!$_POST){
    $display_block = "<h1>Select an Entry</h1>";

    $get_list_sql = "SELECT id,
                    CONCAT_WS(', ', lastName, firstName) as full_name
                    FROM employeename ORDER BY lastName, firstName";
    $get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

    if(mysqli_num_rows($get_list_res) <1) {
        $display_block .= "<p><em> Sorry, no record available</em></p>";
    }else {
        $display_block .="
        <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
        <p><label for=\"sel_id\">Select an Employee:</label><br/>
        <select id=\"sel_id\" name=\"sel_id\" required=\"required\">
        <option value\"\">-- Select One --</option>";

        while($recs = mysqli_fetch_array($get_list_res)){
            $id = $recs['id'];
            $full_name=stripslashes($recs['full_name']);
            $display_block .= "<option value=\"".$id."\">".$full_name."</option>";
        }
        $display_block .="
        </select></p>
        <button type=\"submit\" name=\"submit\" value=\"del\">Deleted Selected Employee</button>
        </form>";
    }
 mysqli_free_result($get_list_res);
}else if($_POST){
    if($_POST['sel_id']==""){
        header("Location: DeleteEntry.php");
        exit;
    }
    
$safe_id=mysqli_real_escape_string($mysqli, $_POST['sel_id']);

$del_master_sql ="DELETE FROM employeename WHERE id = '".$safe_id."'";
$del_master_res= mysqli_query($mysqli, $del_master_sql) or die(mysqli_error($mysqli));

$del_computer_sql="DELETE FROM computer WHERE top_id='".$safe_id."'";
$del_computer_res= mysqli_query($mysqli, $del_computer_sql) or die(mysqli_error($mysqli));

$del_tel_sql = "DELETE FROM telephone WHERE top_id = '".$safe_id."'";
$del_te_res = mysqli_query($mysqli, $del_tel_sql) or die(mysqli_error($mysqli));

$del_email_sql = "DELETE FROM email WHERE top_id = '".$safe_id."'";
$del_email_res = mysqli_query($mysqli, $del_email_sql) or die(mysqli_error($mysqli));

mysqli_close($mysqli);

$display_block = "<h1>Employee Deleted</h1> <p>Would you like to delete another?
<a href=\"".$_SERVER['PHP_SELF']."\">delete another</a></p>";
}
?> 
<!DOCTYPE html>
<html>
<head>
<title>Delete a Record</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo $display_block; ?>
<p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>