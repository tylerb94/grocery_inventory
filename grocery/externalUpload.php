<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{
    include "pageparts/connectgrocery.php";
    $username = $_COOKIE["username"];

    $upc = $_GET["upc"];
    $image = $_GET["image"];
    $qty = "0";
    $qty_goal = "1";


    $name = $_GET["name"];
    $name = explode(",", $name);
    $name = implode("\,", $name);
    $name = explode("\"", $name);
    $name = implode("\\\"", $name);

    $description = $_GET["description"];
    $description = explode(",", $description);
    $description = implode("\,", $description);
    $description = explode("\"", $description);
    $description = implode("\\\"", $description);

    echo $description."<br><br>";

    // Check if UPC is on table
    $search = $conn->query("SELECT * FROM ".$_COOKIE["username"]." WHERE `upc`=\"".$upc."\"");
    $result = $search->fetch_row();

    if($result==""){

        $sql = "INSERT INTO ".$username." (`upc`, `qty`, `qty_goal`, `name`, `description`, `image`)";
        $sql = $sql." VALUES (\"".$upc."\", \"".$qty."\", \"".$qty_goal."\", \"".$name."\", \"".$description."\", \"".$image."\");";
        $conn->query($sql);
    }
    $conn->close();
    echo "<script>window.close();</script>";
}
    
?>
