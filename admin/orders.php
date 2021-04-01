<!-- Do like edit page and include ordersAll.php if viewOrder !isset, else include orderDetails.php -->
<?php


if (isset($viewOrder)) {
    include "orderDetails.php";
}
else if (!isset($viewOrder)){
    include "ordersAll.php";
}

?>