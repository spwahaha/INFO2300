
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
		$Iid = $row["Iid"];
		// print($imgPath);
		print("<li>");
        print("<a href='image.php?Iid=$Iid'>");
		print("<img src= '$imgPath' alt='' >");
		print("</a>");
		print("</li>");
	}
	print("</ul>");


 ?>