<?php
include 'header.php';
include 'password.php';
?>


<div id="insert_form">
<form action="gen2.php" method="post" enctype="multipart/form-data">
    <br><br>Pokemon Name:<br><br>
    <input type="text" name="caption"><br><br><br><br>
    Pokemon Image:<br><br>
    <!--File upload-->
    <input type="file" name="new_file"/><br><br><br><br>
    <input type="submit" name="submit">
    
<?php
    /* For simplicity's sake, this PHP code ignores many elements you'll need to take into consideration
     * for your final version of Project 3.
     */
    if(isset($_POST['submit'])){
        if(!empty($_FILES['new_file']) && !empty($_POST['caption'])){ 
            $tmp_path = $_FILES["new_file"]["tmp_name"];
            $caption = htmlentities($_POST['caption']);
            $path = $caption . ".png";
            if($_FILES["new_file"]["error"] > 0){
                echo "Return Code: " . $_FILES["new_file"]["error"] . "<br>";
            }
            else{
                $v1 = move_uploaded_file($_FILES["new_file"]["tmp_name"], $server . "/genII/" . $path);
                $mysqli2 = new mysqli($host,$login,$password,$databaseName);
                $query4 = "INSERT INTO `GenII`(`url`,`dTaken`,`caption`) VALUES ('" . $path . "',NOW(),'" . $caption . "')";
                echo "<script type='text/javascript'>";
                echo "max = max + 1;";
                echo "</script>";
                $mysqli2->query($query4);
            }
        }
    }
?>
</form>
</div>

<p id="main_caption">
    <br>
    Gen II
</p>
</div>


<div id="all_pics">
    <?php

        $file = file($server . "/genII.txt");
        $mysqli = new mysqli($host,$login,$password,$databaseName);

        if (mysqli_connect_error() ){
            die("Can't connect to database: " . $mysqli->error);
        }
        else{
            $query1 = "CREATE TABLE IF NOT EXISTS GenII(pid INT(11) NOT NULL AUTO_INCREMENT,url VARCHAR(100),dTaken TIMESTAMP, caption VARCHAR(30), PRIMARY KEY (pid))";
            $mysqli->query($query1);
            $result1 = $mysqli->query("SELECT * FROM GenII");
            if(mysqli_num_rows($result1) == 0){
                for($i=0;$i< sizeof($file);$i++){
                    $query2 = "INSERT INTO `GenII`(`url`,`dTaken`,`caption`) VALUES ('" . $file[$i] . ".png', NOW(),'" . $file[$i] . "')";
                    $mysqli->query($query2);
                }
            }  
        }


    ?>
    <?php
        $query3 = "SELECT * FROM GenII ORDER BY pid";
        $result2 = $mysqli->query($query3);
        // $variable used to count number of photos in album and set this value to be the img id
        $counter = 0;
        if($result2 && $result2->num_rows > 0){
            while($array = $result2->fetch_assoc()){
                echo "<button class='all_pics_a'>";
                echo "<img src='" . $server . "/genII/" . $array['url'] . "' alt='" . $array['caption'] . "' class='all_imgs' id='" . $counter ."'>";
                echo "</button>";
                $counter++;
            }
        }
    ?>
</div>
</body>
</html>