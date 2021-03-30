<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li>
                    <a class="uk-logo" href="../product/">
                        <img src="../images/Zahn Farms Logo.jpg" alt="Zahn Farms Logo">
                        <!--TODO Change logo-->
                    </a>
                </li>
                <li>
                    <a href="../product/">Products</a>
                    <div class="uk-navbar-dropdown" delay-hide="50">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?php
                            $aryCat = getAllCategories();
                            foreach($aryCat as $cat){
                            ?>
                            <li><a href="?catID=<?=$cat['catID']?>"><?=$cat['catName']?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li><a href="../aboutUs/aboutUs.php">About Us</a></li>
                <li><a href="../aboutUs/latestNews.php">Blog</a></li>
                <li><a href="../aboutUS/contact.php">Contact Us</a></li>

                <li><a href="tel:417-719-7517" class="navContact">(417) 719-7517</a></li>
                <li><a href="https://www.facebook.com/ZahnFarms/" target="_blank"><i
                            class="fab fa-facebook-square"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://twitter.com/ag_select" target="_blank"><i class="fab fa-twitter-square"></i></a>
                </li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li><a href="../product/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                <li><a href="?lo=y" class='nav' id='lo'>Sign Out</a></li>
                <li><a href="../admin/">Sign In</a></li> <!-- CHANGE! linked to admin for testing admin page -->
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