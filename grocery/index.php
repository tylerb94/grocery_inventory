<?php
    // redirect to login page if no cookie
    if(!isset($_COOKIE["username"])){
        header("Location: login.php");
        die();
    
    // Cookie exists. user is logged in
    }else{

        // CSS / JS
        echo "<link rel=\"stylesheet\" href=\"index.css\">";
        echo " <script src=\"js/donothing.js\"></script> ";

        echo "<form method=\"POST\">";
        include "pageparts/header_1.php";
        include "pageparts/upcentry.php";
        include "pageparts/shoppinglistlink.php";
        echo "</form>";
        
    }
?>