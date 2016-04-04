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
      include("nav.php");
      include("config.php");
      include("editAlbum.php")
    ?>
  <p>
    Image page
  </p>


  <div class="image">
   <?php 
    if(isset($_GET["Iid"])){
      $Aid = $_GET["Iid"];
      // print $Aid;
      if (is_numeric($Aid)) {
          getImageByImageId($Aid);
      }
      }
    ?>    
  </div>

   

</body>
<html>