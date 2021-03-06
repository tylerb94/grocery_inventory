<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // CSS
    echo "<link rel=\"stylesheet\" href=\"scannew.css\">";
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

    // CHECK IF UPC WAS SCANNED
    $upc = $_POST['upc'];
    if($upc != ""){
    
        // Connect to grocery database
        include "pageparts/connectgrocery.php";

        // Check if UPC is on table
        $search = $conn->query("SELECT * FROM ".$_COOKIE["username"]." WHERE `upc`=\"".$upc."\"");
        $result = $search->fetch_row();

        if($result != ""){

            // If upc is in inventory
            $qty = $result[1];
            $qty -= 1;
            if($qty<0){$qty=0;}

            $sql = "UPDATE ".$_COOKIE["username"]." SET qty = ".$qty." WHERE `upc`=\"".$upc."\"";
            $conn->query($sql);
            $name = $result[2];
            if($name == ''){$name="UNKNOWN ITEM NAME";}
            echo "<p>Item Found. Decreasing Quantity by 1</p><p>".$name."</p>";
        }else{
            $sql = "INSERT INTO ".$_COOKIE["username"]." (`upc`, `qty`, `qty_goal`, `name`, `description`, `image`) VALUES (\"".$upc."\", \"0\", \"1\", \"".""."\", \"".""."\", \"".""."\")";
            echo "<p>Added unknown item to inventory.</p>";
            $conn->query($sql);
        }

        $conn->close();
    }

    // UPC Textbox
    echo "<form action=\"scanused.php\" method=\"POST\">";
    echo "<input type=\"text\" name=\"upc\" placeholder=\"Remove Item - Scan UPC\" autofocus>";
    echo "</form>";

?>