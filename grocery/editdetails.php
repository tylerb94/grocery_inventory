<?php

    if(!isset($_COOKIE["username"])){
        header("Location: login.php");
        die();
    }else{
    }

    // CSS
    echo "<link rel=\"stylesheet\" href=\"editdetails.css\">";
    // Home Link
    echo "<a id=\"homebutton\" href=\"index.php\">Home</a><hr><hr><hr>";


    if($_POST['upc'] != ''){


        // Connect to SQL
        $server = "localhost";
        $username = "root";
        $password = "et-1331g";
        $database = "grocery";
        $conn = new mysqli($server, $username, $password, $database);
        
        $upc = $_POST["upc"];
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $image = $_POST["image"];

        $sql = "UPDATE ".$_COOKIE["username"]." SET";
        $sql = $sql." upc = \"".$upc."\", name = \"".$name."\", description = \"".$desc."\", image = \"".$image."\"";
        $sql = $sql." WHERE upc = \"".$upc."\"";
        $conn->query($sql);
        $conn->close();

        echo "Updated: ".$name;

    }else if($_GET["upc"] != ''){

        // Connect to SQL
        $server = "localhost";
        $username = "root";
        $password = "et-1331g";
        $database = "grocery";
        $conn = new mysqli($server, $username, $password, $database);
        $upc = $_GET["upc"];
        $sql = "SELECT * FROM ".$_COOKIE["username"]." WHERE `upc` = \"".$upc."\";";
        $search = $conn->query($sql);
        $result = $search->fetch_row();

        $name = $result[3];
        $desc = $result[4];
        $image = $result[5];

        echo "<form method=\"POST\">";
        echo "<table>";

        echo "<tr><td><p>UPC</p></td><td align=\"left\"><input name=\"upc\" type=\"text\" value=\"".$upc."\"></input></tr></td>";
        echo "<tr><td><p>Name</p></td><td align=\"left\"><input name=\"name\" type=\"text\" value=\"".$name."\"></input></tr></td>";
        echo "<tr><td><p>Description</p></td><td align=\"left\"><input name=\"desc\" type=\"text\" value=\"".$desc."\"></input></tr></td>";
        echo "<tr><td><p>Image Link</p></td><td align=\"left\"><input name=\"image\" type=\"text\" value=\"".$image."\"></input></tr></td>";
        
        echo "<tr><td></td><td><input type=\"submit\"></td></tr>";
        echo "</table>";
        echo "</form>";

    }else{
        echo "UPC not found.";
    }

?>