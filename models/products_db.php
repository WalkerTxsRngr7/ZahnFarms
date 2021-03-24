<?php

/** RETURN AN ARRAY OF ALL PRODUCTS */
function getAllProducts(){
    global $db;
    $sql = "SELECT * FROM product";
    $qry = $db->query($sql);
    $aryProd = $qry->fetchAll();


    return $aryProd;

}


/** RETURN A SINGLE PRODUCT FILTERED BY PRODUCT ID */
function prodByID($prodID){
    global $db;

    $sql = "select * from product where productID = $prodID";

    //oop
    $qry = $db->query($sql);
    $product = $qry->fetch();

    //return a product
    return $product;

}


function addProduct($productName, $price, $qty, $imageName){
    global $db;

    echo ("<br><h3 class='modMessage'>Added: $productName</h3>");
    $sql = "INSERT INTO `product`(`productName`, `imageName`, `price`, `qty`) VALUES ('$productName','$imageName',$price,$qty)";
    $pdoS = $db->query($sql);
}

function editProduct($productName, $price, $qty, $imageName, $productID){
    global $db;
    echo ("<br><h3 class='modMessage'>Edited: $productName</h3>");
    $sql = "UPDATE `product` SET `productName`='$productName',`imageName`='$imageName',`price`=$price,`qty`=$qty WHERE productID = $productID";
    $pdoS = $db->query($sql);
}

function order($productID, $qty){
    global $db;
    $sqlInsert = "INSERT INTO `order`(`productID`, `customerName`, `qtyOrdered`) VALUES ($productID,'$_SESSION[name]',$qty)";    
    $pdoS = $db->query($sqlInsert);

    $product = prodByID($productID);
    $loweredQty = $product['qty'] - $qty;
    $sqlQty = "UPDATE `product` SET `qty`= $loweredQty WHERE `productID` = $productID";
    $pdoS = $db->query($sqlQty);
    echo ("<br><h3 class='modMessage'>Order Completed Successfully</h3>");
}

/** RETURN AN ARRAY OF ALL ORDERS */
function getAllOrders(){
    global $db;
    $sql = "SELECT * FROM `order`";

    //oop
    $qry = $db->query($sql);
    $aryOrders= $qry->fetchAll();


    //return an array of products
    return $aryOrders;

}