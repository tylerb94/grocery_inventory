<?php

    // CSS
    echo "<link rel=\"stylesheet\" href=\"style.css\">";

    if(!isset($_COOKIE["username"])){
        header("Location: login.php");
        die();
    }else{
        // App buttons
        echo "<button id=\"shoplist\" onclick=\"location.href='populate.php'\" type=\"button\">Fill Info</button>";
        echo "<button id=\"shoplist\" onclick=\"location.href='adjqty.php'\" type=\"button\">Adjust Inventory</button>";
        echo "<button id=\"shoplist\" onclick=\"location.href='shoplist.php'\" type=\"button\">Shopping List</button>";
        echo "<button id=\"scannew\" onclick=\"location.href='scannew.php'\" type=\"button\">Scan New</button>";
        echo "<button id=\"scanused\" onclick=\"location.href='scanused.php'\" type=\"button\">Scan Used</button>";
        echo "<button id=\"audit\" onclick=\"location.href='audit.php'\" type=\"button\">AUDIT INVENTORY</button>";
    }

    
?>