<?php
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";
include '../models/requests.php';

// if (!isset($catID)){
//     include "categories.php";
// }
// else if (!isset($prodID)) {
//     include "products.php";
// }
// else {
//     include "product.php";
// }
?>

<div class='content-container'>
  <div class="uk-column-1-2@m">
    <div class=about>
      <h1 class="slogan">Short about us here</h1>
      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        Excepteur
        sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        Duis
        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
        occaecat cupidatat non proident. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.
      </p>
    </div>

    <div class=about-fb">
      <div class="fb-page" data-href="https://www.facebook.com/ZahnFarms/" data-tabs="timeline" data-width="500"
        data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false"
        data-show-facepile="true">
        <blockquote cite="https://www.facebook.com/ZahnFarms/" class="fb-xfbml-parse-ignore"><a
            href="https://www.facebook.com/ZahnFarms/">Zahn Farms</a></blockquote>
      </div>
    </div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0"
      nonce="SPVF6MS7"></script>



  </div>
</div>





<?php
  include "../views/footer.php";
?>