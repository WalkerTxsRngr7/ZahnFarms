<?php

if (isset($prodID)) {
    include "product.php";
} else if (!isset($catID) || (isset($catID) && isset($edit)) || (isset($catID) && isset($modify))){
    include "categories.php";
}
else if (!isset($prodID) && !isset($modify)) {
    include "products.php";
}


?>