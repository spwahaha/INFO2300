<?php
//Instructor: set this to the location of images and text files on the public server
$server = "https://info2300.coecis.cornell.edu/users/_demosp16/www/section08/common";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pok&eacute;mon</title>
    <!-- Pokemon font from "http://www.dafont.com/pokemon.font?text=awieoapwefiasdf"-->
    <link rel="stylesheet" href="<?php echo $server ?>/css/style.css">
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="<?php echo $server ?>/js/script.js"></script>
    <script>
        $(document).ready(function(){
            $('#17').parent().css('margin-top','0px');
            $('#17').parent().css('border','solid #DAA520 2px');
            $('#17').parent().css('margin-bottom','0px');
        });
    </script>
</head>

<body>
    <div id="nav">
        <div id="left">
            <span id="title">Pok&eacute;mon</span><br>
            
            <div id="middle">
                <a href="gen1.php">
                    <img src="<?php echo $server ?>/images/pokeball.png" class="nav_img">
                    Gen I
                </a>
                &nbsp; &nbsp;
                <a href="gen2.php">
                    <img src="<?php echo $server ?>/images/pokeball.png" class="nav_img">
                    Gen II
                </a>
                &nbsp; &nbsp;
                <a href="index.php">
                    <img src="<?php echo $server ?>/images/pokeball.png" class="nav_img">
                    Gen III
                </a>
            </div>
        </div>
    </div>
    <div id="main">
        <img src="<?php echo $server ?>/images/pokedex.png" alt="pokedex" id="pokedex">
        <span id="insert_new"><button type="button" id="ins_new">Gen III Insert Pokemon</button></span>
        <!-- This is the image being looked at-->
        <div id="main_img_c">
            <img src="<?php echo $server ?>/images/bg.jpg" alt="img" id="main_img">
        </div>
