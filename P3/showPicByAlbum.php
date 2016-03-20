<?php 
	function getImageByAlbumId($Aid){
		print("<ul>");
		$imgFolder = "imgs/";

		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$result = $mysqli->query("SELECT * FROM Picture_album p, Images i WHERE p.Aid = '$Aid' and i.Iid= p.Iid");
		while ($row = $result->fetch_assoc()) {
			$image = $row["File_path"];
			$count = 2;
			$image = str_replace("#",",",$image);
			// len = strlen($image);
			
			$imgPath = $imgFolder.$image;
			$imgPath = "'".$imgPath."'";
			// print($imgPath);
			print("<li>");
			print("<img src= $imgPath alt='' >");
			print(str_replace("#",",",$row["Title"]));
			print("</li>");
		}
		print("</ul>");
	}


 ?>