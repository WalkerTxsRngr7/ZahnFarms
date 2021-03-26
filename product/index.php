<?php
session_start();
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";
include '../models/requests.php';

if (!isset($catID)){
    include "categories.php";
}
else if (!isset($prodID)) {
    include "products.php";
}
else {
    include "product.php";
}



include "../views/footer.php";
?>
