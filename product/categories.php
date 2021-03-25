<h1 class="slogan">Short about us here</h1>
 
<section>

    <?php
    $aryCat = getAllCategories();
    ?>
    <!--* Category boxes-->
    <!-- TODO Style -->
    <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>

        <?php
        foreach($aryCat as $cat){
        ?>
            
            <!-- TODO Created dynamically from database -->
            <a href="?catID=<?=$cat['catID']?>">
                <!--? Put class="uk-flex-last" for out of season items -->
                <div class="uk-card uk-card-default" value="<?=$cat['catID']?>">
                    <div class="uk-card-media-top">
                        <img src="../images/<?=$cat['image']?>" alt="<?=$cat['catName']?> Image">
                    </div>
                    <div class="uk-overlay uk-overlay-primary uk-position-bottom">
                        <p><?=$cat['catName']?></p>
                    </div>
                </div>
            </a>

        <?php
        }
        ?>

    </div>
</section>





<!-- <div class="card prodCard">
    <img src="../images/<?=$cat['image']?>" class="card-img-top" alt="<?=$cat['catName']?>">
    <div class="card-body prodCardBody">
        <h5 class="card-title"><?=$cat['catName']?></h5>
        <form action="cart.php" method="get">
            <div class="input-group prodQtyBtn">
                <input type="hidden" name='productID' value='<?=$product['productID']?>'>
                <input type="number" class='form-control rounded-0' name="qty" min="1" max="<?=$product['qty']?>"
                    placeholder='Qty:'>
                <div class="input-group-append">
                    <button class="btn btn-outline-light rounded-0" type="submit">Cart</button>
                </div>
            </div>
        </form>
        <p class="card-text qty"><small class="text-muted">In Stock: <?=$product['qty']?></small></p>
    </div>
</div> -->