<?php
$cat = catByID($catID);
$aryProd = productsByCatID($catID);
?>

<h1 class="slogan">Short about us here.... <?=$cat['catName']?></h1>

<section>
    
    <!--* Category boxes-->
    <!-- TODO Style -->
    <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>

        <?php
        foreach($aryProd as $prod){
          $portion = portionByID($prod['portionsID'])
        ?>
            <a href="?catID=<?=$catID?>&prodID=<?=$prod['productID']?>">
              <!--? Put class="uk-flex-last" for out of season items -->
              <div class="uk-card uk-card-default">
                <div class="uk-card-media-top">
                  <img src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
                </div>
                <div class="uk-overlay uk-overlay-primary uk-position-bottom">
                  <p class="card-name"><?=$prod['productName']?></p>
                  <p class="card-price">$<?=$prod['price']?> <?=$portion['portionsDesc']?></p>
                </div>
              </div>
            </a>
        <?php
        }
        ?>
    </div>
</section>

