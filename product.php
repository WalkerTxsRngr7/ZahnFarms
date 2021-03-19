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



  <!--* Product box-->
  <div class="uk-grid-small uk-flex-center uk-text-center content-container" style="width:90%; margin:auto" uk-grid>
    <div class="uk-card uk-card-default uk-width-1-2@s">
      <img src="images/beef.jpg" alt="beef image">
    </div>
    <div class="uk-width-1-2@s">
      <h2>
        Chicken Breast
      </h2>
      <h3>
        $3 / pound
      </h3>
      <form class="uk-form-stacked" action="product.php" method="get">
        <div class="uk-grid-small uk-child-width-1-2@m uk-flex-center uk-text-center" uk-grid>
          <div class="uk-margin uk-card">
            <div uk-form-custom="target: > * > span:first-child">
              <label class="uk-form-label">Size</label>
              <select name="size">
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
          <div class="uk-margin uk-card">
            <label class="uk-form-label" for="form-stacked-text">Quantity</label>
            <div class="uk-form-controls uk-width-1-2" style="margin:auto"> <!-- Possibly use numbered dropdown through 10+ then change to input box like Amazon-->
              <input class="uk-input uk-text-center" id="form-stacked-text" type="number" placeholder="How many?" min="1" name="qty"> 
            </div>
          </div>
          <div class="uk-margin uk-card">
            <input type="hidden" name="productID" value="1">
            <button class="uk-button uk-button-default" type="submit">Add To Cart</button>
          </div>
        </div>
      </form>
      <div class="uk-card uk-card-default uk-card-body uk-width-expand productDesc">
      <p>
        Short Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
      </p>
    </div>
    </div>
    <div class="uk-card uk-card-default uk-card-body uk-width-expand productDesc">
      <p>
        Full Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
        et dolore magna aliqua. In ante metus dictum at tempor commodo. Mattis ullamcorper velit sed ullamcorper. Mauris
        ultrices eros in cursus turpis massa tincidunt dui ut. Enim sit amet venenatis urna cursus eget nunc
        scelerisque.
      </p>
    </div>
    
  </div>

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
