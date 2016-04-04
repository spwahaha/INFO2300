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
			$Iid = $row["Iid"];
	        print("<a href='image.php?Iid=$Iid'>");
			print("<img src= '$imgPath' alt='' height='140px'>");
			// print(str_replace("#",",",$row["Title"]));
			print("</a>");
			print("</li>");
		}
		print("</ul>");
	}

	function getImageByImageId($Iid){
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("SELECT * FROM Images i WHERE  i.Iid=$Iid");
		while ($row = $result->fetch_assoc()) {
			$image = $row["Title"];
			$count = 2;
			$image = str_replace("#",",",$image);
			$date_token = $row["Date_created"];
			$credit = $row["Credit"];
			// len = strlen($image);
			$imgPath = $row["File_path"];
			// print($imgPath);
			print("<img src= '$imgPath' alt=''>");
			print("<h2>Title: $image</h2>");
			print("<h2>Date Token: $date_token</h2>");
			print("<h2>Credit: $credit</h2>");
			// print(str_replace("#",",",$row["Title"]));
		}
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