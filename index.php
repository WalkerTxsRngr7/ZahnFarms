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
  <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
    <nav class="uk-navbar-container" uk-navbar>
      <div class="uk-navbar-left">
          <ul class="uk-navbar-nav">
            <li>
              <a class="uk-logo" href="index.php">
                <img src="images/Zahn Farms Logo.jpg" alt="Zahn Farms Logo"> <!--TODO Change logo-->
              </a>
            </li>
            <li>
              <a href="index.php">Products</a>
              <div class="uk-navbar-dropdown" delay-hide="50">
                  <ul class="uk-nav uk-navbar-dropdown-nav"> <!-- TODO Dynamically get categories from database-->
                    <!--
                    <li><a href="products.php/beef">Beef</a></li>
                    <li><a href="products.php/pork">Pork</a></li>
                    <li><a href="#">Chicken</a></li>
                    <li><a href="#">Eggs</a></li>
                    <li><a href="#">Mushrooms</a></li>
                    <li><a href="#">Fruit</a></li>
                    <li><a href="#">Berries</a></li>
                    <li><a href="#">Vegetables</a></li>
                    -->
                      <?php
                      $servername = "127.0.0.1";
                      $username = "root";
                      $password = "arizona";
                      $dbname = "teaching";
                      $sql = "SELECT * FROM links";
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                              /*
                               * adding html can be done by calling the echo statement
                               * example:
                               * echo "<tr class='TableRows'>";
                               * remember this is just html code just in a php format
                               * more data can be added just a sample from my database
                               * this function can become a key to our project and more advance
                               * if you change any styling to this function its going to change the whole product page
                               * you can delete these comments once we finish the product page and add needed information
                              */
                              $link = $row['URL'];
                              $text = $row['Text'];
                              $URL = "<li><a href='$link'>$text</a></li>";
                              echo $URL;
                              // <li><a href="products.php/$link">Beef</a></li>
                          }
                      }
                      ?>
                  </ul>
              </div>
            </li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contact Us</a></li>

            <li><a href="tel:417-719-7517" class="navContact">(417) 719-7517</a></li>
            <li><a href="https://www.facebook.com/ZahnFarms/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://twitter.com/ag_select" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
          </ul>
      </div>
      <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
          <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
          <li><a href="#">Sign In</a></li>
        </ul>
      </div>
    </nav>
    <!--? For putting breadcrumbs on Products and Product page. Not Categories/Home Page -->
    <!-- <div class="uk-navbar-subtitle"> 
      <ul class="uk-breadcrumb">
        <li><a href="">Products</a></li>
        <li><a href="">Chicken</a></li>
        <li><span>Chicken Breast</span></li>
      </ul>
    </div> -->
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

  <h1 class="slogan">Short about us here</h1>

  <!--* Category boxes-->
  <!-- TODO Style -->
  <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>
    <!-- TODO Created dynamically from database -->
    <a href="products.php"><!--? Put class="uk-flex-last" for out of season items -->
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Beef</p>
        </div>
      </div>
    </a>
    <a href="products.php">
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Chicken</p>
        </div>
      </div>
    </a>
    <a href="products.php">
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Pork</p>
        </div>
      </div>
    </a>
    <a href="products.php">
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Eggs</p>
        </div>
      </div>
    </a>
    <a href="products.php">
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Vegetables</p>
        </div>
      </div>
    </a>
    <a href="products.php">
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Fruit</p>
        </div>
      </div>
    </a>
    <a href="products.php">
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Berries</p>
        </div>
      </div>
    </a>
    <a href="products.php">
      <div class="uk-card uk-card-default">    
        <div class="uk-card-media-top">
          <img src="images/beef.jpg" alt="">
        </div>
        <div class="uk-overlay uk-overlay-primary uk-position-bottom">
          <p>Mushrooms</p>
        </div>
      </div>
    </a>
  </div>


<!--
  <p class="desc">Click on a circle to learn more!</p>
  <div class="categories">
    <div class="ctgContainer">
      <img src="images/premiumProducts4.png" class="ctgPic" alt="Local Organics">
      <div class="overlay">
        <div class="overlayText">We personally visit the various locations that our products are produced. We do this to ensure that any product purchased is the highest level of quality.</div>
      </div>
      <div class="text">Local Organics</div>
    </div>
    <div class="ctgContainer">
      <img src="images/premiumSpirits.jpg" class="ctgPic" alt="Spirits">
      <div class="overlay">
        <div class="overlayText">AgSelect distributes premium beverage products to the Midwestern US markets.</div>
      </div>
      <div class="text">Spirits</div>
    </div>
    <div class="ctgContainer">
      <img src="images/organicFarmer.png" class="ctgPic" alt="Supports Local Farmers">
      <div class="overlay">
        <div class="overlayText">AgSelect searches out the best of breed producers of niche products and distributes those products directly to the market.</div>
      </div>
      <div class="text">Supports Local Farmers</div>
    </div>
    <div class="ctgContainer">
      <img src="images/labels.jpg" class="ctgPic" alt="Private Label">
      <div class="overlay">
        <div class="overlayText">The opportunity to take one of our high end, premium products, and label it with your company's own brand!</div>
      </div>
      <div class="text">Private Label</div>
    </div>
  </div> -->

 <!-- TODO Change info -->
  <footer class="footer">
    <div class="footerImg">
      <a href="https://greenfundsolutions.com/" target="_blank"><img src="images/greenFund-Logo1.png" alt="Green Fund Solutions Logo"></a>
    </div>
    <div class="socialMediaFooter">
      <a href="mailto:DHamilton@GreenFundSolutions.com">Email: DHamilton@GreenFundSolutions.com</a>
      <br>
      <a href="tel:417-719-7517" class="navContact">Phone: (417) 719-7517</a>
      <br>
      <a href="https://www.facebook.com/ZahnFarms/" target="_blank"><i class="fab fa-facebook-square"></i></a>
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
</body>

</html>
