<?php
if (isset($modify)){
    $newImage = $_FILES['newImage'];

    if (!empty($newProdName) && !empty($portionsID) &&!empty($newShort) &&!empty($newFull) &&!empty($catID) && !empty($newImage)) {
        if($_FILES['newImage']['name'])
        {
            //if no errors...
            if(!$_FILES['newImage']['error'])
            {
                //now is the time to modify the future file name and validate the file
                $name = $_FILES['newImage']['name'];
                // $new_file_name = strtolower($_FILES['newImage']['tmp_name']); //rename file
                $tmpName = $_FILES['newImage']['tmp_name'];
                //move it to where we want it to be
                $dir =   getcwd() . DIRECTORY_SEPARATOR . "..";
                $dir =  $dir. DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $name;
                move_uploaded_file($tmpName, $dir);
            }
            //if there is an error...
            else
            {
                //set that to be the returned message
                echo 'Ooops! Your upload triggered the following error: '.$_FILES['newImage']['error'];
            }
        }

        // set values to 0 if not checked
        if (!$checkSeason) {
            $checkSeason = 0;
        }
        if (!$checkHide) {
            $checkHide = 0;
        }
        // add product depending on if sizes checkbox is checked
        if ($checkSizes) { /* Has sizes */
            // create sizes
            $sizeID = addSizes($_POST['newSize']);
            addProduct($newProdName, $portionsID, null, null, $newShort, $newFull, $catID, $_FILES['newImage']['name'], $sizeID, $checkSeason, $checkHide);
        } else { /* Doesn't have sizes */
            addProduct($newProdName, $portionsID, $newPrice, $newQty, $newShort, $newFull, $catID, $_FILES['newImage']['name'], null, $checkSeason, $checkHide);
        }
        
    } else {
        echo("<h3>You must fill every box</h3>");
    }

    // if ($checkSizes)
    // foreach ($_POST['newSize'] as $size) {
    //     echo "<h3>" . $size['name'] . "</h3><br>";
    // }
}

?>


<form id='addForm' action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="newProdName">Product Name:</label>
        <input type="text" class="form-control" id="newProdName" placeholder="Enter product name" name='newProdName' required>
    </div>
    <hr>
    <!-- Portions Select -->
    <div class="form-group row"> 
        <div class="col-md-3 mb-3">
            <label>Portion:</label>
            <select name="portionsID" class="uk-select" required>
                <option>Please select...</option>
                <?php
                $portionsAry = getAllPortions();
                foreach ($portionsAry as $portion){
                ?>
                <option value="<?=$portion['portionsID']?>"><?=$portion['portionsName']?>:   <?=$portion['portionsDesc']?></option>

                <?php
                }
                ?>
            </select>
        </div>
    </div>
    <hr>

    <!-- Sizes -->
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkSizes" id="checkSizes">
            <label class="form-check-label" for="checkSizes">
                Sizes?
            </label>
        </div>
    </div>
    <div id="sizes-container" style="display:none;">
        <!-- newSize[0] -->
        <label>Size 1</label>
        <div id="mainsection" class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" placeholder="Enter Size Name" name='newSize[0][name]'>
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Price" name='newSize[0][price]' step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Quantity in stock" name='newSize[0][qty]'>
            </div>
        </div>
        <!-- newSize[1] -->
        <label>Size 2</label>
        <div id="mainsection" class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" placeholder="Enter Size Name" name='newSize[1][name]'>
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Price" name='newSize[1][price]' step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Quantity in stock" name='newSize[1][qty]'>
            </div>
        </div>
        <!-- newSize[2] -->
        <label>Size 3 <small>(Optional)</small></label>
        <div id="mainsection" class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" placeholder="Enter Size Name" name='newSize[2][name]'>
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Price" name='newSize[2][price]' step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Quantity in stock" name='newSize[2][qty]'>
            </div>
        </div>
        <!-- newSize[3] -->
        <label>Size 4 <small>(Optional)</small></label>
        <div id="mainsection" class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" placeholder="Enter Size Name" name='newSize[3][name]'>
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Price" name='newSize[3][price]' step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Quantity in stock" name='newSize[3][qty]'>
            </div>
        </div>
        <!-- newSize[4] -->
        <label>Size 5 <small>(Optional)</small></label>
        <div id="mainsection" class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" placeholder="Enter Size Name" name='newSize[4][name]'>
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Price" name='newSize[4][price]' step="0.01">
            </div>
            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" placeholder="Enter Quantity in stock" name='newSize[4][qty]'>
            </div>
        </div>
    </div>
    <script>
        // display/hide size options
        document.getElementById("checkSizes").onclick = function () {
            if (document.getElementById('checkSizes').checked == true) {
                document.getElementById("sizes-container").style = "display:default;";
                document.getElementById("noSizes").style = "display:none;";
            } else {
                document.getElementById("sizes-container").style = "display:none;";
                document.getElementById("noSizes").style = "display:default;";
            }
        }
    </script>

    <div id="noSizes" class="row">
        <div class="col-md-6 mb-3">
            <label for="newSizePrice">Price:</label>
            <input type="number" class="form-control" id="newPrice" placeholder="Enter price" name='newPrice' step="0.01">
            <div class="invalid-feedback">
                Valid last name is required.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="newQty">Quantity in Stock:</label>
            <input type="number" class="form-control" id="newQty" placeholder="Enter quantity in stock" name='newQty'>
            <div class="invalid-feedback">
                Valid last name is required.
            </div>
        </div>
    </div>
    <hr>

    <!-- Descriptions -->
    <div class="form-group">
        <span class="input-group-text">Short Description</span>
        <textarea class="form-control" aria-label="With textarea" name="newShort" required></textarea>
    </div>
    <div class="form-group">
        <span class="input-group-text">Full Description</span>
        <textarea class="form-control" aria-label="With textarea" name="newFull" required></textarea>
    </div>

    <!-- Category Select -->
    <div class="form-group row"> 
        <div class="col-md-3 mb-3">
            <label>Category:</label>
            <select name="catID" class="uk-select" required>
                <option>Please select...</option>
                <?php
                $catAry = getAllCategories();
                foreach ($catAry as $cat){
                ?>
                <option value="<?=$cat['catID']?>"><?=$cat['catName']?></option>

                <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="formFileSm" class="form-label">Image:</label>
        <input class="form-control form-control-sm" name="newImage" id="formFileSm" type="file">
        <!-- <label for="addImage">Image:</label>
        <div uk-form-custom>
            <input type="file" required>
            <button class="uk-button uk-button-default" type="button" tabindex="-1" name='newImage'>Select</button>
        </div> -->
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkSeason" value="1" id="checkSeason">
            <label class="form-check-label" for="checkSeason">
                Out of Season
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkHide" value="1" id="checkHide">
            <label class="form-check-label" for="checkHide">
                Hide
            </label>
        </div>
    </div>

    <!-- <input type="hidden" name="modify"> -->
    <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
    <button type="submit" name="modify" class="uk-button">Add Product</button>

</form>