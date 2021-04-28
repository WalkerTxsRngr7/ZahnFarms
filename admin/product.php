<?php
$prod = prodByID($prodID);
$portion = portionByID($prod['portionsID']);
$sizeAry = null;
$qty = $prod['qty'];
if ($prod['sizeID'] != null) {
    $sizeAry = sizesByID($prod['sizeID']);
}

// changes submitted
if (isset($modify)){
    // update image
    $name = $_FILES['newImage']['name'];
    $size = $_FILES['newImage']['size'] / 1024;
    $tmpName = $_FILES['newImage']['tmp_name'];
    $dir =   getcwd() . DIRECTORY_SEPARATOR . "..";
    $dir =  $dir. DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $name;


    // set values to 0 if not checked
    if (!$checkSeason) {
        $checkSeason = 0;
    }
    if (!$checkHide) {
        $checkHide = 0;
    }

    if ($name != ""){
        move_uploaded_file($tmpName, $dir);
        $image = $name;
    } else {
        $image = $oldImage;
    }

    // add product depending on if sizes checkbox is checked
    if ($prod['sizeID'] != null) { /* Has sizes */
        // update sizes
        updateSizes($_POST['newSize'], $prod['sizeID']);
        updateProduct($prodID, $newProdName, null, null, $newShort, $newFull, $image, $prod['sizeID'], $checkSeason, $checkHide);
    } else { /* Doesn't have sizes */
        $price = number_format((float)$newPrice, 2, '.', '');
        updateProduct($prodID, $newProdName, $newPrice, $newQty, $newShort, $newFull, $image, null, $checkSeason, $checkHide);
    }
}
?>



<!-- Form for product details that can be changed -->
<form class="uk-form-stacked admin-prod-form" action="" method="post" enctype="multipart/form-data">
    <div class="uk-grid-small uk-flex-center uk-text-center" style="width:90%; margin:auto" uk-grid>

        <!-- Product image -->
        <div class="uk-card uk-card-default uk-width-1-2@s">

            <div class="form-group">
                <img src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
                <p><?=$prod['image']?> <small>(leave blank to keep this image)</small></p>
                <input type="hidden" name="oldImage" value='<?=$prod['image']?>'>
                <div class="input-group mb-3 form-control" style='padding: 0px; height: 100%;' placeholder='Image'>
                    <input class="form-control form-control-sm" name="newImage" id="inputBtn" type="file">
                </div>
            </div>
        </div>
        <!-- Main info and buttons -->
        <div class="uk-width-1-2@s">
            <!-- Save Changes button -->
            <div class="uk-card">
                <input type="hidden" name="prodID" value="<?=$prod['productID']?>">
                <button class="uk-button uk-button-default" type="submit">Save</button>
            </div>
            <!-- Product Name -->
            <h2>
                <input class="admin-input uk-input uk-text-center" id="form-stacked-text" type="text" placeholder="Product Name" name="newProdName" value="<?=$prod['productName']?>">
                <input type="hidden" name="modify">
                <input type="hidden" name="adminBtn" value="edit">
            </h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input class="form-check-input" type="checkbox" name="checkSeason" value="1" id="checkSeason">
                    <label class="form-check-label" for="checkSeason">
                        Out of Season
                    </label>
                </div>
                <div class="col-md-4 mb-3">
                    <input class="form-check-input" type="checkbox" name="checkHide" value="1" id="checkHide">
                    <label class="form-check-label" for="checkHide">
                        Hide
                    </label>
                </div>
            </div>


            <!-- Size dropdown card -->
            <!-- only show if has a sizeID -->
            <?php if($prod['sizeID'] != null) {
            ?>
            <div class="uk-card">
                <span>Sizes</span>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="uk-form-label">Name</label>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="uk-form-label">Price</label>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="uk-form-label">Quantity</label>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label class="uk-form-label">Remove</label>
                    </div>
                </div>
                <?php 
                $i = 0;
                foreach ($sizeAry as $size) { ?>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control admin-input" placeholder="Size Name"
                            name='newSize[<?=$i?>][name]' value="<?=$size['sizeName']?>">
                        <input type="hidden" name="newSize[<?=$i?>][oldName]" value="<?=$size['sizeName']?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control admin-input" placeholder="Price"
                            name='newSize[<?=$i?>][price]' step="0.01" value="<?=$size['price']?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control admin-input" placeholder="Quantity"
                            name='newSize[<?=$i?>][qty]' value="<?=$size['qty']?>">
                    </div>
                    <div class="col-md-1 mb-3">
                        <input class="form-check-input" type="checkbox" name="newSize[<?=$i?>][del]" value="1">
                    </div>
                </div>
                <?php
                    $i++;
                }
                ?>
            </div>
            <?php
            } else { ?>
            <!-- No sizes -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="uk-form-label">Price</label>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="uk-form-label">Quantity</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="number" class="form-control admin-input" placeholder="Enter Price" name='newPrice'
                        step="0.01" value="<?=$prod['price']?>">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="number" class="form-control admin-input" placeholder="Enter Quantity in stock"
                        name='newQty' value="<?=$prod['qty']?>">
                </div>
            </div>
            <?php 
            } 
            ?>

            <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-short">
                <div class="form-group">
                    <textarea class="admin-input uk-textarea" rows="5" name="newShort"
                        placeholder="<?=$prod['shortDesc']?>" value="<?=$prod['shortDesc']?>"></textarea>
                </div>
            </div>

        </div>
        <div class="uk-card uk-card-default uk-card-body uk-width-expand product-desc-full">
            <div class="form-group">
                <textarea class="admin-input uk-textarea" rows="5" name="newFull" placeholder="<?=$prod['fullDesc']?>"
                    value="<?=$prod['fullDesc']?>"></textarea>
            </div>
        </div>

    </div>
</form>