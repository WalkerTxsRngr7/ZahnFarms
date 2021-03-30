<?php
$aryCat = getAllCategories();

if (isset($modify)){
        $name = $_FILES['newImage']['name'];
        $size = $_FILES['newImage']['size'] / 1024;
        $tmpName = $_FILES['newImage']['tmp_name'];
        $dir =   getcwd() . DIRECTORY_SEPARATOR . "..";
        $dir =  $dir. DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $name;

    if (!empty($newCatName)) {
        if ($name != ""){
            move_uploaded_file($tmpName, $dir);
            editCat($newCatName, $name, $catID);
        } else {
            editCat($newCatName, $oldImage, $catID);
        }
    } else {
        echo("<h3>You must fill every box</h3>");
    }
} else if (isset($edit)){
    $cat = catByID($catID);
        ?>
    <form id='editForm' action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="newCatName">Category Name:</label>
            <input type="text" class="form-control" id="newCatName" placeholder="Enter category name" name='newCatName' value="<?=$cat['catName']?>">
        </div>
        <div class="form-group">
            <label for="addImage">Image:</label>
            <br>
            <img class='editFormImg' src="../images/<?=$cat['image']?>" alt="<?=$cat['catName']?> Image">
            <p class='text-muted'><?=$cat['image']?><small class='text-muted'>(leave blank to keep this image)</small></p>
            <input type="hidden" name="oldImage" value='<?=$cat['image']?>'>
            <div class="input-group mb-3 form-control" style='padding: 0px; height: 100%;' placeholder='Image'>
                <input type="file" id='inputBtn' class='padding: 0px; margin: 0px; width: 100%;' name='newImage'>
            </div>
            <input type="hidden" name="modify">
            <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
            <input type="hidden" name="catID" value="<?=$catID?>">
            <button type="submit" class="">Edit Category</button>
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
            <div>
                <form action="" method="post">
                    
                        <!--? Put class="uk-flex-last" for out of season items -->
                        <div class="uk-card uk-card-default" value="<?=$cat['catID']?>">
                            <div class="uk-card-media-top">
                                <img src="../images/<?=$cat['image']?>" alt="<?=$cat['catName']?> Image">
                            </div>
                            <button type="submit" class="uk-overlay uk-overlay-primary uk-position-bottom uk-width-expand">
                                <p><?=$cat['catName']?></p>
                                <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                                <input type="hidden" name="catID" value="<?=$cat['catID']?>">
                            </button>
                        </div>
                </form>
                <form action="" method="post">
                    <div>
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="edit">
                        <input type="hidden" name="catID" value="<?=$cat['catID']?>">
                        <button class="uk-width-expand" type="submit">Edit</button>
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