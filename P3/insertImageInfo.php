<?php 
	include("config.php");
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$credit = "http://s.qdcdn.com/cl/";
	$imgFolder = "imgs/";
	$dir = "imgs/";
	if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
    	print("isdir and process");
        while (($file = readdir($dh)) !== false) {
        	$credit = "http://s.qdcdn.com/cl/";
        	print("file name : $file");
        	$title = explode(".", $file)[0];
        	if ($title == '') {
        		continue;
        	}
        	$file_path = $file;
        	$credit .= $file;
        	$date_created = "CURRENT_TIMESTAMP";
        	$fieldNameAr = array("Title", "file_path", "Credit", "Date_created");
        	$title = "'".$title."'";
        	print($title);
        	$file_path = "'" . $file_path . "'";
        	$credit = "'" . $credit . "'";
        	$fieldValues = array($title, $file_path, $credit, $date_created);
        	$fieldValues = str_replace(",","#",$fieldValues);
        	$fileList = implode(",", $fieldNameAr);
        	$valueList = implode(",",$fieldValues);
            $sql = "INSERT INTO Images ($fileList) VALUES ($valueList);";
            print ("sql: $sql");
        	$result = $mysqli->query($sql);
        	print("result : $result");
        }
        closedir($dh);
    }

}
 ?>