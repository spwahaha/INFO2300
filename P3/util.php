<?php 
	function getImageByAlbumId($Aid, $mode){
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
			if ($mode == 1) {
				print("<div class='edit'>
				<a href='album.php?Aid=$Aid&Iid=$Iid'>Delete</a>
				<a href='image.php?Aid=$Aid&Iid=$Iid'>Edit</a>
				</div>");
			}
			
			// print("<a href='image.php'>Delete</a>");
			// print("<a href='image.php'>Edit</a>");
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
			print("<p>Title: $image</p>");
			print("<p>Date Token: $date_token</p>");
			print("<p>Credit: $credit</p>");
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

	function updateAlbumName($Aid, $newName){
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "UPDATE Albums SET Title='$newName' WHERE Aid=$Aid";
		// echo "$query";
		$result = $mysqli->query($query);
		if( !$result ) {
				echo 'Query error';
				die();
			}
	}

	function getAlbumName($Aid){
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "SELECT Title From Albums WHERE Aid=$Aid";
		$result = $mysqli->query($query);
		$name = $result->fetch_assoc()['Title'];
		// $name = $result[0]['Title'];
		// echo "album name: $name";
		return $name;
	}

    function  deleteImageFromAlbum($Aid, $Iid){
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "DELETE From Picture_album WHERE Aid=$Aid and Iid=$Iid";
		// echo "$query";
		$result = $mysqli->query($query);
		if( !$result ) {
				echo 'Query error';
				die();
			}
		// $name = $result[0]['Title'];
		// echo "album name: $name";
    }

    function updateImageName($Iid, $newName){
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "UPDATE Images SET Title ='$newName' WHERE Iid=$Iid";
		// echo "$query";
		$result = $mysqli->query($query);
		if( !$result ) {
				echo 'Query error';
				die();
			}
    }


    function loadAlbum($mode){
    	print("	<table>
		<tbody>
			<tr>
				<td>
					Album Id 
				</td>
				<td>
					Title
				</td>
				<td>
					date_created 
				</td>
				<td>
					date_modified
				</td>
			</tr>");
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("SELECT * FROM Albums");
		while ($row = $result->fetch_assoc()) {
			$cnt = 0;
			$Aid = 0;
			print("<tr>");
			foreach ($row as $value) {
				$cnt++;
				if($cnt == 1){
					$Aid = $value;
				}
				if($cnt==2){
					print("<td> <a href='album.php?Aid=$Aid'>$value</a> </td>");
				}else{
					print("<td> $value </td>");
				}
				
			}
			print("</tr>");
		}
		print(" 		</tbody>
	 	</table>");
    }

    function deleteAlbum($Aid){
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "DELETE FROM `Albums` WHERE Aid=$Aid";
		// echo "$query";
		$result = $mysqli->query($query);
		if( !$result ) {
				echo 'Query error';
				die();
			}
    	
    }

    function loadImage(){
    	print("<ul>");
		// $imgFolder = "imgs/";

		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("SELECT * FROM Images");
		while ($row = $result->fetch_assoc()) {
			$count = 2;
			// $image = str_replace("#",",",$image);
			// len = strlen($image);

			$imgPath = $row["File_path"];
			$Iid = $row["Iid"];
			// print($imgPath);
			print("<li>");
	        print("<a href='image.php?Iid=$Iid'>");
			print("<img src= '$imgPath' alt='' >");
			print("</a>");
			print("</li>");
		}
		print("</ul>");
    }

    function showCheckBox(){
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("SELECT * FROM Albums");
		while ($row = $result->fetch_assoc()) {
			$Aid = $row['Aid'];
			$title = $row['Title'];
			print("<div class='checkBox'>");
			print("<input   type='checkbox' name='album[]' value='$Aid'> $title<br>");	
			print("</div>");
		}
    }

    function movePhoto($Iid,$seletedAlbum){
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    	foreach ($seletedAlbum as $Aid) {
    		$query = "SELECT * FROM Picture_album WHERE Aid=$Aid and Iid=$Iid";
    		$result = $mysqli->query($query);
    		$rows = $result->num_rows;
    		// print("num_rows : + $rows");
    		if($result->num_rows > 0){
    			continue;
    		}else{
    // 			$query = "INSERT INTO Picture_album (Aid,Iid) VALUES ($Aid, $Iid)";
	   //  		$result = $mysqli->query($query);
	   //  		if( !$result ) {
				// 	echo 'Query error';
				// 	die();
				// }
    		}
    		
    	}
    }

    function showImageAlbums($Iid){
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    	$query = "SELECT Albums.Title, Albums.Aid from Picture_album, Albums WHERE Picture_album.Iid=$Iid and Albums.Aid=Picture_album.Aid";
    	// print("$query");
    	$result = $mysqli->query($query);
		if( !$result ) {
				echo 'Query error';
				die();
			}
			print("The image belongs to ");
    	while ($row = $result->fetch_assoc()) {
    		$title = $row['Title'];
    		$Aid = $row['Aid'];
    		print("<a href='album.php?Aid=$Aid'>$title</a>  ");
		}
    }

    function deleteImage($Iid){
    	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "DELETE FROM `Images` WHERE Iid=$Iid";
		// echo "$query";
		$result = $mysqli->query($query);
		if( !$result ) {
				echo 'Query error';
				// echo "$query";
				die();
			}
    }

    function showImage($Iid, $userMode){
		getImageByImageId($Iid);
		showImageAlbums($Iid);
		if ($userMode == 1) {
			print("<form method='post'>
	              <input type='submit' name ='delete' value='delete'>
	          </form>");
		}
		
	}

	function imageExists($Iid){
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "SELECT * FROM `Images` WHERE Iid=$Iid";
		$result = $mysqli->query($query);
		$rowNum = $result->num_rows;
		return $rowNum;
	}

 ?>