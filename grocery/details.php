<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // CSS
    echo "<link rel=\"stylesheet\" href=\"details.css\">";
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


    if($_POST["upc"] != '' or $_GET["upc"] != ''){
        
        // Connect to grocery database
        include "pageparts/connectgrocery.php";

        $upc = $_POST["upc"].$_GET["upc"];
        $sql = "SELECT * FROM ".$_COOKIE["username"]." WHERE `upc` = \"".$upc."\";";
        $search = $conn->query($sql);
        $result = $search->fetch_row();

        $qty = $result[1];
        $qty_goal = $result[2];
        $name = $result[3];
        $desc = $result[4];
        $image = $result[5];

        /*echo "<br>".$result[0];
        echo "<br>".$result[1];
        echo "<br>".$result[2];
        echo "<br>".$result[3];
        echo "<br>".$result[4];
        echo "<br>".$result[5];*/

        echo "<table id=\"details\">";

        // item name
        echo "<tr>";
        echo "<td><p id=\"itemname\">".$name."</p></td></tr>";

        // quantity
        echo "<tr><td><p id=\"stock\">".$qty."/".$qty_goal."</p></td>";
        echo "</tr>";

        // image
        echo "<tr>";
        echo "<td align=\"center\"><img id=\"image\" src=\"".$image."\"></td>";
        echo "</tr>";

        // description
        echo "<tr>";
        echo "<td><p id=\"desc\">".$desc."\"<p></td>";
        echo "</tr>";

        // UPC
        echo "<tr><td align=\"center\">";
        $barcode = "https://barcode.tec-it.com/barcode.ashx?data=".$upc."&code=UPCA";
        echo "<img id=\"barcode\" src=\"".$barcode."\">";
        echo "</td></tr>";

        echo "<tr><td><a href=\"editdetails.php?upc=".$upc."\">Edit Details</a></td></tr>";

        echo "</table>";


        

    }else{
        echo "UPC not found.";
    }

?>