<?php
// $cat = catByID($catID);
$prod = prodByID($prodID);
$portion = portionByID($prod['portionsID']);
if ($prod['sizeID'] != null) {
  $sizeAry = sizesByID($prod['sizeID']);
  // echo "<h1>$sizeAry[0][0]</h1>";
  // foreach ($sizeAry as $size){
    // echo "<h1>" . $sizeAry[0][1] . "</h1>";
  // }
}

?>



<!--* Product box-->
<div class="uk-grid-small uk-flex-center uk-text-center content-container" style="width:90%; margin:auto" uk-grid>
  <!-- Product image -->
  <div class="uk-card uk-card-default uk-width-1-2@s"> 
    <img src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
  </div>
  <!-- Main info and buttons -->
  <div class="uk-width-1-2@s">
    <h2>
      <?=$prod['productName']?>
    </h2>
    <h3 id="price">
      $<?=$prod['price']?> <?=$portion['portionsDesc']?>
    </h3>
    <!-- Form for product details to add to cart -->
    <form class="uk-form-stacked" action="product.php" method="get">
      <div class="uk-grid-small uk-child-width-1-1@m uk-flex-center uk-text-center" uk-grid>
        <?php
        if($prod['sizeID'] != null){ /* If product has different sizes */
        ?>
        <!-- Size dropdown card -->
        <div class="uk-card">
          <div uk-form-custom="target: > * > span:first-child">
            
            <label class="uk-form-label">Size</label>
            <!-- Size Dropdown-->
            <select name="size" onchange="sizePrice(this)"> <!-- TODO foreach size that has sizeID of prod -->
              <option selected disabled>Please select...</option>
              <?php
              foreach ($sizeAry as $size){
                
              ?>
              <option value="<?=$size['sizeName']?>"><?=$size['sizeName']?> $<?=$size['price']?></option>

              <?php
              }
              ?>
            </select>
            <button class="uk-button uk-button-default" type="button" tabindex="-1">
              <span></span>
              <span uk-icon="icon: chevron-down"></span>
            </button>
          </div>
        </div>

        <!-- Quantity box -->
        <div id="qtyBox" class="uk-card  uk-width-expand">
          <!-- <!-- class="uk-form-label" for="form-stacked-text">Quantity</!-->
          <div class="uk-form-controls uk-width-1-3" style="margin:auto; display:none;">
            <input class="uk-input uk-text-center" id="form-stacked-text" type="number" placeholder="1-<?=$prod['qty']?>" min="1" max="<?=$prod['qty']?>" name="qty" tabindex="1"> 
          </div> -->
        </div>
        <!-- Add to cart button -->
        <div class="uk-card">
          <input type="hidden" name="productID" value="1">
          <button class="uk-button uk-button-default" type="submit" tabindex="2">Add To Cart</button>
        </div>  


        <?php
          } else {
        ?>
        <!-- Quantity box -->
        <div class="uk-card  uk-width-expand">
          <label class="uk-form-label" for="form-stacked-text">Quantity</label>
          <div class="uk-form-controls uk-width-1-3" style="margin:auto">
            <input class="uk-input uk-text-center" id="form-stacked-text" type="number" placeholder="1-<?=$prod['qty']?>" min="1" max="<?=$prod['qty']?>" name="qty" tabindex="1"> 
          </div>
        </div>
        <!-- Add to cart button -->
        <div class="uk-card">
          <input type="hidden" name="productID" value="1">
          <button class="uk-button uk-button-default" type="submit" tabindex="2">Add To Cart</button>
        </div>

        <?php
        }
        ?>
      </div>
    </form>
    <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-short">
    <p><?=$prod['shortDesc']?></p>
  </div>
  </div>
  <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-full">
    <p><?=$prod['fullDesc']?></p>
  </div>
  
</div>

<script>
  function sizePrice(e) {
    var existing = document.getElementById("price").innerText;
    var text = existing.trim().split(/\s+/);
    var input = e.options[e.selectedIndex].textContent;
    var price = input.split('$');
    document.getElementById("price").innerHTML="$" + price[1] + " " + text[1] + " " + text[2];
    alert("<?=$sizeAry[0]['price']?>");
    alert("<?=$prod['qty']?>");
  }
</script>