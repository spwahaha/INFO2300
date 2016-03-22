<?php 
	function getImageByAlbumId($Aid){
		print("<ul>");

		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("SELECT * FROM Picture_album p, Images i WHERE p.Aid = '$Aid' and i.Iid= p.Iid");
		while ($row = $result->fetch_assoc()) {
			$image = $row["Title"];
			$count = 2;
			$image = str_replace("#",",",$image);
			// len = strlen($image);
			
			$imgPath = $row["File_path"];
			// print($imgPath);
			print("<li>");
			print("<img src= '$imgPath' alt='' height='140px'>");
			// print(str_replace("#",",",$row["Title"]));
			print("</li>");
		}
		print("</ul>");
	}

	function validInput($title){
		$title = trim($title);
		if(strlen($title) == 0){
			return false;
		}

		return true;
	}

	function insertAlbum($title){
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("INSERT INTO Albums (Title, Date_created, Date_modified) VALUES ('$title', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
		// print("INSERT INTO Albums (Title, Date_created, Date_modified) VALUES ('$title', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
	}

	function insertPhoto($originalName, $path,$credit, $seletedAlbum){
		$field_name_array = array("Title", "File_path", "credit");
		$field_list = implode( ',', $field_name_array  );
		$value_Array = array("'$originalName'", "'$path'", "'$credit'");
		$value_list = implode(',', $value_Array);
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("INSERT INTO Images ($field_list) VALUES ($value_list)");
		// print("insert query   INSERT INTO Images ($field_list) VALUES ($value_list)");
		// print(" inserted id : $mysqli->insert_id");
		$Iid = $mysqli->insert_id;
		if($seletedAlbum != null){
			foreach ($seletedAlbum as $Aid) {
				$mysqli->query("INSERT INTO Picture_album (Aid,Iid) VALUES ($Aid, $Iid)");
				// print("insert query   INSERT INTO Picture_album (Aid,Iid) VALUES ($Aid, $Iid)");
			}
		}

	}



 ?>