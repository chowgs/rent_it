<?php 

	// Uncomment if using local repo
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "rent_it";

	// Uncomment if using remote repo
	// $servername = "localhost";
	// $username = "u480853257_rentit_new";
	// $password = "12kls.Smalltank";
	// $dbname = "u480853257_rentit_new";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	   die("Connection failed: " . $conn->connect_error);
	} 

	$conn->set_charset("utf8mb4");

?>