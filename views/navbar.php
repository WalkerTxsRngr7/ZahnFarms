<div class="no-print" uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
    <nav class="nav-bar uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li>
                    <a class="uk-logo" style="min-width:177px;" href="../product/">
                        <img style="" src="../images/Logo3.png" alt="Zahn Farms Logo">
                    </a>
                </li>
                <li>
                    <a href="../product/">Products</a>
                    <div class="uk-navbar-dropdown" delay-hide="250">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?php
                            $aryCat = getAllCategories();
                            foreach($aryCat as $cat){
                            ?>
                            <li><a href="../product?catID=<?=$cat['catID']?>"><?=$cat['catName']?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li><a href="../aboutUs/aboutUs.php">About Us</a></li>
                <li><a href="tel:417-719-7517" class="navContact">(417) 719-7517</a></li>
                <li><a href="https://www.facebook.com/ZahnFarms/" target="_blank"><i
                            class="fab fa-facebook-square"></i></a></li>
                </li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li><a href="../product/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                <!-- <li><a href="?lo=y" class='nav' id='lo'>Sign Out</a></li> -->
                <li><a href="../admin/">Sign In</a></li> <!-- CHANGE! linked to admin for testing admin page -->
            </ul>
        </div>
    </nav>

    <!-- Mobile Nav -->
    <nav class="nav-menu uk-navbar uk-navbar-container">
        <div class="uk-navbar-left">
            <a class="uk-navbar-toggle uk-position-center-left" uk-navbar-toggle-icon href="#offcanvas-slide" uk-toggle></a>
            <a href="../product/"></a>
            <a style="margin-right:10px;" class="cart-mobile-icon uk-position-center-right" href="../product/cart.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
        <div id="offcanvas-slide" uk-offcanvas>
            <div class="uk-offcanvas-bar">
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                    <li><a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#offcanvas-slide" uk-toggle></a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="../product/">Home</a></li>
                    <li class="uk-parent">
                        <a href="../product/">Products</a>
                        <ul class="uk-nav-sub">
                            <?php
                            $aryCat = getAllCategories();
                            foreach($aryCat as $cat){
                            ?>
                            <li><a href="../product?catID=<?=$cat['catID']?>"><?=$cat['catName']?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="../aboutUs/aboutUs.php">About Us</a></li>
                    <li><a href="tel:417-719-7517" class="navContact">(417) 719-7517</a></li>
                    <li><a href="https://www.facebook.com/ZahnFarms/" target="_blank"><i
                                class="fab fa-facebook-square"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>