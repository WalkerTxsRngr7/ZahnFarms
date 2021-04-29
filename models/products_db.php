<?php

/** RETURN AN ARRAY OF ALL CATEGORIES */
function getAllCategories(){
    global $db;
    $sql = "SELECT * FROM categories";
    $qry = $db->query($sql);
    $aryCat = $qry->fetchAll();

    return $aryCat;
}

/** RETURN AN ARRAY OF ALL CATEGORIES TO BE SHOWN*/
function getAllCategoriesShow(){
    global $db;
    $sql = "SELECT * FROM categories WHERE hide = 0";
    $qry = $db->query($sql);
    $aryCat = $qry->fetchAll();

    return $aryCat;
}

/** RETURN A SINGLE CATEGORY FILTERED BY CATEGORY ID */
function catByID($catID){
    global $db;
    $sql = "SELECT * FROM categories WHERE catID = $catID";
    $qry = $db->query($sql);
    $cat = $qry->fetch();
    return $cat;
}

/** RETURN AN ARRAY OF ALL PRODUCTS */
function getAllProducts(){
    global $db;
    $sql = "SELECT * FROM products";
    $qry = $db->query($sql);
    $aryProd = $qry->fetchAll();

    return $aryProd;
}

/** RETURN AN ARRAY OF ALL PRODUCTS FROM CATEGORY */
function productsByCatID($catID){
    global $db;
    $sql = "SELECT * FROM products WHERE catID = $catID";
    $qry = $db->query($sql);
    $aryProd = $qry->fetchAll();

    return $aryProd;
}

/** RETURN A SINGLE PRODUCT FILTERED BY PRODUCT ID */
function prodByID($prodID){
    global $db;
    $sql = "select * from products where productID = $prodID";
    
    $qry = $db->query($sql);
    $product = $qry->fetch();

    //return a product
    return $product;
}

function sizesByID($sizeID) {
    global $db;

    $sql = "SELECT * FROM sizes WHERE sizeID = $sizeID";
    $qry = $db->query($sql);
    $sizes = $qry->fetchAll();

    //return a size
    return $sizes;
}

function sizeByName($sizeName, $sizeID) {
    global $db;

    $sql = "SELECT * FROM `sizes` WHERE `sizeName`= \"$sizeName\" AND `sizeID`= $sizeID";
    $qry = $db->query($sql);
    $size = $qry->fetch();

    //return a size
    return $size;
}

/** RETURN AN ARRAY OF ALL PORTIONS */
function getAllPortions(){
    global $db;
    $sql = "SELECT * FROM portions";
    $qry = $db->query($sql);
    $aryPortions = $qry->fetchAll();

    return $aryPortions;
}
/** RETURN A SINGLE PORTION FILTERED BY PORTION ID */
function portionByID($portionID){
    global $db;

    $sql = "SELECT * FROM `portions` WHERE `portionsID` = $portionID";
    $qry = $db->query($sql);
    $portion = $qry->fetch();

    //return a portion
    return $portion;
}

// create new sizes when creating product with sizes
function addSizes($sizesAry){
    global $db;
    $sql = "SELECT MAX(sizeID) FROM sizes";
    //oop
    $qry = $db->query($sql);
    $sizeID= $qry->fetch();
    $sizeID = $sizeID[0] + 1;

    foreach ($sizesAry as $size) {
        $name = $size['name'];
        $price = $size['price'];
        $qty = $size['qty'];

        if ($name != "") {
            $sql = "INSERT INTO `sizes`(`sizeID`, `sizeName`, `price`, `qty`) VALUES ($sizeID,\"$name\", $price, $qty)";
            $pdoS = $db->query($sql);
        }
    }

    return $sizeID;
}

// update sizes from $sizeID
function updateSizes($sizesAry, $sizeID){
    global $db;
    
    foreach ($sizesAry as $size) {
        $name = $size['name'];
        $oldName = $size['oldName'];
        $price = $size['price'];
        $price = number_format((float)$price, 2, '.', '');
        $qty = $size['qty'];

        
        if (isset($size['del'])) {
            echo "deleting size " . $name;
            // delete size 
            $sql = "DELETE FROM `sizes` WHERE `sizeName` = \"$name\" AND `sizeID` = $sizeID";
            // echo $sql . "<br>";
            $pdoS = $db->query($sql);
        } else if ($name != "") {
            $sql = "UPDATE `sizes` SET `sizeName`= \"$name\",`price`= $price,`qty`= $qty WHERE `sizeName` = \"$oldName\" AND `sizeID` = $sizeID";
            // echo $sql . "<br>";

            $pdoS = $db->query($sql);
        }
        
    }
}

function addProduct($productName, $portionsID, $price, $qty, $shortDesc, $fullDesc, $catID, $image, $sizeID, $outOfSeason, $hide){
    global $db;

    if ($sizeID != null) {
        $sql = "INSERT INTO `products`(`productName`, `portionsID`, `price`, `qty`, `shortDesc`, `fullDesc`, `catID`, `image`, `sizeID`, `outOfSeason`, `hide`) VALUES (\"$productName\", $portionsID, null, null, \"$shortDesc\", \"$fullDesc\", $catID, \"$image\", $sizeID, $outOfSeason, $hide)";
    } else {
        $sql = "INSERT INTO `products`(`productName`, `portionsID`, `price`, `qty`, `shortDesc`, `fullDesc`, `catID`, `image`, `sizeID`, `outOfSeason`, `hide`) VALUES (\"$productName\", $portionsID, $price, $qty, \"$shortDesc\", \"$fullDesc\", $catID, \"$image\", null, $outOfSeason, $hide)";
    }
    


    $pdoS = $db->query($sql);
    echo ("<br><h3 class='modMessage'>Added: $productName</h3>");
}

//update product by sizeID
function updateProduct($productID, $productName, $price, $qty, $shortDesc, $fullDesc, $image, $sizeID, $outOfSeason, $hide){
    global $db;
    echo ("<h3 class='modMessage'>Edited: $productName</h3>");

    if ($sizeID != null) {
        $sql = "UPDATE `products` SET `productName`=\"$productName\",`shortDesc`=\"$shortDesc\",`fullDesc`=\"$fullDesc\",`image`=\"$image\",`sizeID`= $sizeID,`outOfSeason`= $outOfSeason,`hide`= $hide WHERE productID = $productID";
    } else {
        $sql = "UPDATE `products` SET `productName`=\"$productName\",`price`= $price,`qty`= $qty,`shortDesc`=\"$shortDesc\",`fullDesc`=\"$fullDesc\",`image`=\"$image\",`outOfSeason`= $outOfSeason,`hide`= $hide WHERE productID = $productID";
    }


    // echo $sql . "<br>";
    $pdoS = $db->query($sql);
}

function editCat($catName, $imageName, $taxRate, $hide, $catID){
    global $db;
    echo ("<h3 class='modMessage'>Edited: $catName</h3>");
    $sql = "UPDATE `categories` SET `catName`= '$catName',`image`= \"$imageName\",`taxRate`= $taxRate,`hide`= $hide WHERE catID = $catID";
    $pdoS = $db->query($sql);
}

function orderLine($orderID, $productID, $sizeName, $qty, $num, $price) { 
    global $db;
    $product = prodByID($productID);

    $sqlInsert = "INSERT INTO `orderdetails`(`orderID`, `orderLineNumber`, `productID`, `sizeName`, `quantityOrdered`, `priceEach`) VALUES ($orderID, $num, $productID, \"$sizeName\", $qty, $price)";    
    $pdoS = $db->query($sqlInsert);

    $product = prodByID($productID);

    // change quantities in either sizes or products table
    if ($sizeName != null){ /* has sizes */
        $sizeID = $product['sizeID'];
        $size = sizeByName($sizeName, $sizeID);
        $loweredQty = $size['qty'] - $qty;
        $sqlQty = "UPDATE `sizes` SET `qty`= $loweredQty WHERE `sizeName` = \"$sizeName\" AND `sizeID` = $sizeID";
    } else { /* doesn't have sizes */
        $loweredQty = $product['qty'] - $qty;
        $sqlQty = "UPDATE `products` SET `qty`= $loweredQty WHERE `productID` = $productID";
    }

    $pdoS = $db->query($sqlQty);
}

function order($custID, $orderDate, $status, $delDate, $delLocation, $subtotal, $delFee, $tax, $totalPrice) {
    global $db;

    $sqlInsert = "INSERT INTO `orders`(`customerID`, `orderDate`, `status`, `deliveryDate`, `deliveryLocation`, `subtotal`, `deliveryFee`, `tax`, `totalPrice`) VALUES ($custID, \"$orderDate\", $status, \"$delDate\", \"$delLocation\", $subtotal, $delFee, $tax, $totalPrice)";    
    $pdoS = $db->query($sqlInsert);

    $orderID = getLastOrderIDByCustID($custID);
    $i = 0;
    foreach ($_SESSION['cart'] as $item){
        $i++;
        if ($item['size'] != null){
            $price = $item['size']['price'];
            $size = $item['size']['sizeName'];
        } else {
            $price =  $item['prod']['price'];
            $size = null;
        }
        orderLine($orderID, $item['prod']['productID'], $size, $item['qty'], $i, $price);
    }

    echo "<div class='text-center'><h2>Thank You!</h2><br><h2 class='modMessage'>Order Completed Successfully.</h2></div>";
}
// get the last orderID placed by customerID
function getLastOrderIDByCustID($custID) {
    global $db;
    $sql = "SELECT MAX(orderID) FROM orders WHERE customerID = $custID";

    //oop
    $qry = $db->query($sql);
    $order= $qry->fetch();

    //return an orders
    return $order[0];
}

/** RETURN AN ARRAY OF ALL ORDERS */
function getAllOrders(){
    global $db;
    $sql = "SELECT * FROM `orders`";

    //oop
    $qry = $db->query($sql);
    $aryOrders= $qry->fetchAll();


    //return an array of orders
    return $aryOrders;

}
function getOrderByID($ID){
    global $db;
    $sql = "SELECT * FROM `orders` WHERE orderID = '$ID'";

    //oop
    $qry = $db->query($sql);
    $aryOrders= $qry->fetch();


    //return an array of orders
    return $aryOrders;

}

/** RETURN ORDER DETAILS BY ORDERID */ 
function getOrderDetails($orderID){
    global $db;
    $sql = "SELECT * FROM `orderdetails` WHERE `orderID` = $orderID";

    //oop
    $qry = $db->query($sql);
    $orderDetails= $qry->fetchAll();

    //return an array of orderDetails
    return $orderDetails;
}

// Set status of Order By OrderID to delivered
function updateOrderDelivered($orderID, $delDate) {
    global $db;
    $sql = "UPDATE `orders` SET `status`= 2, `deliveryDate`= \"$delDate\" WHERE orderID = $orderID";
    $pdoS = $db->query($sql);
}

/** RETURN CUSTOMER BY CUSTOMERID */ 
function getCustomerByID($custID){
    global $db;
    $sql = "SELECT * FROM `customers` WHERE `customerID` = $custID";

    //oop
    $qry = $db->query($sql);
    $cust= $qry->fetch();

    //return a cust
    return $cust;
}

/** RETURN CUSTOMER BY ORDERID */ 
function getCustomerByOrderID($orderID){
    global $db;
    $sql = "SELECT * FROM `customers` WHERE `orderID` = $orderID";

    //oop
    $qry = $db->query($sql);
    $cust= $qry->fetch();

    //return a cust
    return $cust;
}

/** RETURN CUSTOMER BY CUSTOMER FName LName and Phone */ 
function getCustomerByNameAndPhone($fName, $lName, $phone){
    global $db;
    $sql = "SELECT * FROM `customers` WHERE `fName` = \"$fName\" AND `lName` = \"$lName\" AND `phone` = \"$phone\"";
    //oop
    $qry = $db->query($sql);
    $cust= $qry->fetch();

    //return an array of cust
    return $cust;
}

/** RETURN CUSTOMER BY CUSTOMER FName LName and Phone */ 
function insertCustomer($fName, $lName, $phone, $address1, $address2, $city, $state, $zip, $email){
    global $db;
    $sql = "INSERT INTO `customers`(`lName`, `fName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postal`, `email`) VALUES (\"$lName\", \"$fName\", \"$phone\", \"$address1\", \"$address2\", \"$city\", \"$state\", $zip, \"$email\")";

    //oop
    $pdoS = $db->query($sql);
}