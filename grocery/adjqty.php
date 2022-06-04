<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
}

    // CSS
    echo "<link rel=\"stylesheet\" href=\"adjqty.css\">";
    // Home Link
    echo "<a href=\"index.php\">Home</a><hr><hr><hr>";

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
    echo "<table style=\"font-size: 12pt;\">";

    // Headers
    echo "<tr>";
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
        $color = "#00ff00";
        if($qty_goal > $qty){
            $color = "#ffff00";
            if($qty == 0){
                $color = "#ff4242";
            }
        }
        // create row
        echo "<tr style=\"background-color: ".$color.";\">";

        // product name (cell 1)
        if($name == ''){
            echo "<td style=\"text-align: left;\"><p>".$upc."</p></td>";
        }else{
            // Show upc instead if name is blank
            echo "<td style=\"text-align: right;\"><p>".$name."</p></td>";
        }

        // in inventory (cell 2)
        echo "<td><p>".$qty."</p></td>";

        // desired amount (cell 3)
        echo "<td><input style=\"font-size: 16pt;\" name=\"".$upc."\" type=\"number\" value=".$qty_goal." min=\"0\" max=\"9999\" step=\"1\"></td>";
        echo "</tr>";
    }

    // Submit button row
    echo "<tr style=\"background-color:#8888ff; text-align: center;\">";
    echo "<td colspan=\"2\"></td><td>";
    echo "<input type=\"submit\">";
    echo "</td></tr>";

    echo "</table>";
    echo "</form>";
    $conn->close();

?>