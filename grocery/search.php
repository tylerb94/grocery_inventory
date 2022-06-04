<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // CSS
    echo "<link rel=\"stylesheet\" href=\"style.css\">";
    // Home Link
    echo "<a href=\"index.php\">Home</a><hr><hr><hr>";

    // UPC Textbox
    echo "<form action=\"details.php\" method=\"GET\">";
    echo "<input type=\"text\" name=\"upc\" placeholder=\"Search UPC\" autofocus>";
    echo "</form>";

?>