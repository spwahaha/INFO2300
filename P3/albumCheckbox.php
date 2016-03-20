
<?php 
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$result = $mysqli->query("SELECT * FROM Albums");
	while ($row = $result->fetch_assoc()) {
		$Aid = $row['Aid'];
		$title = $row['Title'];
		print("<div class='checkBox'>");
		print("<input   type='checkbox' name='album[]' value='$Aid'> $title<br>");	
		print("</div>");
		
	}
 ?>