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
      include("config.php");
      include("nav.php");
      include("util.php");
    ?>
<!--   <p>
    This page allow users add album or images
  </p> -->
  <?php
        $userMode = 0;
      if (isset($_SESSION['logged_user_by_sql'])) {
        print "<p>Welcome, " . $_SESSION['logged_user_by_sql'] . "</p>";
        // require 'logout.php';
        $userMode = 1;
      }

      if ($userMode == 1) {
        print("<div class='addalbum'>
          <p>
            Add new Album
          </p>
            <form action='add.php' method='post'>
              <label for='new-album'>Title: </label>
              <input id='new-album' type='text' name='title'>
              <input type='submit' name='submit'>
          </form>
        </div>");

        print("<p>
          Add new image
        </p>
        <div class='addphoto'>
              <form class = 'uploadPhoto' method='post' enctype='multipart/form-data'>
          <p>
            <label for='new-photo'>Single photo upload: </label>
            <input id='new-photo' type='file' accept='image/*' name='newphoto'>
            <label for='credit'>credit: </label>
            <input id='credit' type='text' name='credit'>
            <br>");
            // include('albumCheckbox.php'); 
             showCheckBox();
             print("
            <input style='margin-left:20px;'type='submit' value='Upload photo'>
          </p>
        </form>

        </div>");
      }else{
        print("<p>Please login to add album and image</p>");
      }
    ?>
    <?php 
      if (isset($_POST['title']) && !empty($_POST['title'])) {
        $title = $_POST['title'];
        if(validInput($title)){
          insertAlbum(htmlentities($title));
          print("new Album Added");
        }else{
          print("Invalid title");
        }
      }

      //Check to see if a file was uploaded using the "single file" form
      if ( ! empty( $_FILES['newphoto'] ) ) {
        $newPhoto = $_FILES['newphoto'];
        $newPhotoType = $newPhoto["type"];
        $pos = strpos($newPhotoType, "image");
        $originalName = $newPhoto['name'];
        print("Photo Type: $newPhotoType");
        if($pos === false){
          print("<p>Error: Wrong file type for $originalName .</p>");
        }else{
          if ( $newPhoto['error'] == 0 ) {
            $tempName = $newPhoto['tmp_name'];
            $seletedAlbum = null;
            move_uploaded_file( $tempName, "imgs/$originalName");
            if (isset($_POST['album']) && !empty($_POST['album'])) {
                $seletedAlbum = $_POST['album'];
                foreach ($seletedAlbum as $value) {
                   print("$value");
                }
            }


            $_SESSION['photos'][] = $originalName;
            print("<p>The file $originalName was uploaded successfully.</p>");
            $path = "imgs/$originalName";
            $credit = $_POST['credit'];
            insertPhoto($originalName, $path,$credit, $seletedAlbum);
          } else {
            print("<p>Error: The file $originalName was not uploaded.</p>");
          }
        }
        
      }

     ?>




</body>
<html>