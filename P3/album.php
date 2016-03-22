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
  <p>
    This page allow user to edit their album and image database
  </p>
  <?php 
     include("config.php");
    include("editAlbum.php");
   ?>

   <div id="Albumpics" class="pics">
      <?php 
    if(isset($_GET["Aid"])){
      $Aid = $_GET["Aid"];
      // print $Aid;
      if (is_numeric($Aid)) {
          getImageByAlbumId($Aid);
      }
    }else{
         include("loadAlbum.php");
    }
    ?>
       </div>

</body>
<html>