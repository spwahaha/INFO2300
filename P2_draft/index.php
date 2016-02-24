<!DOCTYPE html>
<html class = "main">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>Billboard Database</title>
    </head>
    <body>
    <nav>
    	<img id = "navImg" src="https://i.ytimg.com/vi/yWlujnDDUt0/maxresdefault.jpg" alt="">
    	<p id="title">BILLBOARD DATABASE</p>
    	
    </nav>
    	<div class="container">
    		<div class="left-half-container">
    			<h1 style="text-align:center;">Add</h1>    		
    			<form method="post">
    				<div class="label">
    					<label>Title</label>
    					<input type="text" name="add_title"><br>
    				</div>
					<div class="label">
						<label>Artist</label>
		    			<input type="text" name="add_artist" ><br>		
					</div>
    				<div class="label">
	    				<label>Album</label>
	    				<input type="text" name="add_album" ><br>	
    				</div>
    				<div class="label">
	    				<label>Type</label>
		    			<select name="add_type" >
		    				<option value="">Please select</option>
		    				<option value="Alternative Music">Alternative Music</option>
		    				<option value="Blues">Blues</option>
		    				<option value="Classical Music">Classical Music</option>
		    				<option value="Country Music">Country Music</option>
		    				<option value="Dance Music">Dance Music</option>
		    				<option value="Easy Listening">Easy Listening</option>
		    				<option value="Electronic Music">Electronic Music</option>
		    				<option value="European Music">European Music (Folk / Pop)</option>
		    				<option value="Hip Hop / Rap">Hip Hop / Rap</option>
		    				<option value="Indie Pop">Indie Pop</option>
		    				<option value="Inspirational">Inspirational (incl. Gospel)</option>
		    				<option value="Asian Pop">Asian Pop (J-Pop, K-pop)</option>
		    				<option value="Jazz">Jazz</option>
		    				<option value="latin Music">latin Music</option>
		    				<option value="New Age">New Age</option>
		    				<option value="R&B/Soul">R&B/Soul</option>
		    				<option value="Reggae">Reggae</option>
		    				<option value="Rock">Rock</option>
		    				<option value="Singer">Singer/Songwriter (inc. Folk)</option>
		    				<option value="World Music/Beats">World Music/Beats</option>
		    				<option value="Other">Other</option>
		    			</select>			
    				</div>
    				<div class="label">
    					<label>Year</label>
    					<input type="text" name="add_year" pattern = "[0-9]{4}"  title="Four letter year"><br>
    				</div>
    				<div class="label">
							<input class="button" type="submit" name="add" value="Add">						
					</div>
    			</form>
    				
    		</div>

    		<div class="right-half-container">
    			<h1 style="text-align:center;">Search</h1>
    			<form method="post">
    				<div class="label">
    					<label>Title</label>
    					<input type="text" name="search_title"><br>
    				</div>
					<div class="label">
						<label>Artist</label>
		    			<input type="text" name="search_artist"><br>		
					</div>
    				<div class="label">
	    				<label>Album</label>
	    				<input type="text" name="search_album"><br>	
    				</div>
    				<div class="label">
	    				<label>Type</label>
		    			<select name="search_type">
		    				<option value="">Please select</option>
		    				<option value="Alternative Music">Alternative Music</option>
		    				<option value="Blues">Blues</option>
		    				<option value="Classical Music">Classical Music</option>
		    				<option value="Country Music">Country Music</option>
		    				<option value="Dance Music">Dance Music</option>
		    				<option value="Easy Listening">Easy Listening</option>
		    				<option value="Electronic Music">Electronic Music</option>
		    				<option value="European Music">European Music (Folk / Pop)</option>
		    				<option value="Hip Hop / Rap">Hip Hop / Rap</option>
		    				<option value="Indie Pop">Indie Pop</option>
		    				<option value="Inspirational">Inspirational (incl. Gospel)</option>
		    				<option value="Asian Pop">Asian Pop (J-Pop, K-pop)</option>
		    				<option value="Jazz">Jazz</option>
		    				<option value="latin Music">latin Music</option>
		    				<option value="New Age">New Age</option>
		    				<option value="R&B/Soul">R&B/Soul</option>
		    				<option value="Reggae">Reggae</option>
		    				<option value="Rock">Rock</option>
		    				<option value="Singer">Singer/Songwriter (inc. Folk)</option>
		    				<option value="World Music/Beats">World Music/Beats</option>
		    				<option value="Other">Other</option>
		    			</select>			
    				</div>
    				<div class="label">
    					<label>Year</label>
    					<input type="text" name="search_year" pattern = "[0-9]{4}"><br>
    				</div>
    				<div class="label">
						<input class="button" type="submit" name="search" value="Search">						
					</div>
					<div class="label">
    					<input class="button" type="submit" name="show" value="Show All">
    				</div>
    			</form>
    		</div>
    	</div>
    	<div class="container">
    		<div class="result">
    			<?php 
    				$type_set = array("Alternative Music", "Blues", "Classical Music", "Country Music",
    					"Dance Music", "Easy Listening", "Electronic Music", "European Music",
    					"Hip Hop / Rap", "Indie Pop", "Inspirational", "Asian Pop", "Jazz", "latin Music",
    					"New Age", "R&B/Soul", "Reggae", "Rock", "Singer", "World Music/Beats", "Other");

    				function checkAdd(){
    					global $type_set;
    					$error = "";
    					$title = trim($_POST['add_title']);
    					$artist = trim($_POST['add_artist']);
    					$album = trim($_POST['add_album']);
    					$type = trim($_POST['add_type']);
    					$year = trim($_POST['add_year']);


    					if ($title == '') {
    						$error .= "Please enter the title<br>";
    					}elseif (strlen($title) > 200) {
    						$error .= "Title length should be less than 200 characters<br>";
    					}elseif (strpos($title, "|||")) {
    						$error .= "Title should not contain |||<br>";
    					}

    					if ($artist == '') {
    						$error .= "Please enter the artist<br>";
    					}elseif (strlen($title) > 200) {
    						$error .= "Artist length should be less than 200 characters<br>";
    					}elseif (strpos($title, "|||")) {
    						$error .= "Artist should not contain |||<br>";
    					}

    					if ($album == '') {
    						$error .= "Please enter the artist<br>";
    					}elseif (strlen($title) > 200) {
    						$error .= "Album length should be less than 200 characters<br>";
    					}elseif (strpos($title, "|||")) {
    						$error .= "Album should not contain |||<br>";
    					}

    					if ($type == '') {
    						$error .= "Please enter the artist<br>";
    					}elseif (in_array($type, $type_set) == false){
    						$error .= "Unknown type<br>";
    					}

    					$yearPattern = "[0-9]{4}";
    					$cur_y = date("Y");
    					if ($year=='') {
    						$error .= "Please enter the year <br>";
    					}elseif (preg_match("/^$yearPattern$/", $year)==0) {
    						$error .= "Year should be 4 digits<br>";
    					}elseif ((int)$year < 0 || (int)$year > (int)$cur_y) {
    						$error .= "year should be 0 ~ $cur_y<br>";
    					}
    					return $error;
    				}
    				
    				if (isset($_POST['add'])) {
    					$error = checkAdd();
    					if ($error != '') {
    						$error = "Add Error<br>" . $error;
    						print("<div class='error'><p>$error</p></div>");   						
    					}
    				}

    			 ?>
				<div class="error"></div>
    			<table>
    				<tbody>
    					<tr>
					<td class="MusicAttribute">
						Title
					</td>
					<td class="MusicAttribute">
						Artist
					</td>
					<td class="MusicAttribute">
						Album
					</td>
					<td class="MusicAttribute">
						Type
					</td>
					<td class="MusicAttribute">
						Year
					</td>
				</tr>


    				<?php 
    					$show_all = true;
    					function showTuple($attrs){
    						print("<tr>");
    						foreach ($attrs as $attr) {
    							print("<td> $attr </td>");
    						}
    						print("</tr>");
    					}

    					function showMatchTuple($attrs, $matchAttr){
    						print("<tr>");
    						for ($i=0; $i < sizeof($attrs); $i++) { 
    							if (in_array($i, $matchAttr)) {
    								print("<td class = 'match'> $attrs[$i] </td>");
    							}else{
    								print("<td> $attrs[$i] </td>");
    							}
    						}
    						print("</tr>");
    					}

    					function add(){
    						$title = trim($_POST['add_title']);
	    					$artist = trim($_POST['add_artist']);
	    					$album = trim($_POST['add_album']);
	    					$type = trim($_POST['add_type']);
	    					$year = trim($_POST['add_year']);
	    					$info = "";
	    					$info .= $title;
	    					$info .= "|||";
	    					$info .= $artist;
	    					$info .= "|||";
	    					$info .= $album;
	    					$info .= "|||";
	    					$info .= $type;
	    					$info .= "|||";
	    					$info .= $year;
	    					$info .= "\n";

	    					$content = file_get_contents("data.txt");
	    					$content .= $info;
	    					file_put_contents("data.txt", $content);
	    					print("<p>Add success</p>");

    					}



    					function search(){
    						global $show_all;
    						$show_all = false;
    						$title = trim($_POST['search_title']);
	    					$artist = trim($_POST['search_artist']);
	    					$album = trim($_POST['search_album']);
	    					$type = trim($_POST['search_type']);
	    					$year = trim($_POST['search_year']);
	    					$searchAttrs = array($title, $artist, $album, $type, $year);
	    					$error = "";
	    					$len = 0;
	    					foreach ($searchAttrs as $searchAttr) {
	    						$len += strlen($searchAttr);
	    					}
	    					if ($len == 0) {
	    						print("<div class='error'><p>Please enter a filter</p></div>"); 
	    						return;

	    					}
	    					

	    					if ($year != "") {
	    						$yearPattern = "[0-9]{4}";
		    					$cur_y = date("Y");
		    					if ($year=='') {
		    						$error .= "Please enter the year <br>";
		    					}elseif (preg_match("/^$yearPattern$/", $year)==0) {
		    						$error .= "Year should be 4 digits<br>";
		    					}elseif ((int)$year < 0 || (int)$year > (int)$cur_y) {
		    						$error .= "year should be 0 ~ $cur_y<br>";
		    					}
	    					}
	    					if ($error != "") {
	    						$error = "Search Error<br>" . $error;
    							print("<div class='error'><p>$error</p></div>"); 
    							return;
	    					}

	    					
	    					$fp = fopen("data.txt", "r");
	    					
	    					$matchAttr = array();
	    					while (!feof($fp)) {
	    						$match = true;
	    						$line = fgets($fp);
	    						$attrs = explode("|||", $line);
	    						for ($i=0; $i < sizeof($attrs); $i++) { 
	    							if ($searchAttrs[$i] == "") {
	    								continue;
	    							}else{
	    								$temp = strpos(strtolower($attrs[$i]), strtolower($searchAttrs[$i]));
	    								if($temp !== false){
	    									$matchAttr[] = $i;
	    								}else{
	    							    	$match = false;
	    									break;		
	    								}
	    							}
	    						}
	    						if ($match) {
	    							showMatchTuple($attrs, $matchAttr);
	    						}
	    					}
    					}

    					function showAll(){
    						$fp = fopen("data.txt", "r");
    						while (!feof($fp)) {
    							$line = fgets($fp);
    							$attr = explode("|||", $line);
    							showTuple($attr);
    						}
    					}
    					if (isset($_POST['add'])) {
    						if (checkAdd() == '') {
    							add();	
    						}
    					}elseif (isset($_POST['search'])) {
    						search();
    					}
    					if (isset($_POST['show'])) {
    						$show_all = true;
    					}
    					if ($show_all) {
    						showAll();
    					}
    					
    				 ?>
    				 </tbody>
    			</table>
    		</div>
    	</div>
        <?php 

            ?>
    </body>
</html>