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
      include("util.php");
    ?>
  <p>
    This page is the home page
  </p>



   <div class="pics">
       <?php 
       loadImage();
      ?>
    </div>
   

</body>
<html>