<div id="insert_form">
    <!-- Creates the HTML input form.  enctype='multipart/form-data' is REQUIRED for forms that have file upload control.  *PROVIDED* -->
    <form action="index.php" method="post" enctype="multipart/form-data">
        <br><br>Pokemon Name:<br><br>
        <input type="text" name="caption"><br><br><br><br>
        Pokemon Image:<br><br>
        <!-- File upload -->
        <input type="file" name="new_file"/><br><br><br><br>
        <input type="submit" name="submit">
        
        
<?php
/* 
For simplicity's sake, this PHP code ignores many elements you'll need to take into consideration
for your final version of Project 3.  IE: in this site, all images are saved as PNG files; this code is reused for each
album of the database instead of using $variables in order to use the same code for all albums; this site does not
restrict to only allow certain filetypes.
*/

/* 
Use the global PHP $_FILES array to upload files from a client computer to the remote server.
 * $_FILES['new_file']['name'] - the name of the uploaded file
 * $_FILES['new_file']['tmp_name'] - the name of the temporary copy of the file stored on the server
 * $_FILES['new_file']['size'] - the size in bytes of the uploaded file
 * $_FILES['new_file']['type'] - the type of the uploaded file
 * $_FILES['new_file']['error'] - the error code resulting from the file upload (0 if no error occurs)
The string currently written as 'new_file' is the name you give your file input in your form.  The next strings
('name','type','size','tmp_name', and 'error') are constants of the global PHP $_FILES array and should not ever be changed
*/

if(isset($_POST['submit'])){
    if(!empty($_FILES['new_file']) && !empty($_POST['caption'])){

        $tmp_path = $_FILES["new_file"]["tmp_name"];
        $caption = htmlentities($_POST['caption']);
        $url = $caption . ".png";
        $path = "images/genIII/" . $url;
        // Check to see if no error occurs
        if($_FILES["new_file"]["error"] > 0){
            echo "Return Code: " . $_FILES["new_file"]["error"] . "<br>";
        }
        else{
            // Establish a new connection to the database
            $mysqli2 = new mysqli($host,$login,$password,$databaseName);
            
            
            //TODO 1: save file into folder "images/genIII".  HINT: use PHP function 'move_uploaded_file'.  The variables you need to use as
            // parameters have already been created for you above.
            
            
            
            //TODO 2: perform a MySQL query to INSERT the image into the database.  Set url to be $url, dTaken to be NOW(), and caption to be $caption
            
            
            
            //Uncomment the following echo when you have implemented your MySQL here.  Needed for arrow key navigation of images.
            //echo "<script type='text/javascript'>max = max + 1;</script>";

            //TODO 3: Close the connection to the MySQL database
            
        }
    }
}
?>
    </form>
</div>