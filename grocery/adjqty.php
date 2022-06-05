<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // CSS
    echo "<link rel=\"stylesheet\" href=\"adjqty.css\">";
    
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

    // Save edited data (if submit button pushed)
    foreach($_POST as $key => $value){
        $sql = "UPDATE ".$_COOKIE["username"]." SET qty_goal=\"".$value."\" WHERE upc=\"$key\";";
        $conn->query($sql);
    }

    // Create adjustable table from inventory items
    $search = $conn->query("SELECT * FROM ".$_COOKIE["username"]." WHERE `upc`");
    echo "<form action=\"adjqty.php\" method=\"POST\">";
    echo "<table id=\"producttable\" style=\"font-size: 12pt;\">";

    // Headers
    echo "<tr>";
    echo "<th></th>";
    echo "<th>Product Name</th>";
    echo "<th>In inventory</th>";
    echo "<th>Desired Amount</th>";
    echo "</tr>";

    while($result=$search->fetch_row()){
        $name = $result[3];
        $qty = $result[1];
        $qty_goal = $result[2];
        $upc = $result[0];

        // quantity level color. decide green, yellow, or red
        $color = "#008800";
        if($qty_goal > $qty){
            $color = "#ffff00";
            if($qty == 0){
                $color = "#ff4242";
            }
        }
        // create row
        echo "<tr style=\"background-color: ".$color.";\">";

        // delete button
        echo "<td id=\"deletebutton\" style=\"background-color: rgb(23, 26, 29);\">";
        echo "<input type=\"image\" value=\"\" src=\"ico/remove.png\">";
        echo "</td>";
        // product name (cell 1)
        if($name == ''){
            echo "<td style=\"text-align: left;\"><a id=\"item\" href=\"details.php?upc=".$upc."\" target=\"_blank\">".$upc."</a></td>";
        }else{
            // Show upc instead if name is blank
            echo "<td style=\"text-align: right;\"><a id=\"item\" href=\"details.php?upc=".$upc."\" target=\"_blank\"> ".$name."</a></td>";
        }

        // in inventory (cell 2)
        echo "<td><p>".$qty."</p></td>";

        // desired amount (cell 3)
        echo "<td><input id=\"spinbox\" style=\"font-size: 16pt;\" name=\"".$upc."\" type=\"number\" value=".$qty_goal." min=\"0\" max=\"9999\" step=\"1\"></td>";
        echo "</tr>";
    }

    // Submit button row
    echo "<tr style=\"background-color:#8888ff; text-align: center;\">";
    echo "<td colspan=\"2\"></td><td>";
    echo "<input type=\"submit\" value=\"Update\">";
    echo "</td></tr>";

    echo "</table>";
    echo "</form>";
    $conn->close();

?>