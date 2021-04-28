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
}
if (!isset($_SESSION['cart'])){ /* check if cart is created in session */
  $_SESSION['cart'] = array();
}
 
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";

// $catID = filter_input(INPUT_POST, "catID");
$prodID = filter_input(INPUT_POST, "prodID");
// $prodName = filter_input(INPUT_POST, "productName");
$qty = filter_input(INPUT_POST, "qty");
$sizeName = filter_input(INPUT_POST, "size");
$addToCart = filter_input(INPUT_POST, "addToCart");
$remove = filter_input(INPUT_POST, "remove");

$subtotal = 0;

echo"<div class='content-container blur-container'>";
// $cat = catByID($catID);


// $_SESSION['cart'][$id]['quantity']++; // another of this item to the cart
// unset($_SESSION['cart'][$id]); //remove the item from the cart



if ($addToCart == "true"){
    $prod = prodByID($prodID);
  
    if (isset($sizeName)) {
        $size = sizeByName($sizeName, $prod['sizeID']);
        $_SESSION['cart'][$prodID] = array('prod' => $prod, 'qty' => $qty, 'size' => $size);
    } else {
      $_SESSION['cart'][$prodID] = array('prod' => $prod, 'qty' => $qty, 'size' => null);
    }
    
} else if (isset($remove)) {
  unset($_SESSION['cart'][$remove]); //remove the item from the cart
}


?>
<!-- <div class="cart-container"> -->
  
  <?php
  if ($_SESSION['cart'] == null) {
    echo "<h3 id='cart-empty' class='text-center'>No Items in Cart</h3>";
  }
  foreach($_SESSION['cart'] as $item){
    
  ?>
      <!-- Individual Product -->
      <!-- Remove any changes being made to the database from this page and move to the product.php page -->
      <div class="cart-prod-row">
        <form action="" method="post">
          <div class="uk-flex-center uk-flex-middle uk-child-width-expand" uk-grid>
            <div class="uk-card uk-card-default uk-width-small ">
              <img class="card-image"  src="../images/<?=$item['prod']['image']?>" alt="<?=$item['prod']['productName']?> Image">
            </div>
            <div class="uk-flex-center uk-flex-middle uk-child-width-expand@s" uk-grid>
              <div>
                <h4><?=$item['prod']['productName']?></h4>
                <?php
                  if ($item['size'] != null){
                    echo $item['size']['sizeName'];
                  }
                ?>
              </div>
              <div>
                <h4>$
                  <?php
                  if ($item['size'] != null){
                    echo $item['size']['price'];
                  } else {
                    echo $item['prod']['price'];
                  }
                ?>
                </h4> <!-- get portionsDesc and show after price to show how is sold. -->
              </div>
              <div>
                <h4>Quantity: <?=$item['qty']?></h4>
              </div>
              <div>
                <h4>Item Total:<br>$
                  <?php
                  if ($item['size'] != null){
                    $itemPrice = $item['size']['price'] * $item['qty'];
                  } else {
                    $itemPrice =  $item['prod']['price'] * $item['qty'];
                  }
                  $subtotal += $itemPrice;
                  echo number_format((float)$itemPrice, 2, '.', '');
                ?>
                </h4>
              </div>
              <div>
                <Button class="cart-remove-btn uk-button" type="submit"><i class="far fa-trash-alt"></i>
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
  <div class="cart-prod-row cart-totals"> <!-- Totals. -->
    <div class="uk-flex uk-flex-right">
      <div class="uk-card uk-card-default uk-card-body uk-width-1-3@m">
        <div class="uk-grid-small" uk-grid>
          <div class="uk-width-expand" uk-leader="fill: .">Subtotal:</div>
          <div>$<?=number_format((float)$subtotal, 2, '.', '')?></div>
        </div>
      </div>
    </div>  
  </div>
  <?php
  if ($_SESSION['cart'] != null) { 
  ?>
    <div style="margin: 0px; margin-bottom: 45px; padding:0px; width:100%;" class="uk-inline">
      <a class="checkout-btn uk-button uk-button-default uk-position-top-right" href="checkout.php">Checkout</a>
    </div>
  <?php
  }
  ?>
  
<!-- </div> -->

</div>
<?php
include "../views/footer.php";
?>