<?php
$catID = filter_input(INPUT_GET, "catID");
$prodID = filter_input(INPUT_GET, "prodID");
$prodName = filter_input(INPUT_GET, "productName");
$qty = filter_input(INPUT_POST, "qty");
$sizeName = filter_input(INPUT_POST, "size");
$addToCart = filter_input(INPUT_POST, "addToCart");
$order = filter_input(INPUT_GET, "order");
$customerName = filter_input(INPUT_GET, "customerName");
?>