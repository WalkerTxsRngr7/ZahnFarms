<!-- Choose location first -->
<!-- Locations: 
Springfield: Sam's Club E. Sunshine. Wednesday 4-4:30PM.  Monday latest for same Wednesday delivery
Marshfield: Farmer's Market, ...address... Friday 2:30-6:30PM.  Wednesday latest for this Friday delivery
Farm in Elkland: 9018 St Hwy W, Elkland, MO Mon-Sat by appt. Call or email.
 -->

 <!-- If unknownPounds or unknown total pay all at once at pickup. -->



 <?php
session_start();
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";
include '../models/requests.php';

echo"<div class='content-container'>";
// $cat = catByID($catID);
$prod = prodByID($prodID);
if ($prod['sizeID'] != null) {
    $size = sizeByName($sizeName, $prod['sizeID']);
    echo "<h1>" . $size['sizeName'] . "</h1>";
}
?>



<?php
echo"</div>";

include "../views/footer.php";
?>