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

function addProduct($productName, $portionsID, $price, $qty, $shortDesc, $fullDesc, $catID, $image, $sizeID, $outOfSeason, $hide){
    global $db;

    $sql = "INSERT INTO `products`(`productName`, `portionsID`, `price`, `qty`, `shortDesc`, `fullDesc`, `catID`, `image`, `sizeID`, `outOfSeason`, `hide`) VALUES (, \"$productName\", $portionsID, $price, $qty, \"$shortDesc\", \"$fullDesc\", $catID, \"$image\", $sizeID, $outOfSeason, $hide)";

    echo $sql;

    // $pdoS = $db->query($sql);
    echo ("<br><h3 class='modMessage'>Added: $productName</h3>");
}

function editProduct($productName, $price, $qty, $imageName, $productID){
    global $db;
    echo ("<h3 class='modMessage'>Edited: $productName</h3>");
    $sql = "UPDATE `products` SET `productName`='$productName',`image`='$imageName',`price`=$price,`qty`=$qty WHERE productID = $productID";
    $pdoS = $db->query($sql);
}

function editCat($catName, $imageName, $catID){
    global $db;
    echo ("<h3 class='modMessage'>Edited: $catName</h3>");
    $sql = "UPDATE `categories` SET `catName`='$catName',`image`='$imageName' WHERE catID = $catID";
    $pdoS = $db->query($sql);
}

function orderLine($orderID, $productID, $sizeName, $qty, $num, $price) { 
    global $db;
    $product = prodByID($productID);

    $sqlInsert = "INSERT INTO `orderdetails`(`orderID`, `orderLineNumber`, `productID`, `sizeName`, `quantityOrdered`, `priceEach`) VALUES ($orderID, $num, $productID, \"$sizeName\", $qty, $price)";    
    $pdoS = $db->query($sqlInsert);

    $product = prodByID($productID);

    if ($sizeName != null){
        $sizeID = $product['sizeID'];
        $size = sizeByName($sizeName, $sizeID);
        $loweredQty = $size['qty'] - $qty;
        $sqlQty = "UPDATE `sizes` SET `qty`= $loweredQty WHERE `sizeName` = \"$sizeName\" AND `sizeID` = $sizeID";
    } else {
        $loweredQty = $product['qty'] - $qty;
        $sqlQty = "UPDATE `products` SET `qty`= $loweredQty WHERE `productID` = $productID";
    }

    // $sqlQty = "UPDATE `products` SET `qty`= $loweredQty WHERE `productID` = $productID";
    $pdoS = $db->query($sqlQty);

    // echo ("<br><h3 class='modMessage'>Order Item Processed Successfully</h3>");
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