<?php

    if($_POST["username"] != ''){

        // Connect to SQL
        $server = "localhost";
        $username = "root";
        $password = "et-1331g";
        $database = "users";
        $conn = new mysqli($server, $username, $password, $database);

        $sql = "SELECT * FROM login WHERE username=\"".$_POST["username"]."\";";
        $search = $conn->query($sql)->fetch_row();

        if($search == ""){

            // Create a new user account
            $hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $sql = "INSERT INTO login (username, password) VALUES (\"".$_POST["username"]."\", \"".$hashed."\");";
            $conn->query($sql);
            setcookie("username", $_POST["username"], time() + (86400 * 30), "/");


            // Create new table
            $sql = "CREATE TABLE `".$_POST["username"]."` (
                `upc` varchar(20) COLLATE 'utf8mb4_general_ci' NOT NULL,
                `qty` int(11) NOT NULL,
                `qty_goal` int(11) NOT NULL,
                `name` varchar(99) COLLATE 'utf8mb4_general_ci' NOT NULL,
                `description` varchar(999) COLLATE 'utf8mb4_general_ci' NOT NULL,
                `image` varchar(999) COLLATE 'utf32_general_ci' NOT NULL
              ) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';";
            conn.query($sql);
            
            header("Location: index.php");
            die();

        }else{
            echo "This username is already taken.";
        }

    }else{
        echo "<form method=\"POST\" action=\"createaccount.php\">";

        echo "<label for=\"username\">Username</label>";
        echo "<input name=\"username\"type=\"text\">";
        echo "<br>";

        echo "<label for=\"password\">Password</label>";
        echo "<input name=\"password\" type=\"password\">";
        echo "<br>";
        
        echo "<input type=\"submit\" href=\"\" value=\"Sign Up\">";

        echo "</form>";
    }

?>