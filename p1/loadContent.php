<?php
    function printContent($theme,$tableName)
    {
        $db        = new SQLite3("newYear.db");
        $themeStr  = '"' . $theme . '"';
        $statement = "SELECT title, content, imgsrc FROM $tableName WHERE theme = $themeStr;";
        $results   = $db->query($statement);
        $row       = $results->fetchArray();
        $title     = $row[0];
        $content   = $row[1];
        $imgsrc = $row[2];
        $imgsrc = '"' . $imgsrc . '"';
        $db->close();
        $img       = '"' . "img/" . "$theme" . '.jpg' . '"';
        print("<p>$title</p>");
        print("<h2>$content</h2>");
        print("<img src= $imgsrc alt=$theme>");
        print("The image is downloaded from <a href= $imgsrc>Here</a>");
    }
    foreach ($themes as $theme) {
        # code...
        print("<div id = $theme>");
        printContent($theme,$tableName);
        print("</div>");
    }
?>