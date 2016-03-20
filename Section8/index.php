<?php

/*

In this activity you will help us update our Pokedex. GenI and GenII have already been created for you, so you are in charge of updating GenIII.
The goal of this activity is to give you practice with PHPmyAdmin, SQL in PHP, and file uploads.

Useful Information:
* new mysqli(host, usernmae, password, database): connects to the selected database using the username and password.
````Host is always 'localhost'
````Database name is info230_SP16_[username]
`````Use a password you don't care about (TAs will be able to see them)
* query(query): runs a SQL query on the database.  For SELECTs, returns the result if successful and false if failure.
````For INSERT, UPDATE, DELETE, returns true if successful, false if not.
* fetch_row(): returns the next record from the results table
* fetch_assoc(): returns the next record from the results table, but as an associative array with relation attributes as keys
* num_rows: the number of records in the results table
* mysqli->close(): close the connection to the database
````mysqli->close() should always be called otherwise they may max out connections to the database 
* user input should always be checked before inserted into the database
* use $mysqli->real_escape_string($string) to not have to deal with quotes in $string    
*/
    
/* 
TODO 1: Create the GenIII table in phpMyAdmin.
GenIII(pid: INT, url: VARCHAR(100), dTaken: TIMESTAMP, caption: VARCHAR(30))
Primary key: pid.  Make autoincrement.
Note that it's capital "iii" after "Gen"
*/
    

/* 
TODO 2: Populate the table with the following values (do this in phpMyAdmin)
'image1.png', CURRENT_TIMESTAMP, 'image1'
'image2.png', CURRENT_TIMESTAMP, 'image2'
*/
    
    
/*
TODO 3: Assign variables $login, $password, and $databaseName in password.php
You will need these values in order to establish your connection to the MySQL database.
REMINDER: TAs will be able to see your password for the info2300 website and MySQL database, so avoid using very personal passwords.
*/

include "password.php";
include 'header.php';
include 'insert.php';
echo '<p id="main_caption"><br>Gen III</p>';
echo '</div><div id="all_pics">';


//TODO 4: Write the code to establish a connection to the database (using a mysqli object)
$mysqli = new mysqli($host, $login, $password, $databaseName);


//TODO 5: Check if establishing that connection yielded any errors
if ($mysqli->connect_errno) {
	printf("connect failed\n", $mysqli->connect_error);
	exit();
}


    
//TODO 6: Perform a query to select all columns of all images in the GenIII table.  Order by pid.  Set this value to be $result.
$result = $mysqli->query("SELECT * FROM GenIII ORDER BY pid");

//$variable used to count number of pictures in album and set this value to be the img id
$counter = 0;


/* 
TODO 7: Check to see if $result has rows to print, and then, for each row, print it in the following form:
echo $str1 . "<img src='images/genI/[url]' alt='[caption]' class='all_imgs' id='$counter'>" . $str2;
Be sure to keep $str1, class='all_imgs', and $str2 in there; it's needed for the default CSS and JQuery
Also be sure to increment $counter with each iteration of the loop (You can write '$counter++' inside your loop to do so)
*/
$str1 = "<button class='all_pics_a'>";
$str2 = "</button>";
while ($row = $result->fetch_assoc()) {
	$url = $row['url'];
	$caption = $row['caption'];
	echo $str1 . "<img src='images/genIII/$url' alt='$caption' class='all_imgs' id='$counter'>" . $str2;
	$counter++;
}





/* The captions 'image1' and 'image2' are unclear, and so we want to change them.  We've provided $variables ($img1 and $img2) representing the values to change them to.

TODO 8: Perform a query (or two queries) to update the two columns of your table.
Set the column with url "image1.png" to have a caption equal to $img1
Set the column with url "image2.png" to have a caption equal to $img2
NOTE: You will likely have to reload twice since this query is performed after the query to select and display all images.
*/
$img1 = "Treecko";
$img2 = "Grovyle";
$result = $mysqli->query("UPDATE GenIII SET caption='$img1' WHERE url = 'image1.png'");
$result = $mysqli->query("UPDATE GenIII SET caption='$img2' WHERE url = 'image2.png'");

/*
Now let's finish off this table! We prepared a couple more GenIII images for you.
The captions and image names are stored in a txt file (make sure your permissions are set properly).  Insert these images into the table.
*/
//$file = file("images/genIII.txt");

/*
TODO 9: Before inserting the images, check to see if the images have already been uploaded.
Hacky solution: select all columns and execute the for loop if the number of rows in the table is < 3.  You can use the previously created $result for this.
*/
		
    /*
    TODO 10: Perform a query to insert an image into the table for each line of the file.
    Hint: url will be '$file[$i].png', dTaken will be NOW(), and caption will be '$file[$i]'
    
    for($i=0;$i< sizeof($file);$i++){

    }
    */

/*
Uh-oh!!!  There's an extra image in the txt file, and now you've got an unwanted item being stored in your table.
TODO 11: Perform a query to DELETE 'mysql_is_too_hard.png' from the table.
*/




/*You should ALWAYS close the connection after you're finished with your queries, otherwise you may max out connections to the database.
TODO 12: Close the connection to the MySQL database.
*/




//TODO 13: Now it is time to implement INSERTs into the MySQL database.  To do so, open the file 'include.php' and follow the steps listed there.

/*
If you finish the lab early, make the code more optimal.  Try to only allow certain filetypes to be uploaded, or work on handling user inputs.
e.g. How can you handle apostrophes being INSERTed into your database?
If you implemented the hacky solution for TODO 9, try implementing a more optimal solution that instead checks to see if each saved image has been added to the database.
If not, add the image, otherwise do not add the image.  This will also go inside the for loop on the sizeof($file) rather than outside it!
*/

?>

</div>
</body>
</html>