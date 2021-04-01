<?php

if (!isset($catID) || (isset($catID) && isset($edit)) || (isset($catID) && isset($modify))){
    include "categories.php";
}
else if (!isset($prodID) && !isset($modify)) {
    include "products.php";
}
else {
    include "product.php";
}

?>