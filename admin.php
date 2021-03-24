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

    <div class="admin-prod-container">
        <!-- Individual Product -->
        <div class="admin-prod-row">
            <form action="admin.php" method="get">
                <input type="hidden" name="productID" value="1"> <!-- value="<?=$product['productID']?>" -->
                <div class="uk-flex-center uk-text-center uk-flex-middle uk-child-width-expand@m" uk-grid>
                    <div class="uk-card uk-card-default uk-width-1-5@m">
                        <img src="images/beef.jpg" alt="beef image">
                    </div>
                    <div>
                        <h3>Product Name</h3>
                    </div>
                    <div>
                        <h3>Price</h3>
                    </div>
                    <div>
                      <a class="uk-button uk-button-default" href="adminProduct.php">Edit</a>
                    </div>
                    <div class="admin-prod-row-checkbox uk-flex uk-flex-column ">
                        <label class="uk-form-label"><input name="hide" value="1" class="uk-checkbox" type="checkbox"> Hide</label>
                        <label class="uk-form-label"><input name="outofseason" value="1" class="uk-checkbox" type="checkbox"> Out Of Season</label>
                    </div>
                    <div>
                        <Button class="uk-button" type="submit">Save</Button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="admin-prod-row">
            <form action="admin.php" method="get">
                <div class="uk-flex-center uk-text-center uk-flex-middle uk-child-width-expand@m" uk-grid>
                    <div class="uk-card uk-card-default uk-width-1-5@m">
                        <img src="images/beef.jpg" alt="beef image">
                    </div>
                    <div>
                        <h3>Product Name</h3>
                    </div>
                    <div>
                        <h3>Price</h3>
                    </div>
                    <div>
                        <Button class="uk-button">Edit</Button>
                    </div>
                    <div class="admin-prod-row-checkbox uk-flex uk-flex-column ">
                        <label class="uk-form-label"><input class="uk-checkbox" type="checkbox"> Hide</label>
                        <label class="uk-form-label"><input class="uk-checkbox" type="checkbox"> Out Of Season</label>
                    </div>
                    <div>
                        <Button class="uk-button" type="submit">Save</Button>
                    </div>
                </div>
            </form>
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
