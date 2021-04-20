<?php
$cat = catByID($catID);
$aryProd = productsByCatID($catID);
$sizeAry = null;

?>

<h1 class="slogan">Short about us here</h1>

<section>
    
    <!--* Category boxes-->
    <!-- TODO Style -->
    <div class="uk-grid-small uk-child-width-1-4@s uk-child-width-1-2 uk-flex-center uk-text-center" uk-grid>

        <?php
        foreach($aryProd as $prod){
          $sizeAry = null;
          $qty = $prod['qty'];
          if ($prod['sizeID'] != null) {
            $sizeAry = sizesByID($prod['sizeID']);
            $qty = 0;
            foreach ($sizeAry as $size){
              $qty += $size['qty'];
            }
          }

          if ($prod['hide'] == 0) { /* Show unless supposed to hide */
            $portion = portionByID($prod['portionsID']);
          ?>
            <a href="?catID=<?=$catID?>&prodID=<?=$prod['productID']?>" 
              class="<?php echo(($prod['outOfSeason'] == 1 || $qty == 0) ? 'uk-flex-last' : '' )?>">
              <!--? Put class="uk-flex-last" for out of season items -->
              <!-- using Ternary if to check for out of season -->
              <div class="uk-card card-rows uk-card-default "> 
                <div class="uk-card-media-top">
                  <img class="card-image"  src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
                </div>
                
                <?php 
                if ($prod['outOfSeason'] == 1){
                ?> <!-- if out of season -->

                  <div class="uk-overlay uk-overlay-primary uk-position-cover" style="overflow:hidden">
                    <p class="card-name" style="font-weight:bold;text-decoration:underline;">OUT OF<br>SEASON</p>
                    <p class="card-name uk-position-bottom"><?=$prod['productName']?></p><br>
                  </div>

                <?php
                } else if ($qty == 0){
                ?> <!-- if out of stock -->
                  <div class="uk-overlay uk-overlay-primary uk-position-cover" style="overflow:hidden">
                    <p class="card-name" style="font-weight:bold;text-decoration:underline;">OUT OF<br>STOCK</p>
                    <div>
                      <p class="card-name uk-position-bottom"><?=$prod['productName']?></p>
                      <!-- <p class="card-price">$<?=$prod['price']?> <?=$portion['portionsDesc']?></p> -->
                    </div>
                    
                  </div>

                <?php
                } else { /* if in season & in stock*/
                  if ($prod['sizeID'] != null) {
                    $sizeAry = sizesByID($prod['sizeID']);
                  }
                }
                ?>

                <div class="uk-overlay uk-overlay-primary uk-position-bottom">
                  <p class="card-name"><?=$prod['productName']?></p>
                  <!-- <p class="card-price">$<?=$prod['price']?> <?=$portion['portionsDesc']?></p> -->
                </div>
              </div>
            </a>
        <?php  
          }
        }
        ?>
    </div>
</section>

