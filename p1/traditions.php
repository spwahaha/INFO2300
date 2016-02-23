<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>Happy New Year</title>
    </head>
    <body>
        <div class="page">
            <div class="top">
                <div class="logo">
                    <h1>Happy Chinese New Year</h1>
                </div>
                <div class="nav-bar">
                    <ul>
                        <?php
                            #include nab bar
                            include("nav.php");
                        ?>
                    </ul>
                </div>
            </div>
            <div class="traditions">
                <div class="container">
                    <?php
                        #get data from database and output result
                        $tableName = "Traditions";
                        $themes = array("food","practices");
                        include("loadContent.php");
                    ?>
                </div>
            </div>
        </div>
        <div class = "footer">
            Copyright Zhenchuan Pang 2016， The content refers from <a href = "http://www.chinaculturetour.com/culture/chinese-new-year.htm">Here</a>
        </div>
    </body>
</html>