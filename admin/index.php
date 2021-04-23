<?php
if (!isset($_SESSION)) { /* check if session is created */
    session_start();
}
$title = "Admin";
$headTitle = "Admin";
include "../views/header.php";

$prodID = filter_input(INPUT_POST, "prodID");
$catID = filter_input(INPUT_POST, "catID");
$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
$adminBtn = filter_input(INPUT_POST, "adminBtn");
$modify = filter_input(INPUT_POST, "modify");
$edit = filter_input(INPUT_POST, "edit");
$viewOrder = filter_input(INPUT_POST, "viewOrder");
$printOrder = filter_input(INPUT_POST, "print");
$newProdName = filter_input(INPUT_POST, "newProdName");
$newCatName = filter_input(INPUT_POST, "newCatName");
$newPrice = filter_input(INPUT_POST, "newPrice");
$newQty = filter_input(INPUT_POST, "newQty");
$newImage = filter_input(INPUT_POST, "newImage");
$oldImage = filter_input(INPUT_POST, "oldImage");
$orderID = filter_input(INPUT_POST, "orderID");
$custID = filter_input(INPUT_POST, "custID");
$delDate = filter_input(INPUT_POST, "delDate");


if (!empty($username) && !empty($password)){
    if (md5($username) == '21232f297a57a5a743894a0e4a801fc3' && md5($password) == '1a1dc91c907325c69271ddf0c944bc72') { //U:admin  P:pass
        $_SESSION['login'] = 'valid';
    } else {
        echo ("<h4 style='color: red; text-align: center;'>Your Username or Password is incorrect</h4>");
    }
    
} else if (!empty($username) || !empty($password)){
    echo ("<h4 style='color: red;text-align:center;'>You must enter both username and password</h4>");
}
  
if (isset($_SESSION['login']) == "valid"){
    include "./admin.php";
} else {
    include "./login.php";
}


include "../views/footer.php";
  
?>