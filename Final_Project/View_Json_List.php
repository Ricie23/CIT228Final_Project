<?php
$employeename = file_get_contents("employeename.json");

$display="<div id='employeename'><h1>Employee Information</h1>";
$employeeObj = json_decode($employeename);
foreach ($employeeObj->employeename as $employeename){
  $fname = $employeename->firstName;
  $lname = $employeename->lastName;
  $dateHire = $employeename->date_hired;
  $display.= "<h2>" . $lname . "</h2>" . "<p> " . $fname . "<br>date hired: " . $dateHire . "</p>";
 }
 $display .= "</div>";
 ?>
 <!DOCTYPE html>
<html>
<head>
<title>Read Json File</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo $display; ?>
<p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>