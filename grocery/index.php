<?php
    $found_account = false;
    // if username is set in cookie
    if(isset($_COOKIE["username"])){

        // make sure user exists in database
        include "pageparts/connectlogin.php";
        $search = $conn->query("SELECT `username` FROM `login` WHERE `username`=\"".$_COOKIE["username"]."\";");
        while($result=$search->fetch_row()){
            if($result[0] == $_COOKIE["username"]){
                $found_account = true;

                // Username exists. load page
                // CSS / JS
                echo "<link rel=\"stylesheet\" href=\"index.css\">";
                echo "<script src=\"js/donothing.js\"></script> ";

                echo "<form method=\"POST\">";
                include "pageparts/header_1.php";
                include "pageparts/upcentry.php";
                include "pageparts/shoppinglistlink.php";
                echo "</form>";
            }
        }
        $conn.close();
    }
    //
    if($found_account == false){
        echo "account not found";
        header("Location: login.php");
        die();
    }
?>