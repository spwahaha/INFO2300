
	<table>
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
			</tr>

<?php 
	// include("config.php");
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
 ?>
 		</tbody>
 	</table>