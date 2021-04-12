<!-- Choose location first -->
<!-- Locations: 
Springfield: Sam's Club E. Sunshine. Wednesday 4-4:30PM.  Monday latest for same Wednesday delivery
Marshfield: Farmer's Market, ...address... Friday 2:30-6:30PM.  Wednesday latest for this Friday delivery
Farm in Elkland: 9018 St Hwy W, Elkland, MO Mon-Sat by appt. Call or email.
 -->

 <!-- If unknownPounds or unknown total pay all at once at pickup. -->



 <?php
if (!isset($_SESSION)) { /* check if session is created */
  session_start();
} else if (!isset($_SESSION['cart'])){ /* check if cart is created in session */
  $_SESSION['cart'] = array();
}
 
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";

$catID = filter_input(INPUT_POST, "catID");
$prodID = filter_input(INPUT_POST, "prodID");
$prodName = filter_input(INPUT_POST, "productName");
$qty = filter_input(INPUT_POST, "qty");
$sizeName = filter_input(INPUT_POST, "size");
$addToCart = filter_input(INPUT_POST, "addToCart");
$remove = filter_input(INPUT_POST, "remove");
$order = filter_input(INPUT_POST, "order");
$customerName = filter_input(INPUT_POST, "customerName");

$subtotal = 0;
$tax = 0;

echo"<div class='content-container'>";
// $cat = catByID($catID);


// $_SESSION['cart'][$id]['quantity']++; // another of this item to the cart
// unset($_SESSION['cart'][$id]); //remove the item from the cart



if ($addToCart == "true"){
    $prod = prodByID($prodID);
  
    // if ($prod['sizeID'] != null) {
    if (isset($sizeName)) {
        $size = sizeByName($sizeName, $prod['sizeID']);
        $_SESSION['cart'][$prodID] = array('prod' => $prod, 'qty' => $qty, 'size' => $size);
        // echo "<h1>Added " . $prodID . "</h1>";
        // echo "<h1>Added " . $size['sizeName'] . "</h1>";
    } else {
      $_SESSION['cart'][$prodID] = array('prod' => $prod, 'qty' => $qty, 'size' => null);
      // echo "<h1>Added " . $prodID . "</h1>";
      // echo "<h1>Added " . $_SESSION['cart'][$prodID]['size'] . "</h1>";
    }
    
} else if (isset($remove)) {
  unset($_SESSION['cart'][$remove]); //remove the item from the cart
}

  



?>


<?php
// $aryProd = productsByCatID($catID);
?>
<div class="admin-prod-container">
  <a class="uk-button uk-button-default" href="checkout.php">Checkout</a>
  <?php
  foreach($_SESSION['cart'] as $item){
    // if ($item['size'] != null){
    //   $total += $item['size']['price'];
    // } else {
    //   $total += $item['prod']['price'];
    // }
    
    // $prod = prodByID($item['prodID']);
  ?>
      <!-- Individual Product -->
      <!-- Remove any changes being made to the database from this page and move to the product.php page -->
      <div class="admin-prod-row">
        <form action="" method="post">
          <div class="uk-flex-center uk-flex-middle uk-child-width-expand" uk-grid>
            <div class="uk-card uk-card-default uk-width-small ">
              <img src="../images/<?=$item['prod']['image']?>" alt="<?=$item['prod']['productName']?> Image">
            </div>
            <div class="uk-flex-center uk-flex-middle uk-child-width-expand@s" uk-grid>
              <div>
                <h3><?=$item['prod']['productName']?></h3>
                <?php
                  if ($item['size'] != null){
                    echo $item['size']['sizeName'];
                  }
                ?>
              </div>
              <div>
                <h3>$
                  <?php
                  if ($item['size'] != null){
                    echo $item['size']['price'];
                  } else {
                    echo $item['prod']['price'];
                  }
                ?>
                </h3> <!-- get portionsDesc and show after price to show how is sold. -->
              </div>
              <div>
                <h3>Quantity: <?=$item['qty']?></h3>
              </div>
              <div>
                <h3>Item Total:<br>$
                  <?php
                  if ($item['size'] != null){
                    $itemPrice = $item['size']['price'] * $item['qty'];
                  } else {
                    $itemPrice =  $item['prod']['price'] * $item['qty'];
                  }
                  $subtotal += $itemPrice;
                  echo number_format((float)$itemPrice, 2, '.', '');
                ?>
                </h3>
              </div>
              <div>
                <Button class="uk-button" type="submit">Remove<br><i class="fas fa-minus-circle"></i> <i
                    class="fas fa-minus"></i> <i class="fas fa-minus-square"></i> <i class="fas fa-times"></i> <i
                    class="fas fa-trash"></i> <i class="far fa-trash-alt"></i>
                    <input type="hidden" name="remove" value="<?=$item['prod']['productID']?>">
                </Button>
                    
              </div>
            </div>
          </div>
        </form>
      </div>


  <?php
  }
  ?>
  <div class="admin-prod-row"> <!-- Totals. May only show subtotal. Tax and total can be on the checkout page -->
    <div class="uk-flex uk-flex-right">
      <div class="uk-card uk-card-default uk-card-body uk-width-1-3@m">
        <div class="uk-grid-small" uk-grid>
          <div class="uk-width-expand" uk-leader="fill: .">Subtotal:</div>
          <div>$<?=number_format((float)$subtotal, 2, '.', '')?></div>
        </div>
        <div class="uk-grid-small" uk-grid>
          <div class="uk-width-expand" uk-leader="fill: -">Tax:</div> <!-- Need to find out what to do for tax -->
          <div>$<?=number_format((float)$tax, 2, '.', '')?></div>
        </div>
        <div class="uk-grid-small" uk-grid>
          <div class="uk-width-expand" uk-leader="fill: _">Total:</div>
          <div>$<?php $total = $subtotal+$tax; echo number_format((float)$total, 2, '.', '');?></div>
        </div>
      </div>
    </div>  
  </div>
</div>


<?php
echo"</div>";

include "../views/footer.php";
?>