<?php
echo "<table>";
echo "<tr>";
echo "<td ><input name=\"upc\" type=\"text\" placeholder=\"Enter UPC\" onkeypress=\"return disableEnterKey(event)\"></td>";
// add new inventory button
echo "<td><a><input id=\"name\" type=\"image\" src=\"ico/add.png\" name=\"add\" value=\"\" formaction=\"scannew.php\"></a></td>";
// remove used inventory button
echo "<td><a><input id=\"name\" type=\"image\" src=\"ico/remove.png\" name=\"remove\" value=\"\" formaction=\"scanused.php\"></a></td>";
// search UPC button
echo "<td><a><input id=\"name\" type=\"image\" src=\"ico/search.png\" name=\"search\" value=\"\" formaction=\"details.php\"></a></td>";
echo "</tr>";
echo "</table>";
?>