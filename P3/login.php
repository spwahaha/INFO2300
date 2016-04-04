<?php session_start(); ?>
<!DOCTYPE html>
<html>
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
      This page navigate the user sign in
    </p>


    <?php
    if (isset($_SESSION['logged_user_by_sql'])) {
      print "<p>Welcome, " . $_SESSION['logged_user_by_sql'] . "</p>";
      // require 'logout.php';
      print("<p>Click here to <a href='logout.php'>logout</a></p>");
    } else { ?>

 <?php 
    $post_username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
    $post_password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
    if ( empty( $post_username ) || empty( $post_password ) ) {
    ?>
    <div class="login">
        <h2>Log in</h2>
        <form action="login.php" method="post">
          Username: <input type="text" name="username"> <br>
          Password: <input type="password" name="password"> <br>
          <input type="submit" value="Submit">
        </form>
    </div> 
    <?php

    } else {
      //       print "<p>You haven't logged in.</p>";
      // print "<p>Go to our <a href='login.php'>login page</a></p>";
      /* SQL to create a table that matches the fields used here
       * username and password are the important fields. Since username
       * has to be unique, you could use it for a primary key instead of creating
       * a specific auto number field as I did here.
       * You'll have to decide whether to have fields for first name, last name and anything else about users
       */
      /*
      CREATE TABLE IF NOT EXISTS `users` (
        `userID` int(11) NOT NULL AUTO_INCREMENT,
        `hashpassword` varchar(255) NOT NULL,
        `username` varchar(50) NOT NULL,
        `name` varchar(50),
        PRIMARY KEY (`userID`),
        UNIQUE KEY `idx_unique_username` (`username`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
      */

      //Get the config file which is positioned 1 folder level above this one
      require_once 'config.php';
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      if( $mysqli->connect_errno ) {
        //uncomment the next line for debugging
        echo "<p>$mysqli->connect_error<p>";
        die( "Couldn't connect to database");
      }
      //hash the entered password for comparison with the db hashed password
      // echo "<p>posted password: $post_password</p>";
      $hashed_password = password_hash($post_password, PASSWORD_DEFAULT) . '<br>';

      //Un-comment this line to print out the hash of a password you enter.
      //This value is what you need to enter into the hashpassword field in the database
      // echo "<p>Hashed password: $hashed_password</p>";
      
      //Check for a record that matches the POSTed username
      //Note: This SQL lacks proper security. That's coming later
      $query = "SELECT * 
            FROM users
            WHERE
              username = '$post_username'";

      $result = $mysqli->query($query);
      
      //Uncomment the next line for debugging
      //echo "<pre>" . print_r( $mysqli, true) . "</p>";

      //Make sure there is exactly one user with this username
      if ( $result && $result->num_rows == 1) {
        
        $row = $result->fetch_assoc();
        //Debugging
        //echo "<pre>" . print_r( $row, true) . "</p>";
        
        $db_hash_password = $row['hashpassword'];
        // echo "db_hash_password: $db_hash_password";
        if( password_verify( $post_password, $db_hash_password ) ) {
          $db_username = $row['username'];
          $_SESSION['logged_user_by_sql'] = $db_username;
        }
      } 
      
      $mysqli->close();
      
      if ( isset($_SESSION['logged_user_by_sql'] ) ) {
        print("<p>Congratulations, $db_username. You are logged in successfully.<p>");
      } else {
        echo '<p>You did not login successfully.</p>';
        echo '<p>Please <a href="login.php">try</a> again.</p>';
      }
      
    } //end if isset username and password
      
    
    // require 'navigation.php';
        }
    ?>








   
  </body>
</html>
