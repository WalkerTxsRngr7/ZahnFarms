<?php
session_start();
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";
include '../models/requests.php';

echo"<div class='content-container'>";

if (!isset($catID)){
    include "categories.php";
}
else if (!isset($prodID)) {
    include "products.php";
}
else {
    include "product.php";
}

echo"</div>";

include "../views/footer.php";
?>
