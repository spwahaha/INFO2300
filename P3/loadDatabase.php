
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
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$result = $mysqli->query("SELECT * FROM Albums");
	while ($row = $result->fetch_assoc()) {
		print("<tr>");
		foreach ($row as $value) {
			print("<td> $value </td>");
		}
		print("</tr>");
	}
 ?>
 		</tbody>
 	</table>