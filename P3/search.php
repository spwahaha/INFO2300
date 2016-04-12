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
  <p>
    This page allow users search album or images
  </p>
        
    <div class="search">
      <p>
        Image Name
      </p>
        <form action="search.php" method="post">
          <input type="text" name="image_name">
          <input type="submit" value="search">
      </form>
    </div>

    
   <div id="Albumpics" class="pics">
    <?php 


      if (isset($_POST['image_name']) && !empty($_POST['image_name'])) {
        $image_name = filter_input( INPUT_POST, 'image_name', FILTER_SANITIZE_STRING );
        // echo "image name :  $image_name";
        print("<ul>");
        if(validInput($image_name)){
          
          $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
          $query = "SELECT * FROM Images WHERE LOWER(Title) LIKE LOWER('%$image_name%')";
          // print("query:   $query");
          $result = $mysqli->query($query);
          while ($row = $result->fetch_assoc()) {
            $Iid=$row['Iid'];
            // print("Iid: $Iid");

            $Title=$row['Title'];
            // print("Title:  $Title");

            $Date_created=$row['Date_created'];
            // print("Date_created:  $Date_created");


          $image = $row["Title"];
          $count = 2;
          $image = str_replace("#",",",$image);
          // len = strlen($image);
          
          $imgPath = $row["File_path"];
          // print($imgPath);
          print("<li>");
          print("<a href='image.php?Iid=$Iid'>");
          print("<img  src='$imgPath' alt='' height='140px'>");
          print("</a>");
          // print(str_replace("#",",",$row["Title"]));
          print("</li>");
        }
        print("</ul>");

          // print("new Album Added");
        }else{
          print("Invalid title");
        }
      }


     ?>

   </div>


</body>
<html>