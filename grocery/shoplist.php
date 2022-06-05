<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // CSS
    echo "<link rel=\"stylesheet\" href=\"shoplist.css\">";
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

    echo "<hr>";

    // Connect to SQL
    $server = "localhost";
    $username = "root";
    $password = "et-1331g";
    $database = "grocery";
    $conn = new mysqli($server, $username, $password, $database);

    $sql = "SELECT * FROM ".$_COOKIE["username"]." WHERE `upc`;";
    $search = $conn->query($sql);

    // start building table
    echo "<table id=\"producttable\">";

    while($result=$search->fetch_row()){

        // Grab relevant data
        $qty = $result[1];
        $qty_goal = $result[2];

        // check if any of product is below desired amount
        $needed = strval($qty_goal - $qty);
        if($needed > 0){

            // Grab relevant data
            $upc = $result[0];
            $name = $result[3];
            $img_url = $result[5];

            // link to info about item
            $item_url = "details.php?upc=".$upc;

            //put dashes in upc
            $upc_dashed = $upc[0]." - ".$upc[1].$upc[2].$upc[3].$upc[4].$upc[5]."\n".$upc[6].$upc[7].$upc[8].$upc[9].$upc[10]." - ".$upc[11];

            // Start row
            echo "<tr id=\"item\">";

            // Checkbox / qty / text
            echo "<td><input id=\"check\" type=\"checkbox\"></td>";
            echo "<td>".$needed."x&nbsp;</td>";
            echo "<td>".$name."</td>";
            // image
            //echo "<td><img id=\"shoplistimg\" src=\"".$img_url."\" style=\"width:150px;\"></td>";
            // upc
            echo "<td><a id=\"upc\" href=\"".$item_url."\" target=\"_blank\">[INFO]</a></td>";

            // End row
            echo "</tr>";
        }
        
    }

    // End table
    echo "</table>";

    $conn->close();

?>