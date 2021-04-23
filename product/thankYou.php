



<?php
if (!isset($_SESSION)) { /* check if session is created */
    session_start();
}
 
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";

$placeOrder = filter_input(INPUT_POST, "placeOrder");

if (!isset($placeOrder)){
    header("Location: ./cart.php");
}

$fName = filter_input(INPUT_POST, "fName");
$lName = filter_input(INPUT_POST, "lName");
$address1 = filter_input(INPUT_POST, "address1");
$address2 = filter_input(INPUT_POST, "address2");
$phone = filter_input(INPUT_POST, "phone");
$email = filter_input(INPUT_POST, "email");
$city = filter_input(INPUT_POST, "city");
$state = filter_input(INPUT_POST, "state");
$zip = filter_input(INPUT_POST, "zip");

$checkout = filter_input(INPUT_POST, "checkout");
$delDate = filter_input(INPUT_POST, "delDate");
$delLoc = filter_input(INPUT_POST, "delLoc");
$subtotal = filter_input(INPUT_POST, "subtotal");
$delFee = filter_input(INPUT_POST, "delFee");
$tax = filter_input(INPUT_POST, "tax");
$total = filter_input(INPUT_POST, "total");


$order = filter_input(INPUT_POST, "order");
$prodID = filter_input(INPUT_POST, "prodID");
$prodName = filter_input(INPUT_POST, "productName");
$qty = filter_input(INPUT_POST, "qty");
$sizeName = filter_input(INPUT_POST, "size");




echo "<div class='content-container checkout-page'>";


/* if paid online */
if ($checkout == 'true') {
    $status = 1; /* paid */
} else { /* pay in person */
    $status = 0; /* unpaid */
}


$custID = $_SESSION['custID'];

// place order if haven't placed order yet.
if (!empty($_SESSION['cart'])) {
    if ($delLoc == "Farm") {
        $delDate == "Appointment";
    }
    order($custID, date('Y-m-d'), $status, $delDate, $delLoc, $subtotal, $delFee, $tax, $total);
    unset($_SESSION['cart']);
} else {
    echo "<h2 class='text-center py-5'>Order Already Placed</h2>";
}
echo "</div>";

include "../views/footer.php";
?>