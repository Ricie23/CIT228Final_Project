<?php
function doDB() {
	global $mysqli;

	//$mysqli = mysqli_connect("localhost", "root","","lisabalbach_rober260");

	$mysqli = mysqli_connect("localhost", "lisabalbach_rober260", "CIT190118", "lisabalbach_Robertson");

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
}
?>