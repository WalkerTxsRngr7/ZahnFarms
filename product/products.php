<?php
$cat = catByID($catID);
$aryProd = productsByCatID($catID);
?>

<h1 class="slogan">Short about us here</h1>

<section>
    
    <!--* Category boxes-->
    <!-- TODO Style -->
    <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>

        <?php
        foreach($aryProd as $prod){
          $portion = portionByID($prod['portionsID']);
          if ($prod['hide'] == 0) { /* Show unless supposed to hide */
        ?>
            <a href="?catID=<?=$catID?>&prodID=<?=$prod['productID']?>">
              <!--? Put class="uk-flex-last" for out of season items -->
              <!-- using Ternary if to check for out of season -->
              <div class="uk-card uk-card-default <?php echo($prod['outOfSeason'] == 1 ? 'uk-flex-last' : '' )?>"> 
                <div class="uk-card-media-top">
                  <img src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
                </div>
                
                <?php 
                if ($prod['outOfSeason'] == 1){
                ?> <!-- if out of season -->

                <div class="uk-overlay uk-overlay-primary uk-position-cover" style="overflow:hidden">
                  <p class="card-name" style="font-weight:bold;text-decoration:underline;">OUT OF<br>SEASON</p>
                  <p class="card-name"><?=$prod['productName']?></p>
                  <p class="card-price">$<?=$prod['price']?> <?=$portion['portionsDesc']?></p>
                </div>

                <?php
                } else { /* if in season */
                ?>

                <div class="uk-overlay uk-overlay-primary uk-position-bottom">
                  <p class="card-name"><?=$prod['productName']?></p>
                  <p class="card-price">$<?=$prod['price']?> <?=$portion['portionsDesc']?></p>
                </div>
                <?php 
                }
                ?>
              </div>
            </a>
        <?php  
          }
        }
        ?>
    </div>
</section>

