<?php

if(!isset($_COOKIE["username"])){
    header("Location: login.php");
    die();
}else{

    // Connect to grocery database
    include "pageparts/connectgrocery.php";

    // Save edited data (if submit button pushed)
    foreach($_POST as $key => $value){
        $sql = "UPDATE ".$_COOKIE["username"]." SET qty_goal=\"".$value."\" WHERE upc=\"$key\";";
        $conn->query($sql);
    }

    // delete item if delete button clicked
    if($_GET["del"] != ''){
        $upc = $_GET["del"];
        $sql = "DELETE FROM `".$_COOKIE["username"]."` WHERE `upc`='".$upc."';";
        $conn->query($sql);
    }

    // CSS
    echo "<link rel=\"stylesheet\" href=\"adjqty.css\">";

    // Header 2
    include "pageparts/header_2.php";

    // Create pantry Table
    $search = $conn->query("SELECT * FROM ".$_COOKIE["username"]." WHERE `upc`");
    echo "<form action=\"adjqty.php\" method=\"POST\">";
    include "pageparts/pantry.php";
    echo "</form>";

    // Close connection
    $conn->close();

}
?>