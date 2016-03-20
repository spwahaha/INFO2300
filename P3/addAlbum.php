    <p>
      Add new Album
    </p>
    <form action="addAlbum.php" method="post">
      Title:
      <input type="text" name="title">
      <input type="submit" name="submit">
    </form>
    <?php 
      if (isset($_POST) && !empty($_POST)) {
        $title = $_POST["title"];
        if(validInput($title)){
          insertAlbum(htmlentities($title));
          print("new Album Added");
        }else{
          print("Invalid title");
        }
      }
     ?>