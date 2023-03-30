<?php

	$servername = "localhost";
	$username = "root";
	$password = "";

	$database = "nutrofit";

	// Create a connection
	$conn = mysqli_connect($servername,
		$username, $password, $database);

	if(! $conn) {
		die("Error". mysqli_connect_error());
	}
    echo "successful";
return $conn;
?>
