<?php
$aryCat = getAllCategories();

if (isset($modify)){
        $name = $_FILES['newImage']['name'];
        $size = $_FILES['newImage']['size'] / 1024;
        $tmpName = $_FILES['newImage']['tmp_name'];
        $dir =   getcwd() . DIRECTORY_SEPARATOR . "..";
        $dir =  $dir. DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $name;

    // set values to 0 if not checked
    if (!$checkHide) {
        $checkHide = 0;
    }

    $newTax = number_format((float)$newTax, 3, '.', '');
    if (!empty($newCatName) && !empty($newTax)) {
        if ($name != ""){
            move_uploaded_file($tmpName, $dir);
            editCat($newCatName, $name, $newTax, $checkHide, $catID);
        } else {
            editCat($newCatName, $oldImage, $newTax, $checkHide, $catID);
        }
    } else {
        echo("<h3>You must fill every box</h3>");
    }
} else if (isset($edit)){
    $cat = catByID($catID);
        ?>
    <form id='adminForm' action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="newCatName">Category Name:</label>
            <input type="text" class="form-control" id="newCatName" placeholder="Enter category name" name='newCatName' value="<?=$cat['catName']?>" required>
        </div>
        <div>
            <label for="newTax">Tax Rate:</label>
            <input type="number" class="form-control" id="newTax" placeholder="Enter Tax Rate" name='newTax' value="<?=$cat['taxRate']?>" min="0" step="0.001" required>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkHide" value="1" id="checkHide" <?php echo ($cat['hide'] == 1? 'checked': '')?>>
            <label class="form-check-label" for="checkHide">
                Hide
            </label>
        </div>
        <hr>
        <div class="form-group">
            <label for="addImage">Image:</label>
            <br>
            <img class='editFormImg uk-width-1-2 uk-width-1-4@s' src="../images/<?=$cat['image']?>" alt="<?=$cat['catName']?> Image">
            <p><?=$cat['image']?> <small>(leave blank to keep this image)</small></p>
            <input type="hidden" name="oldImage" value='<?=$cat['image']?>'>
            <div class="input-group mb-3 form-control" style='padding: 0px; height: 100%;' placeholder='Image'>
                <!-- <input type="file" id='inputBtn' class='padding: 0px; margin: 0px; width: 100%;' name='newImage'> -->
                <input class="form-control form-control-sm" name="newImage" id="inputBtn" type="file">
            </div>
            <input type="hidden" name="modify">
            <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
            <input type="hidden" name="catID" value="<?=$catID?>">
            <button type="submit" class="uk-button">Edit Category</button>
        </div>
    </form>

<?php
}


if (!isset($edit)){
    $aryCat = getAllCategories();
    ?>

    <section>
        <!--* Category boxes-->
        <!-- TODO Style -->
        <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>

            <?php
            foreach($aryCat as $cat){
            ?>
            
            <!-- Don't show if supposed to hide -->
            <div>
                <form action="" method="post"> <!-- Go into category -->
                    
                    <!-- Put class="uk-flex-last" for out of season items -->
                    <div class="uk-card card-rows uk-card-default" value="<?=$cat['catID']?>">
                        <div class="uk-card-media-top">
                            <img class="card-image" src="../images/<?=$cat['image']?>" alt="<?=$cat['catName']?> Image">
                        </div>
                        <button type="submit" class="uk-overlay uk-overlay-primary uk-position-bottom uk-width-expand">
                            <p><?=$cat['catName']?></p>
                            <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                            <input type="hidden" name="catID" value="<?=$cat['catID']?>">
                        </button>
                    </div>
                </form>
                <form action="" method="post"> <!-- Edit Category details -->
                    <div>
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="edit">
                        <input type="hidden" name="catID" value="<?=$cat['catID']?>">
                        <button class="uk-width-expand uk-button" type="submit">Edit</button>
                    </div>
                </form>
            </div>

            <?php
            }
            ?>

        </div>
    </section>

<?php
}

?>