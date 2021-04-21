<?php
// $cat = catByID($catID);
$prod = prodByID($prodID);
$portion = portionByID($prod['portionsID']);
$sizeAry = null;
$qty = $prod['qty'];
if ($prod['sizeID'] != null) {
  $sizeAry = sizesByID($prod['sizeID']);
  $qty = 0;
  foreach ($sizeAry as $size){
    $qty += $size['qty'];
  }
}

?>



<!--* Product box-->
<div class="product-card-full uk-grid-small uk-flex-center uk-text-center" style="width:90%; margin:auto" uk-grid>
  <!-- Product image -->
  <div class="uk-card uk-card-default uk-width-1-2"> 
    <img src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
  </div>
  <!-- Main info and buttons -->
  <div class="uk-width-1-2@s">
    <h2>
      <?=$prod['productName']?>
    </h2>
    <!-- don't show price if out of season -->
    <h3 id="price" style="<?php echo($prod['sizeID'] != null ? 'display:none;' : '')?><?php echo($prod['outOfSeason'] == 1 ? 'display:none;' : '')?>">
      <?php echo"$" . $prod['price'] . " " . $portion['portionsDesc']?>
    </h3>
    <!-- Form for product details to add to cart -->
    <form class="uk-form-stacked" action="cart.php" method="post">
      <div class="uk-grid-small uk-child-width-1-1@m uk-flex-center uk-text-center" uk-grid>
        <?php
        if ($prod['outOfSeason'] == 0) { /* In season */
          if($prod['sizeID'] != null){ /* If product has different sizes */
          ?>
          <!-- Size dropdown card -->
          <div class="uk-card">
            <div class="size-form" uk-form-custom="target: > * > span:first-child">
              
              <label class="uk-form-label">Size</label>
              <!-- Size Dropdown-->
              <select id="size" name="size" onchange="sizePrice(this)"> 
                <option selected disabled hidden>Please select...</option>
                <?php
                foreach ($sizeAry as $size){ /* Foreach size that has sizeID from prod */
                ?>
                <option value="<?=$size['sizeName']?>"><?=$size['sizeName']?> $<?=$size['price']?></option>

                <?php
                }
                ?>
              </select>
              <button class="size-button uk-button uk-button-default" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down"></span>
              </button>
            </div>
          </div>

            <?php 
            if ($qty > 0) { ?>
            
            <!-- Quantity box -->
            <div id="qty-box" style="display:none;" class="uk-card  uk-width-expand">
              <label class="uk-form-label" for="form-stacked-text">Quantity</label>
              <div class="uk-form-controls uk-width-1-3" style="margin:auto">
                <input id="qty-input" class="uk-input uk-text-center" id="form-stacked-text" type="number" placeholder="1-<?=$prod['qty']?>" min="1" max="<?=$prod['qty']?>" name="qty" tabindex="1" step="1" required onchange="checkQty()">
              </div>
              <p id="qty-invalid-alert">Invalid Quantity</p>
            </div>
            <?php
            } 
          
          } else {
            if ($qty > 0) {
            ?>
          <!-- Quantity box -->
          <div class="uk-card uk-width-expand">
            <label class="uk-form-label" for="form-stacked-text">Quantity</label>
            <div class="uk-form-controls uk-width-1-3" style="margin:auto">
              <input id="qty-input" class="uk-input uk-text-center" id="form-stacked-text" type="number" placeholder="1-<?=$prod['qty']?>" min="1" max="<?=$prod['qty']?>" name="qty" tabindex="1" step="1" required onchange="checkQty()">
            </div>
            <p id="qty-invalid-alert">Invalid Quantity</p>
          </div>

            <?php 
            }
          }
            ?>

          

        <?php
        } 
        if ($qty == 0) { /* Out of stock */
        ?>
        <!-- Out of Stock button -->
        <div class="uk-card">
          <button id="submit add-to-cart-btn" class="uk-button uk-button-default" tabindex="-1" disabled>Out of Stock</button>
        </div>  
        <?php
        } else if ($prod['outOfSeason'] == 1) { /* Out of season */
        ?>
        <!-- Out of Season button -->
        <div class="uk-card">
          <button id="submit add-to-cart-btn" class="uk-button uk-button-default" tabindex="-1" disabled>Out of Season</button>
        </div>  

        <?php
        } else { /* In Stock and In Season */
        ?>

          <!-- Add to cart button -->
          <div class="uk-card">
            <input type="hidden" name="prodID" value="<?=$prod['productID']?>">
            <input type="hidden" name="addToCart" value="true">
            <button id="submit add-to-cart-btn" class="uk-button uk-button-default" type="submit" tabindex="2">Add to Cart</button>
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
  window.addEventListener('load', 
    function() {
      /* Disable submit button on page load */
      document.getElementById("submit").disabled = true; 
    });

  function sizePrice(e) {
    var existing = document.getElementById("price").innerText;
    var text = existing.trim().split(/\s+/);
    var input = e.options[e.selectedIndex].textContent;
    var index = e.selectedIndex - 1;
    

    var arrayName = <?php echo json_encode($sizeAry); ?>;
    document.getElementById("qty-input").max = arrayName[index][3];
    document.getElementById("qty-input").placeholder = "1-" + arrayName[index][3];
    document.getElementById("qty-input").value = "";

    var price = input.split('$');
    if (text[1] == null) {
      document.getElementById("price").innerHTML="$" + price[1];
    } else {
      document.getElementById("price").innerHTML="$" + price[1] + " " + text[1] + " " + text[2];
    }
    document.getElementById("qty-box").style = "display:block";
    document.getElementById("price").style = "display:block";
  }

  function checkQty() {
    var input = document.getElementById("qty-input").value;
    var maxQty = document.getElementById("qty-input").max;
    /* Input is higher than maxQty */
    if (parseFloat(input) > parseFloat(maxQty)) {
      document.getElementById("qty-invalid-alert").style = "display:block;";
      document.getElementById("submit").disabled = true;
    } else if (parseFloat(input) > 0){
      document.getElementById("qty-invalid-alert").style = "display:none";
      formValidation();
    }
  }

  function formValidation() {
    var submit = document.getElementById("submit").innerText;
    if (submit == "ADD TO CART") {
      document.getElementById("submit").disabled = false;
    }
  }
</script>