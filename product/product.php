<?php
// $cat = catByID($catID);
$prod = prodByID($prodID);
// $portion = portionByID($prod['portionsID']);
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
    <h3>
      <?=$prod['price']?> <?$portion['portionsDesc']?>
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
            <select name="size"> <!-- TODO foreach size that has sizeID of prod -->
              <option value="">Please select...</option>
              <option value="1">Small</option>
              <option value="2">Medium</option>
              <option value="3">Large</option>
            </select>
            <button class="uk-button uk-button-default" type="button" tabindex="-1">
              <span></span>
              <span uk-icon="icon: chevron-down"></span>
            </button>
          </div>
        </div>
        <?php
          }
        ?>
        <!-- Quantity box -->
        <div class="uk-card  uk-width-expand">
          <label class="uk-form-label" for="form-stacked-text">Quantity</label>
          <div class="uk-form-controls uk-width-1-3" style="margin:auto"> <!-- Possibly use numbered dropdown through 10+ then change to input box like Amazon-->
            <input class="uk-input uk-text-center" id="form-stacked-text" type="number" placeholder="How many?" min="1" name="qty"> 
          </div>
        </div>
        <!-- Add to cart button -->
        <div class="uk-card">
          <input type="hidden" name="productID" value="1">
          <button class="uk-button uk-button-default" type="submit">Add To Cart</button>
        </div>
      </div>
    </form>
    <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-short">
    <p>
      Short Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
    </p>
  </div>
  </div>
  <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-full">
    <p>
      Full Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
      et dolore magna aliqua. In ante metus dictum at tempor commodo. Mattis ullamcorper velit sed ullamcorper. Mauris
      ultrices eros in cursus turpis massa tincidunt dui ut. Enim sit amet venenatis urna cursus eget nunc
      scelerisque.
    </p>
  </div>
  
</div>
