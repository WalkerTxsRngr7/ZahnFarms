<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/css/uikit.min.css" />
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/js/uikit-icons.min.js"></script>

  <link rel="stylesheet" href="styles.css">

  <title>Zahn Farms</title>
</head>

<body>
  <!--* Nav Bar --> 
  <!-- TODO Style -->
  <div id="import-Navbar">
  </div>
  
  <!-- TODO Navbar for mobile devices -->
  <!-- <nav class="navMenu">
    <div class="nav-item dropdown">
      <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></a>
      <div class="dropdown-menu collapse hide">
        <a class="dropdown-item" href="index.html">Home</a>
        <a class="nav-linkSm dropdown-toggle" href="#" id="navbarDropdownSm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
        <div class="dropdown-menu collapse hide" aria-labelledby="navbarDropdownSm">
          <a class="dropdown-item" href="spirits.html">Spirits</a>
          <a class="dropdown-item" href="localOrganic.html">Local Organics</a>
          <a class="dropdown-item" href="localPremium.html">Local Premium</a>
          <a class="dropdown-item" href="privateLabel.html">Private Label</a>
        </div>
        <a class="dropdown-item" href="latestNews.html">Latest News</a>
        <a class="dropdown-item" href="contact.html">Contact Us</a>
      </div>
    </div>
    <a href="index.html"><img src="images/agSelect-Logo-nav.jpg" alt="AgSelect logo"></a>
    <a href="tel:555-555-5555" class="navContact">(555) 555-5555</a>
  </nav> -->

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
                  <div class="uk-card">
                      <div uk-form-custom="target: > * > span:first-child">
                          <label class="uk-form-label">Size</label>
                          <!-- Size Dropdown-->
                          <!-- Make dynamically -->
                          <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text"
                              placeholder="Small" name="productName">
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
                          <input class="uk-input uk-text-center" id="form-stacked-text" type="number"
                              placeholder="How much?" min="1" name="qty">
                      </div>
                  </div>

              </div>

              <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-short">
                  <p>
                      Short Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                      incididunt.
                  </p>
              </div>

          </div>
          <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-full">
              <p>
                  Full Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore
                  et dolore magna aliqua. In ante metus dictum at tempor commodo. Mattis ullamcorper velit sed
                  ullamcorper. Mauris
                  ultrices eros in cursus turpis massa tincidunt dui ut. Enim sit amet venenatis urna cursus eget nunc
                  scelerisque.
              </p>
          </div>

      </div>
  </form>
  

 <!-- TODO Change info -->
  <footer class="footer">
    <div class="footerImg">
      <a href="https://greenfundsolutions.com/" target="_blank"><img src="images/greenFund-Logo1.png" alt="Green Fund Solutions Logo"></a>
    </div>
    <div class="socialMediaFooter">
      <a href="mailto:DHamilton@GreenFundSolutions.com">Email: DHamilton@GreenFundSolutions.com</a>
      <br>
      <a href="tel:833-697-6649" class="navContact">Phone: (833) 697-6649</a>
      <br>
      <a href="https://www.facebook.com/AgSelectUSA/" target="_blank"><i class="fab fa-facebook-square"></i></a>
      <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://twitter.com/ag_select" target="_blank"><i class="fab fa-twitter-square"></i></a>
    </div>
    <div class="footerCopyright">
      <br>
      <p>
        &copy; 2021 Site Created By: <br>Walker Gross, Jacob Estrada, & Skyler Barr
      </p>
    </div>
  </footer>




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="main.js"></script>
</body>

</html>
