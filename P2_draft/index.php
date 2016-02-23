<!DOCTYPE html>
<html class = "main">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
    	<div class="container">
    		<div class="left-half-container">
    			<h1 style="text-align:center;">Add</h1>    		
    			<form method="post">
    				<div class="label">
    					<label>Title</label>
    					<input type="text" name="add_title" required=""><br>
    				</div>
					<div class="label">
						<label>Artist</label>
		    			<input type="text" name="add_artist" required=""><br>		
					</div>
    				<div class="label">
	    				<label>Album</label>
	    				<input type="text" name="add_album" required=""><br>	
    				</div>
    				<div class="label">
	    				<label>Type</label>
		    			<select name="add_type" required="">
		    				<option value="">Please select</option>
		    				<option value="alternative">Alternative Music</option>
		    				<option value="blues">Blues</option>
		    				<option value="classical">Classical Music</option>
		    				<option value="country">Country Music</option>
		    				<option value="dance">Dance Music</option>
		    				<option value="easyListening">Easy Listening</option>
		    				<option value="electronic">Electronic Music</option>
		    				<option value="european">European Music (Folk / Pop)</option>
		    				<option value="hipHop">Hip Hop / Rap</option>
		    				<option value="indie">Indie Pop</option>
		    				<option value="inspirational">Inspirational (incl. Gospel)</option>
		    				<option value="asianPop">Asian Pop (J-Pop, K-pop)</option>
		    				<option value="jazz">Jazz</option>
		    				<option value="latin">latin Music</option>
		    				<option value="newAge">New Age</option>
		    				<option value="R&B/Soul">R&B/Soul</option>
		    				<option value="reggae">Reggae</option>
		    				<option value="rock">Rock</option>
		    				<option value="singer">Singer/Songwriter (inc. Folk)</option>
		    				<option value="world">World Music/Beats</option>
		    				<option value="other">Other</option>
		    			</select>			
    				</div>
    				<div class="label">
    					<label>Year</label>
    					<input type="text" name="add_year" required="" pattern = "[0-9]{4}"  title="Four letter year"><br>
    				</div>
    				<div class="label">
							<input id="submit" type="submit" name="add" value="Add">						
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
		    				<option value="alternative">Alternative Music</option>
		    				<option value="blues">Blues</option>
		    				<option value="classical">Classical Music</option>
		    				<option value="country">Country Music</option>
		    				<option value="dance">Dance Music</option>
		    				<option value="easyListening">Easy Listening</option>
		    				<option value="electronic">Electronic Music</option>
		    				<option value="european">European Music (Folk / Pop)</option>
		    				<option value="hipHop">Hip Hop / Rap</option>
		    				<option value="indie">Indie Pop</option>
		    				<option value="inspirational">Inspirational (incl. Gospel)</option>
		    				<option value="asianPop">Asian Pop (J-Pop, K-pop)</option>
		    				<option value="jazz">Jazz</option>
		    				<option value="latin">latin Music</option>
		    				<option value="newAge">New Age</option>
		    				<option value="R&B/Soul">R&B/Soul</option>
		    				<option value="reggae">Reggae</option>
		    				<option value="rock">Rock</option>
		    				<option value="singer">Singer/Songwriter (inc. Folk)</option>
		    				<option value="world">World Music/Beats</option>
		    				<option value="other">Other</option>
		    			</select>			
    				</div>
    				<div class="label">
    					<label>Year</label>
    					<input type="text" name="search_year" pattern = "[0-9]{4}"><br>
    				</div>
    				<div class="label">
						<input id="submit" type="submit" name="search" value="search">						
					</div>
    			</form>
    		</div>
    	</div>
    	<div class="container">
    		<div class="result">
    			<?php 
    				function checkAdd(){

    				}
    				if (isset($_POST['add'])) {
    					$error = "";
    					$title = trim($_POST['add_title']);
    					$artist = trim($_POST['add_artist']);
    					$album = trim($_POST['add_album']);
    					$type = trim($_POST['add_type']);
    					$year = trim($_POST['add_year']);

    					if ($title == '') {
    						$error .= 
    					}
    				}

    			 ?>
	
    			<table>
    			
    			</table>
    		</div>
    	</div>
        <?php 

            ?>
    </body>
</html>