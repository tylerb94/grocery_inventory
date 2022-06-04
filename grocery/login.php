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
            header("Location: createaccount.php");
            die();
        }else{
            if(password_verify($_POST["password"], $search[1])){
                setcookie("username", $_POST["username"], time() + (86400 * 365), "/");
                header("Location: index.php");
                die();
            }
        }

    }else{
        echo "<form method=\"POST\" action=\"login.php\">";

        echo "<label for=\"username\">Username</label>";
        echo "<input name=\"username\"type=\"text\">";
        echo "<br>";
    
        echo "<label for=\"password\">Password</label>";
        echo "<input name=\"password\" type=\"password\">";
        echo "<br>";
        
        echo "<input type=\"submit\" href=\"\">";
    
        echo "</form>";
    }

    

?>