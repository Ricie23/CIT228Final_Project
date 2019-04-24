<!DOCTYPE html>
<html>
<head>
<title>XML Employee List</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php
$xmlList = simplexml_load_file("employees.xml") or die("Error: Cannot find file");
foreach($xmlList->address as $emplist){
    $id=$emplist->id;
    $first=$emplist->first;
    $last=$emplist->last;
    $added=$emplist->addDt;
    echo "<div style='width:40%'>
    <p style='font-size:120%;'>ID: " .$id ."<br/>".
    "<p><strong>Name: " . $first . " " . $last . "</strong>" .
	"Date Added: " . $added . "</p></div><br/><br/>";
}
?>
<p><a href='MainMenu.html'>Main Menu</a></p>
</body>
</html>