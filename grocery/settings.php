<?php
    // redirect to login page if no cookie
    if(!isset($_COOKIE["username"])){
        header("Location: login.php");
        die();

    // settings page
    }else{

        // CSS
        echo "<link rel=\"stylesheet\" href=\"settings.css\">";

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

        echo "<table>";
        // Adjust Pantry
        echo "<tr>";
        echo "<td><a id=\"linkbutton\" href=\"adjqty.php\">Adjust Pantry</a></td>";
        echo "</tr>";
        // Fill Missing Data
        echo "<tr>";
        echo "<td><a id=\"linkbutton\" href=\"populate.php\">Fill Missing Data</a></td>";
        echo "</tr>";
        // Audit inventory
        echo "<tr>";
        echo "<td><a id=\"linkbutton\" href=\"audit.php\" style=\"background-color: red;\">Audit Inventory</a></td>";
        echo "</tr>";

        echo "<table>";

    }
?>