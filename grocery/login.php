<?php

    // login info entered
    if($_POST["username"] != ''){

        // Connect to login database
        include "pageparts/connectlogin.php";

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

        // BETA TESTING MESSAGE -- REMOVE LATER
        echo "<div id=\"betamessage\">";
        echo "This site is still being tested, and is subject to change at any time. Your data may disappear.";
        echo "</div>";
        // END BETA TESTING MESSAGE -- REMOVE LATER

        // Logo
        echo "<div><img id=\"logo\" src=\"img/logo.png\"></div>";

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