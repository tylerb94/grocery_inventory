<?php
// Top bar
echo "<table>";
echo "<tr>";
echo "<td><a href=\"settings.php\"><img src=\"ico/settings.png\" width=\"60px\"></a></td>";   // settings button
echo "<td>Logged in as ".$_COOKIE["username"]."</td>";
echo "<td><a href=\"logout.php\"><img src=\"ico/exit.png\" width=\"60px\"></a></td>";       // logout button
echo "</tr>";
echo "</table>";
?>