<?php
$aryCat = getAllCategories();
?>

<h1 class="slogan">Short about us here</h1>
 
<section>
    <!--* Category boxes-->
    <!-- TODO Style -->
    <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center uk-grid-match" uk-grid>

        <?php
        foreach($aryCat as $cat){
        ?>
            
            <!-- TODO Created dynamically from database -->
            <a href="?catID=<?=$cat['catID']?>">
                <!--? Put class="uk-flex-last" for out of season items -->
                <div class="uk-card card-rows uk-card-default" value="<?=$cat['catID']?>">
                    <div class="uk-card-media-top">
                        <img class="card-image" src="../images/<?=$cat['image']?>" alt="<?=$cat['catName']?> Image">
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