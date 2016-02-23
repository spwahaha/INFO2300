<?php
    $navElement = array("index.php"=>"Home",
    					"introduction.php" => "Introduction",
    					"traditions.php" => "Traditions",
    					"howsLuck.php" => "How's Your Luck");
    foreach($navElement as $src => $describe){
    	print("<li><a href = $src> $describe </a></li>");
    }
?>
