<!-- Form for product details that can be changed -->
<form class="uk-form-stacked admin-prod-form" action="adminProduct.php" method="post">
  <div class="uk-grid-small uk-flex-center uk-text-center content-container" style="width:90%; margin:auto" uk-grid>
      
      <!-- Product image -->
      <div class="uk-card uk-card-default uk-width-1-2@s">
          <img src="images/beef.jpg" alt="beef image">
      </div>
      <!-- Main info and buttons -->
      <div class="uk-width-1-2@s">
          <!-- Save Changes button -->
          <div class="uk-card">
              <input type="hidden" name="productID" value="1">
              <button class="uk-button uk-button-default" type="submit">Save</button>
          </div>
          <h2>
              <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text"
                  placeholder="Chicken Breast" name="productName">
          </h2>
          <h3>
              <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text"
                  placeholder="$3 / pound" name="price">
          </h3>
          <div class="uk-grid-small uk-child-width-1-1@m uk-flex-center uk-text-center" uk-grid>
              <!-- Size dropdown card -->
              <!-- only show if has a sizeID -->
              <div class="uk-card">
                  <div uk-form-custom="target: > * > span:first-child">
                      <label class="uk-form-label">Size</label>
                      <!-- Size Dropdown-->
                      <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text" placeholder="Small" name="productName">
                      <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text"
                          placeholder="Medium" name="productName">
                      <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text"
                          placeholder="Large" name="productName">
                  </div>
              </div>
              <!-- Quantity box -->
              <div class="uk-card  uk-width-expand">
                  <label class="uk-form-label" for="form-stacked-text">Stock</label>
                  <div class="uk-form-controls uk-width-1-3" style="margin:auto">
                      <!-- Possibly use numbered dropdown through 10+ then change to input box like Amazon-->
                      <input class="uk-input uk-text-center" id="form-stacked-text" type="number" placeholder="<?$product['qty']?>" min="1" name="qty">
                  </div>
              </div>

          </div>

          <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-short">
              <p>
              <textarea class="admin-input uk-textarea" rows="5" name="shortDesc" placeholder="Short Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt."></textarea>
              </p>
          </div>

      </div>
      <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-full">
          <p>
            <!-- <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text" placeholder="Full Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut labore
              et dolore magna aliqua. In ante metus dictum at tempor commodo. Mattis ullamcorper velit sed
              ullamcorper. Mauris
              ultrices eros in cursus turpis massa tincidunt dui ut. Enim sit amet venenatis urna cursus eget nunc
              scelerisque." name="productName"> -->
            <textarea class="admin-input uk-textarea" rows="5" name="fullDesc" placeholder="Full Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In ante metus dictum at tempor commodo. Mattis ullamcorper velit sed ullamcorper. Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Enim sit amet venenatis urna cursus eget nunc scelerisque."></textarea>
            <!-- <br/> -->
            <!-- <input type="submit" value="Submit"> -->
          </p>
      </div>

  </div>
</form>