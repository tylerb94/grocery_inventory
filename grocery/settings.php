<?php
    // redirect to login page if no cookie
    if(!isset($_COOKIE["username"])){
        header("Location: login.php");
        die();

    // settings page
    }else{

        // CSS
        echo "<link rel=\"stylesheet\" href=\"settings.css\">";
        include "pageparts/header_2.php";
        include "pageparts/settingsmenu.php";

    }
?>