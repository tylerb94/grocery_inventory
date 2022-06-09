<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // Connect to grocery database
    include "pageparts/connectgrocery.php";

    // Set everything in inventory to qty=0
    $search = $conn->query("SELECT * FROM ".$_COOKIE["username"]." WHERE `upc`");
    echo "WORKING...";
    while($result=$search->fetch_row()){
        echo "WORKING...";
        $upc = $result[0];
        $sql = "UPDATE ".$_COOKIE["username"]." SET qty = \"0\" WHERE `upc`=\"".$upc."\"";
        $conn->query($sql);
    }
    $conn->close();

    // CSS
    echo "<link rel=\"stylesheet\" href=\"audit.css\">";

    // Top bar
    echo "<table id=\"producttable\">";
    echo "<tr>";
    echo "<td><a href=\"settings.php\"><img src=\"ico/settings.png\" width=\"60px\"></a></td>";   // settings button
    echo "<td>Logged in as ".$_COOKIE["username"]."</td>";
    echo "<td><a href=\"logout.php\"><img src=\"ico/exit.png\" width=\"60px\"></a></td>";       // logout button
    echo "</tr>";
    // Home Link
    echo "<tr><td colspan=\"3\" align=\"left\">";
    echo "<a id=\"homebutton\" href=\"index.php\">Home</a>";
    echo "</td></tr>";
    echo "</table>";

    echo "</table>";
    // Home Link
    
    // UPC Textbox
    echo "<form action=\"scannew.php\" method=\"POST\">";
    echo "<input type=\"text\" name=\"upc\" placeholder=\"Rescan ALL Items - Scan UPC\" autofocus>";
    echo "</form>";

?>