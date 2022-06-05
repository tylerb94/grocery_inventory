<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // CSS
    echo "<link rel=\"stylesheet\" href=\"populate.css\">";
    // Top bar
    echo "<table>";
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
    // Connect to SQL
    $server = "localhost";
    $username = "root";
    $password = "et-1331g";
    $database = "grocery";
    $conn = new mysqli($server, $username, $password, $database);

    foreach($_POST as $key => $value){
        $sql = "";
        $key = explode("_", $key);
        $upc = $key[0];
        $key = $key[1];
        $sql = $sql."UPDATE ".$_COOKIE["username"]." SET ".$key."=\"".$value."\" WHERE upc=\"".$upc."\";";
        $conn->query($sql);

    }
    
    $search = $conn->query("SELECT * FROM ".$_COOKIE["username"]." WHERE `name`=\"\" OR `image`=\"\"");

    echo "<form action=\"populate.php\" method=\"POST\">";
    echo "<table id=\"producttable\" style=\"font-size: 16pt;\">";
    echo "<thead><tr>";
    echo "<th>UPC</th>";
    echo "<th>Name</th>";
    echo "<th>Image Link</th>";
    echo "</tr></thead>";
    $count = 0;
    while($result=$search->fetch_row()){

        $upc = $result[0];
        $item_url = "https://www.upcitemdb.com/upc/".$upc;

        $name = $result[3];
        $image = $result[5];

        echo "<tr>";

        // UPC link
        echo "<td><a href=\"".$item_url."\" target=\"_blank\">".$upc."</a></td>";

        // Name textbox
        echo "<td><input type=\"text\" name=\"".$upc."_name\" value=\"".$name."\"></td>";

        // Image link textbox
        echo "<td><input type=\"text\" name=\"".$upc."_image\" value=\"".$image."\"></td>";
        echo "</tr>";
        $count++;
        

    }
    if($count == 0){
        echo "<p>No blank item names to fix right now.</p>";
    }
    echo "</table>";
    echo "<input type=\"submit\">";
    echo "</form>";


    $conn->close();
    

?>
