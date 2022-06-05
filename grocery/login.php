<?php

    // login info entered
    if($_POST["username"] != ''){

        // Connect to SQL
        $server = "localhost";
        $username = "root";
        $password = "et-1331g";
        $database = "users";
        $conn = new mysqli($server, $username, $password, $database);

        // search for user
        $sql = "SELECT * FROM login WHERE username=\"".$_POST["username"]."\";";
        $search = $conn->query($sql)->fetch_row();

        // No user found
        if($search == ""){

            // send username to 'create account' page
            header("Location: createaccount.php?username=".$_POST["username"]);
            die();

        // user account found
        }else{

            // check password
            if(password_verify($_POST["password"], $search[1])){
                
                // create cookie. do to index.php
                setcookie("username", $_POST["username"], time() + (86400 * 365), "/");
                header("Location: index.php");
                die();

            // Password Wrong
            }else{
                echo "<link rel=\"stylesheet\" href=\"login.css\">";
                echo "<p id=\"passwordincorrect\">Password Incorrect<p>";

            }
        }
    }else{

        echo "<link rel=\"stylesheet\" href=\"login.css\">";
        echo "<form method=\"POST\" action=\"login.php\">";

        // Username textbox
        echo "<table><tr>";
        echo "<td><label for=\"username\">Username</label></td>";
        echo "<td><input name=\"username\"type=\"text\"></td>";
        echo "</tr>";
        
        // Password textbox
        echo "<tr>";
        echo "<td><label for=\"password\">Password</label></td>";
        echo "<td><input name=\"password\" type=\"password\"></td>";
        echo "</tr>";
        
        // login button
        echo "<tr><td colspan=\"2\" align=\"center\">";
        echo "<input type=\"submit\" href=\"\" value=\"Log In\">";
        echo "</td></tr>";
        echo "<table>";
    
        echo "</form>";
    }

    

?>