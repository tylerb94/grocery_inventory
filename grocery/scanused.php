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

    // CHECK IF UPC WAS SCANNED
    $upc = $_POST['upc'];
    if($upc != ""){
    
        // Connect to SQL
        $server = "localhost";
        $username = "root";
        $password = "et-1331g";
        $database = "grocery";
        $conn = new mysqli($server, $username, $password, $database);

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