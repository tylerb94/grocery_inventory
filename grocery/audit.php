<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // Connect to SQL
    $server = "localhost";
    $username = "root";
    $password = "et-1331g";
    $database = "grocery";
    $conn = new mysqli($server, $username, $password, $database);

    // Set everything in inventory to qty=0
    $search = $conn->query("SELECT * FROM ".$_COOKIE["username"]." WHERE `upc`");
    while($result=$search->fetch_row()){
        $upc = $result[0];
        $sql = "UPDATE ".$_COOKIE["username"]." SET qty = \"0\" WHERE `upc`=\"".$upc."\"";
        $conn->query($sql);
    }
    $conn->close();

    // CSS
    echo "<link rel=\"stylesheet\" href=\"style.css\">";
    // Home Link
    echo "<a href=\"index.php\">Home</a><hr><hr><hr>";

    // UPC Textbox
    echo "<form action=\"scannew.php\" method=\"POST\">";
    echo "<input type=\"text\" name=\"upc\" placeholder=\"Rescan ALL Items - Scan UPC\" autofocus>";
    echo "</form>";

?>