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
                            <?php
                            $servername = "127.0.0.1";
                            $username = "root";
                            // $password = "arizona";
                            // $dbname = "teaching";
                            $password = "";
                            $dbname = "zahnFarms";
                            
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
                <li><a href="aboutUs.php">About Us</a></li>
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
                <li><a href="admin.php">Sign In</a></li> <!-- CHANGE! linked to admin for testing admin page -->
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