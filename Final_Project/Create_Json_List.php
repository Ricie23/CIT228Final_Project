<?php
//$mysqli = mysqli_connect("localhost", "root", "", "lisabalbach_rober260");
$mysqli = mysqli_connect("localhost", "lisabalbach_rober260", "CIT190118", "lisabalbach_Robertson");
$query="SELECT * FROM employeename";
$result=$mysqli->query($query)
or die($mysqli->error);

$response = array();

$posts = array();

while($row=$result->fetch_assoc())
{
    $firstName=$row['firstName'];
    $lastName=$row['lastName'];
    $dateHired=$row['date_hired'];
    $id=$row['id'];

    $posts[] = array('firstName'=> $firstName, 'lastName'=>$lastName, 'date_hired'=>$dateHired,'id'=>$id);
}

$response['employeename']=$posts;

$fp = fopen('employeename.json', 'w');
fwrite($fp, json_encode($response));
fclose($fp);

$display_block="<p>The Employee information has been written to json</p>";
$display_block.="<p><a href='View_Json_List.php'>Employee Information</a></p>";
?>
<!DOCTYPE html>
<html>
<head>
<title>Create Json File</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo $display_block; ?>
<p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>