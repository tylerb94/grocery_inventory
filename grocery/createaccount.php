<?php

    // entry from form
    if($_POST["username"] != ''){

        // Connect to login database
        include "pageparts/connectlogin.php";

        $sql = "SELECT * FROM login WHERE username=\"".$_POST["username"]."\";";
        $search = $conn->query($sql)->fetch_row();

        if($search == ""){

            // Create a new user account
            $hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $c_hashed = password_hash($_POST["c_password"], PASSWORD_DEFAULT);

            // if passwords are blank
            if($_POST["password"] == "" or $_POST["password"] == ""){
                echo "Password cannot be blank.";
            }
            // if passwords do not match
            else if($_POST["password"] != $_POST["c_password"]){
                echo "Passwords do not match.";

            // passwords match. create account and go to index.php
            }else{

                $sql = "INSERT INTO login (username, password) VALUES (\"".$_POST["username"]."\", \"".$hashed."\");";
                $conn->query($sql);
                $conn->close();

                include "pageparts/connectgrocery.php";
                setcookie("username", $_POST["username"], time() + (86400 * 365), "/");


                // Create new table
                $sql = "CREATE TABLE `".$_POST["username"]."` (
                    `upc` varchar(20) COLLATE 'utf8mb4_general_ci' NOT NULL,
                    `qty` int(11) NOT NULL,
                    `qty_goal` int(11) NOT NULL,
                    `name` varchar(99) COLLATE 'utf8mb4_general_ci' NOT NULL,
                    `description` varchar(999) COLLATE 'utf8mb4_general_ci' NOT NULL,
                    `image` varchar(999) COLLATE 'utf32_general_ci' NOT NULL
                ) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';";
                echo $sql;
                $conn->query($sql);

                header("Location: index.php");
                die();
            }

        }else{
            echo "This username is already taken.";
        }

    // entry from login page
    }else{

        echo "<link rel=\"stylesheet\" href=\"login.css\">";

        // Logo
        echo "<div><img id=\"logo\" src=\"img/logo.png\"></div>";

        echo "<form method=\"POST\" action=\"createaccount.php\">";

        // Username textbox
        $username = "";
        if(isset($_GET["username"])){
            $username = $_GET["username"];
            echo "<p id=\"makeaccountmessage\">Username does not exist. Sign up to continue.<p>";}
        echo "<table><tr id=\"formlabel\">";
        echo "<td><label for=\"username\">Username</label></td>";
        echo "<td><input name=\"username\"type=\"text\" value=\"".$username."\"></td>";
        echo "</tr>";
        
        // Password textbox
        echo "<tr id=\"formlabel\">";
        echo "<td><label for=\"password\">Password</label></td>";
        echo "<td><input name=\"password\" type=\"password\"></td>";
        echo "</tr>";

        // Password textbox
        echo "<tr id=\"formlabel\">";
        echo "<td><label for=\"c_password\">Confirm Password</label></td>";
        echo "<td><input name=\"c_password\" type=\"password\"></td>";
        echo "</tr>";
        
        // login button
        echo "<tr><td colspan=\"2\" align=\"center\">";
        echo "<input type=\"submit\" href=\"\" value=\"Create New Account\">";
        echo "</td></tr>";
        echo "<table>";
    
        echo "</form>";
    }

?>