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
      include("nav.php");
      include("config.php");
      include("util.php")
    ?>
  <p>
    Image page
  </p>


  <div class="image">
   <?php 
    $userMode = 0;
    if (isset($_SESSION['logged_user_by_sql'])) {
      print "<p>Welcome, " . $_SESSION['logged_user_by_sql'] . "</p>";
      // require 'logout.php';
      $userMode = 1;
    }
    // $edit = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_STRING);
    $Iid = filter_input(INPUT_GET, 'Iid', FILTER_SANITIZE_STRING);
    $newName = filter_input( INPUT_POST, 'newName', FILTER_SANITIZE_STRING );
    $delete = filter_input( INPUT_POST, 'delete', FILTER_SANITIZE_STRING );
    $delete = $delete=='delete';
    if ($delete==1 && $userMode == 1) {
            deleteImage($Iid);
          }
    $exist = imageExists($Iid);
    if ($exist == 0) {
      print("<h1>Image is deleted!!</h1>");
    }else{
            if ( !empty( $newName ) && $userMode == 1) {
          // echo "Aid:  $Aid";
          // echo "newName:  $newName";
          updateImageName($Iid, $newName);
        }

        if(isset($Iid) && $userMode == 1){
          // print $Aid;
                print("<form method='post'>
                        <label for=''>New Title</label>
                        <input type='text' name='newName'>
                        <input type='submit' value='update Image name'>
                    </form>");
                print("<p>Move to</p>");
                print("<div class='addphoto'>");
                print("<form method='post'> ");
                showCheckBox();
                print("<input style='margin-left:20px;'type='submit' value='Move'>");
                print("</form>");
                print("</div> ");
          }


          if (isset($_POST['album']) && !empty($_POST['album']) && $userMode==1) {
                $seletedAlbum = $_POST['album'];
                // foreach ($seletedAlbum as $value) {
                //    print("$value");
                // }
                movePhoto($Iid,$seletedAlbum);
                print("Move successfully!");
          }

          
          if (is_numeric($Iid)) {
              showImage($Iid, $userMode);
          }
    }
    
      
    ?>   
    
  </div>

   

</body>
<html>