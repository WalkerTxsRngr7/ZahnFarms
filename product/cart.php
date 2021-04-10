<!-- Choose location first -->
<!-- Locations: 
Springfield: Sam's Club E. Sunshine. Wednesday 4-4:30PM.  Monday latest for same Wednesday delivery
Marshfield: Farmer's Market, ...address... Friday 2:30-6:30PM.  Wednesday latest for this Friday delivery
Farm in Elkland: 9018 St Hwy W, Elkland, MO Mon-Sat by appt. Call or email.
 -->

 <!-- If unknownPounds or unknown total pay all at once at pickup. -->



 <?php
session_start();
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";
include '../models/requests.php';

echo"<div class='content-container'>";
// $cat = catByID($catID);





if ($addToCart == "true"){
    $prod = prodByID($prodID);
    if ($prod['sizeID'] != null) {
        $size = sizeByName($sizeName, $prod['sizeID']);
        echo "<h1>Added " . $size['sizeName'] . "</h1>";
        $_SESSION['login'] = 'valid';
    }
    
} 
  



?>


<?php
$aryProd = productsByCatID($catID);
?>
<div class="admin-prod-container">
  <?php
  foreach($aryProd as $prod){
  ?>
    
      <!-- Individual Product -->
      <!-- Remove any changes being made to the database from this page and move to the product.php page -->
      <div class="admin-prod-row">
      <form action="" method="post">
        <input type="hidden" name="prodID" value="<?=$prod['prodID']?>">
        <div class="uk-flex-center uk-text-center uk-flex-middle uk-child-width-expand@m" uk-grid>
          <div class="uk-card uk-card-default uk-width-1-5@m">
            <img src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
          </div>
          <div>
            <h3><?=$prod['productName']?></h3>
          </div>
          <div>
            <h3>$<?=$prod['price']?></h3> <!-- get portionsDesc and show after price to show how is sold. -->
          </div>
          <div>
            <h3>Stock: <?=$prod['qty']?></h3>
          </div>
          <div class="admin-prod-row-checkbox uk-flex uk-flex-column "> <!-- Move to product.php page -->
            <label class="uk-form-label"><input name="hide" value="1" class="uk-checkbox" type="checkbox">
              Hide</label>
            <label class="uk-form-label"><input name="outofseason" value="1" class="uk-checkbox" type="checkbox">
              Out Of
              Season</label>
          </div>
          <div>
            <Button class="uk-button" type="submit">Edit</Button>
          </div>
        </div>
      </form>
    </div>


  <?php
  }
  ?>
</div>


<?php
echo"</div>";

include "../views/footer.php";
?>