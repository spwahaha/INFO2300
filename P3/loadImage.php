
<?php 
	
	print("<ul>");
	// $imgFolder = "imgs/";

	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$result = $mysqli->query("SELECT * FROM Images");
	while ($row = $result->fetch_assoc()) {
		$count = 2;
		// $image = str_replace("#",",",$image);
		// len = strlen($image);

		$imgPath = $row["File_path"];
		// print($imgPath);
		print("<li>");
		print("<img src= '$imgPath' alt='' >");
		print("</li>");
	}
	print("</ul>");


 ?>