<?php
	//Initial Setup
	include("../config.php");
	//TODO: find the adventure.sql file and load it into your database using phpMyAdmin
	$filename = "../includes/adventure.sql";
	//TODO: set your database connection credentials in the config.php file
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	// Temporary variable, used to store current query
	$templine = '';
	// Read in entire file
	$lines = file($filename);
	// Loop through each line
	foreach ($lines as $line)
	{
	// Skip it if it's a comment
		if (substr($line, 0, 2) == '--' || $line == '')
		    continue;

		// Add this line to the current segment
		$templine .= $line;
		// If it has a semicolon at the end, it's the end of the query
		if (substr(trim($line), -1, 1) == ';')
		{
		    // Perform the query
		    $mysqli->query($templine);
		    // Reset temp variable to empty
		    $templine = '';
		}
	}
	 // echo "Tables imported successfully";

	// TODO: Instead of zero, get the labelno that ajax.js sent and sanitize as an int
	$labelno = 0;
	if(isset($_GET["labelno"])){
      $labelno = intval($_GET["labelno"]);

    }

	// negative labelno has no meaning
	if ($labelno < 0) {
		echo 'Invalid labelno.';
		die();
	}

	// TODO: import the given adventure.sql into your database.
	//       this gives you the table called adventure
	// TODO: Include the config file here and connect to mysql

	// connection error for MYSQL
	if ($mysqli->connect_errno) {
		print($mysqli->connect_error);
		die();
	}
	

	// TODO: create and execute a sql query to select the appropriate 
	//       adventure record based on labelno
	$query = "";
	$result = "";
	$query = "SELECT * FROM adventure WHERE label=$labelno;";
	$result = $mysqli->query($query);
	if (!$result) {
		echo 'Query error';
		die();
	}
	
	$list = $result->fetch_assoc();

	header('Content-Type: application/json');
	echo json_encode(array(
		'dataindex' => $labelno,
		'storyline' => $list['story-line'],
		'choice1_plot' => $list['choice1-plot'],
		'choice1' => $list['choice1-button'],
		'choice2_plot' => $list['choice2-plot'],
		'choice2' => $list['choice2-button'],
		'location' => $list['location'],
		'location_label' => $list['location-label'],
		'choice1result' => $list['choice1-result'],
		'choice2result' => $list['choice2-result']
		// TODO: Select the following fields from the database that 
		//       correspond to that labelNo.
		// TODO: package the json to give to the ajax.js
	));



	
?>