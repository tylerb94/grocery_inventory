<?php

    // redirect to login page if no cookie
    if(!isset($_COOKIE["username"])){
        header("Location: login.php");
        die();
    

    // Cookie exists. user is logged in
    }else{

        // Disable enter key
        echo "<script>";
        echo "function disableEnterKey(e){ ";    
        echo "var key; ";
        echo "if(window.event){ ";
        echo "key = window.event.keyCode;";
        echo "} else {";
        echo "key = e.which; ";     
        echo "}";
        echo "if(key == 13){";
        echo "return false;";
        echo "} else {";
        echo "return true; ";
        echo "}"; 
        echo "} ";
        echo "</script>";

        // CSS
        echo "<link rel=\"stylesheet\" href=\"index.css\">";

        // Start form
        echo "<form method=\"POST\" action=\"index.php\">";

        // Top bar
        echo "<table>";
        echo "<tr>";
        echo "<td><a href=\"settings.php\"><img src=\"ico/settings.png\" width=\"60px\"></a></td>";   // settings button
        echo "<td>Logged in as ".$_COOKIE["username"]."</td>";
        echo "<td><a href=\"logout.php\"><img src=\"ico/exit.png\" width=\"60px\"></a></td>";       // logout button
        echo "</tr>";
        echo "</table>";

        // UPC entry bar
        echo "<table>";
        echo "<tr>";
        echo "<td ><input name=\"upc\" type=\"text\" placeholder=\"Enter UPC\" onkeypress=\"return disableEnterKey(event)\"></td>";
        // add new inventory button
        echo "<td><a><input id=\"name\" type=\"image\" src=\"ico/add.png\" name=\"add\" value=\"\" formaction=\"scannew.php\"></a></td>";
        // remove used inventory button
        echo "<td><a><input id=\"name\" type=\"image\" src=\"ico/remove.png\" name=\"remove\" value=\"\" formaction=\"scanused.php\"></a></td>";
        // search UPC button
        echo "<td><a><input id=\"name\" type=\"image\" src=\"ico/search.png\" name=\"search\" value=\"\" formaction=\"details.php\"></a></td>";
        echo "</tr>";
        echo "</table>";

        // shoping list button
        echo "<table>";
        echo "<tr><td></td></tr>";
        echo "<tr><td><input id=\"shoplistbutton\" formaction=\"shoplist.php\" type=\"submit\" value=\"Shopping List\"></td></tr>";
        echo "</table>";
        echo "</form>";
        
    }
?>