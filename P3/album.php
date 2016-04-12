<?php session_start(); ?>
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <title>Gallery</title>
</head>
<body>

   <?php 
      include("nav.php")
    ?>
<!--   <p>
    This page allow user to edit their album and image database
  </p> -->
  <?php 
     include("config.php");
    include("util.php");
   ?>
   <div id="Albumpics" class="pics">

  <?php 
    $userMode = 0;
    if (isset($_SESSION['logged_user_by_sql'])) {
      print "<p>Welcome, " . $_SESSION['logged_user_by_sql'] . "</p>";
      // require 'logout.php';
      $userMode = 1;
    }

    $newName = filter_input( INPUT_POST, 'newName', FILTER_SANITIZE_STRING );
    if ( !empty( $newName ) && $userMode == 1) {
       $Aid = filter_input( INPUT_GET, 'Aid', FILTER_SANITIZE_STRING );
      // echo "Aid:  $Aid";
      // echo "newName:  $newName";
      updateAlbumName($Aid, $newName);
    }

    $delete = filter_input( INPUT_POST, 'delete', FILTER_SANITIZE_STRING );
    $delete = $delete=='deleteAlbum';
    // print("delete +  $delete");
    $Aid = filter_input(INPUT_GET, 'Aid', FILTER_SANITIZE_STRING);
    $Iid = filter_input(INPUT_GET, 'Iid', FILTER_SANITIZE_STRING);

    if ($delete==1 && $userMode == 1) {
      deleteAlbum($Aid);
    }

    if (isset($Aid) && isset($Iid) && $userMode == 1) {
      // print("Aid: + $Aid");
      // print("Iid: + $Iid");
      deleteImageFromAlbum($Aid, $Iid);
      // if (is_numeric($Aid)) {
      //     getImageByAlbumId($Aid, 1);
      // }
    }
    if(isset($Aid)){
      // $Aid = $_GET["Aid"];
      $albumName = getAlbumName($Aid);
      if (strlen($albumName) == 0) {
        print("<p>Album doesn't exists</p>");
      }else{
        print("<h1>$albumName</h1>");
        if ($userMode == 1) {
          print("<form method='post'>
                      <label for=''>New Title</label>
                      <input type='text' name='newName'>
                      <input type='submit' value='update album name'>
                  </form>");
          print("<form method='post'>
                      <input type='submit' name ='delete' value='deleteAlbum'>
                  </form>");
          }
        
        // print $Aid;
        if (is_numeric($Aid)) {
            getImageByAlbumId($Aid, $userMode);
        }
      }
      
    }else{
        loadAlbum($userMode);
         // include("loadAlbum.php");
    }

    

    ?>
       </div>

</body>
<html>