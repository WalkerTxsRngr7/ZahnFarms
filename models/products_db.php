<?php

/** RETURN AN ARRAY OF ALL PRODUCTS */
function getAllProducts(){
    global $db;
    $sql = "SELECT * FROM products";
    $qry = $db->query($sql);
    $aryProd = $qry->fetchAll();


    return $aryProd;

}


/** RETURN A SINGLE PRODUCT FILTERED BY PRODUCT ID */
function prodByID($prodID){
    global $db;

    $sql = "select * from products where productID = $prodID";

    //oop
    $qry = $db->query($sql);
    $product = $qry->fetch();

    //return a product
    return $product;

}


function addProduct($productName, $price, $qty, $imageName){
    global $db;

    echo ("<br><h3 class='modMessage'>Added: $productName</h3>");
    $sql = "INSERT INTO `products`(`productName`, `image`, `price`, `qty`) VALUES ('$productName','$imageName',$price,$qty)";
    $pdoS = $db->query($sql);
}

function editProduct($productName, $price, $qty, $imageName, $productID){
    global $db;
    echo ("<br><h3 class='modMessage'>Edited: $productName</h3>");
    $sql = "UPDATE `products` SET `productName`='$productName',`image`='$imageName',`price`=$price,`qty`=$qty WHERE productID = $productID";
    $pdoS = $db->query($sql);
}

function orderLine($orderID, $productID, $qty){ /* Change to updated database. Probably foreach from each item being purchased. Get price from Database*/
    global $db;
    $sqlInsert = "INSERT INTO `orderdetails`(`orderID`, `productID`, `quantityOrdered`, `priceEach`, `orderLineNumber`) VALUES ('$orderID', '$productID', '$qty', '$price')";    
    $pdoS = $db->query($sqlInsert);

    $product = prodByID($productID);
    $loweredQty = $product['qty'] - $qty;
    $sqlQty = "UPDATE `products` SET `qty`= $loweredQty WHERE `productID` = $productID";
    $pdoS = $db->query($sqlQty);

    echo ("<br><h3 class='modMessage'>Order Item Processed Successfully</h3>");
}

function order($orderID, $custID, $delDate, $delTime, $delLocation, $totalPrice, $cartAry) {
    global $db;
    $sqlInsert = "INSERT INTO `orders`(`orderID`, `customerID`, `orderDate`, `status`, `deliveryDate`, `deliveryTime`, `deliveryLocation`, `totalPrice`) VALUES ('$orderID', '$_SESSION[name]','$delDate', '$delTime', '$delLocation', '$totalPrice')";    
    $pdoS = $db->query($sqlInsert);

    foreach ($cartAry as $prod){
        orderLine($orderID, $productID, $qty);
    }

    echo ("<br><h3 class='modMessage'>Order Completed Successfully</h3>");
}

/** RETURN AN ARRAY OF ALL ORDERS */
function getAllOrders(){
    global $db;
    $sql = "SELECT * FROM `orders`";

    //oop
    $qry = $db->query($sql);
    $aryOrders= $qry->fetchAll();


    //return an array of products
    return $aryOrders;

}