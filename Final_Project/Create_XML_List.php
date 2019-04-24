<!DOCTYPE html>
<html>
<head>
<title>Create XML Contact</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php

    //$mysqli = mysqli_connect("localhost","root","", "lisabalbach_Rober260");
    $mysqli = mysqli_connect("localhost", "lisabalbach_rober260", "CIT190118", "lisabalbach_Robertson");

    if(mysqli_connect_error()){
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
 }
$get_employeeName="SELECT * FROM employeename";
$get_employeeName_res = mysqli_query($mysqli, $get_employeeName) or die(mysqli_error($mysqli));

$xml = "<employeeList>";
while($r = mysqli_fetch_array($get_employeeName_res)){
$xml .= "<address>";
$xml .= "<id>".$r['id']."</id>";
$xml .= "<first>".$r['firstName']."</first>";
$xml .="<last>" .$r['lastName']."</last>";
$xml .= "<addDt>".$r['date_hired']."</addDt>";
$xml .="</address>";
}
$xml .="</employeeList>";
$sxe = new SimpleXMLElement($xml);
$sxe->asXML("employees.xml");
echo "<h2>Employess.xml has been created</h2>";
echo "<p><a href = 'View_XML_List.php'>View Employee List</a>";
?>
<p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>