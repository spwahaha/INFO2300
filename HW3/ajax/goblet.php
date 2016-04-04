<?php
	//The following code checks for which AJAX request was sent for Goblet-related functions.
	//You need to only complete the case switch statements for submitting a name and choosing a name.
	
	$request_type = filter_input(INPUT_POST, "requestType", FILTER_SANITIZE_STRING);
	if ( empty( $request_type ) ) {
		echo 'Missing requestType.';
		die();
	}

	require_once "../config.php";
	$filename = "../includes/wizards.sql";
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


	// $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	if ($mysqli->connect_errno) {
		// print('Inside errno');
		print($mysqli->connect_error);
		die();
	}

	switch ( $request_type ) {
		
		//The following code has been done as an example for you. This function checks the database for duplicates
		case "checkName":
			//Get the POST data - safely
			$firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
			$lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
			$school = filter_input(INPUT_POST, "school", FILTER_SANITIZE_STRING);

			// Build and execute the query
			$query = "SELECT * FROM wizards WHERE firstName='$firstName' AND lastName='$lastName' AND school='$school'";
			// $query = "SELECT * FROM wizards";
			$result = $mysqli->query($query);

			//Make sure the query worked
			if( !$result ) {
				echo 'Query error';
				die();
			}

			//Return a message indicating whether there are matching wizards
			if ( $result->num_rows == 0) {
				echo 'NoDuplicates';
			} else {
				echo 'Duplicates';
			}
			die();
			break;


		// The rest of this is pretty open-ended based on how you make your AJAX calls,
		// so just use the above as an example of how to do the rest of them.
		// This shouldn't be too different from how you normally handle
		// HTML form submissions to POST to and GET from the database, so don't fret too much!
		case "submitName":
			$firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
			$lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
			$school = filter_input(INPUT_POST, "school", FILTER_SANITIZE_STRING);
			$query = "INSERT INTO wizards (firstName, lastName, school) VALUES ('$firstName', '$lastName', '$school');";
			$result = $mysqli->query($query);
			//TODO: Should attempt to add a new wizard to the database corresponding
			//to what the user entered in the index.php form. Return a success if it works.
			if( !$result ) {
				echo 'Query error';
				die();
			}else{
				echo "success";
			}
			break;
			
		case "chooseName":
		//TODO: Should return a wizard from the wizards table if one exists,
		//otherwise, print out an error message.
			$query = 'SELECT * FROM wizards ORDER BY RAND() LIMIT 1';
			$result = $mysqli->query($query);
			if ( $result->num_rows == 0) {
				echo 'NULL';
			} else {
				$list = $result->fetch_assoc();
				$wID = $list["wID"];
				echo json_encode(array(
				'firstName' => $list["firstName"],
				'lastName' => $list["lastName"],
				'school' => $list["school"],
				));
				$query = "DELETE FROM wizards WHERE WID=$wID;";
				$result = $mysqli->query($query);
			}

	}




?>