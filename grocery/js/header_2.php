<?php
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
?>