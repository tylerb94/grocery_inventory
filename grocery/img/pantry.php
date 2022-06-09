<?php
echo "<table>";
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
    echo "<td style=\"background-color: rgb(23, 26, 29);\">";
    echo "<input type=\"image\" value=\"\" src=\"ico/remove.png\" formaction=\"adjqty.php?del=".$upc."\">";
    echo "</td>";
    // product name (cell 1)
    if($name != ''){
        echo "<td style=\"text-align: right;\"><a href=\"details.php?upc=".$upc."\" target=\"_blank\"> ".$name."</a></td>";
    }else{
        
        // Show upc instead if name is blank
        // align UPC codes to the left
        echo "<td style=\"text-align: left;\"><a href=\"details.php?upc=".$upc."\" target=\"_blank\">".$upc."</a></td>";
    }

    // in inventory (cell 2)
    echo "<td><p>".$qty."</p></td>";

    // desired amount (cell 3)
    echo "<td><input name=\"".$upc."\" type=\"number\" value=".$qty_goal." min=\"0\" max=\"9999\" step=\"1\"></td>";
    echo "</tr>";
}
// Submit button row
echo "<tr>";
echo "<td colspan=\"2\"></td><td>";
echo "<input type=\"submit\" value=\"Update\">";
echo "</td></tr>";
echo "</table>";
?>