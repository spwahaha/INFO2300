<!DOCTYPE html>
<html lang="en" class= "luckPage">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Zhenchuan Pang's HomePage</title>
    </head>

    <body>

      <div class="top">
            <div class="logo">
                          <h1>Happy Chinese New Year</h1>
            </div>
            <div class="nav-bar">
              <ul>
                <?php
                    include("nav.php");
                    ?>
              </ul>
            </div>
        </div>
        
        <div class="container">
            <div class="inputSection">
                <div class = "divine">
                  <form method="post">
                    <p>Type in your info to see how's your luck this year</p>
                    <label>Name:</label>
                    <input type="text" name="input"><br>
                    <label>Birthday:</label>
                    <input type="date" name="bday"><br> 
                    
                    <div class="gender">
                        <label>Gender:</label>
                        <input type="radio" name="gender" value="male" checked> Male
                        <input type="radio" name="gender" value="female"> Female
                        <input type="radio" name="gender" value="other"> Other
                        
                    </div>
                    <input type="submit" value="submit" />
                  </form>
        
                </div>
            </div>
            <div class="outputSec">
                <?php

                function printLuckness($name, $date, $gender)
                {
                    $rand_index = (abs(crc32("$name" . "$date" . "$gender")) % 10) + 1;
                    $db        = new SQLite3("newYear.db");
                    $statement = "SELECT Luckiness.Content FROM Luckiness WHERE id = $rand_index;";
                    $results   = $db->query($statement);
                    $row       = $results->fetchArray();
                    $lucy_info = $row[0];
                    print("<h1>Name: $name</h1>");
                    print("<h1>Birthday: $date</h1>");
                    print("<p>Your luck this year:<p>");
                    print("<h2>$lucy_info</h2>");
                }

                function isValidDate($date){
                    $dateArr = explode("-", $date);
                    $cur = getdate();
                    $curY = (int)$cur["year"];
                    $curM = (int)$cur["mon"];
                    $curD = (int)$cur["mday"];
                    $inY = (int)$dateArr[0];
                    $inM = (int)$dateArr[1];
                    $inD = (int)$dateArr[2];
                    // print("<h2>$curY and $inY</h2>");
                    // print("<h2>$curM and $inM</h2>");
                    // print("<h2>$curD and $inD</h2>");
                    if($inY > $curY){
                        return false;  
                    } elseif($inY == $curY && $inM > $curY){
                      return false;  
                    } elseif($inY == $curY && $inM == $curM && $inD > $curD){
                        return false;   
                    } else{
                        return true;
                    }
                }

                if (isset($_POST['input']) && isset($_POST['bday'])) {
                    if($_POST['bday'] == "" || $_POST['input'] == ""){
                        print("<h2>The name or data you entered is unvalid!</h2>");
                    }else{
                        $name  = $_POST['input'];
                        $date = $_POST['bday'];
                        $gender = $_POST['gender'];
                        $validDate = isValidDate($date);
                        $match = preg_match("/^[a-z A-Z]/", $name);
                        if (isset($name) && isset($date) && $match && $validDate) {
                            //Display the text that was input for translation
                            printLuckness($name, $date, $gender);
                            
                        } else {
                            if(!$match && !$validDate){
                                print("<h2>The name and data you entered is unvalid!</h2>");
                            }elseif(!$match){
                                print("<h2>The name you entered is unvalid!</h2>");    
                            }{
                                print("<h2>The name or data you entered is unvalid!</h2>");
                            }
                            
                        }    
                    } 
                }
            ?>    
            </div>

            
        </div> 
    </body>
</html>

