<?php
// TODO change for this site.
if (isset($modify)){

    $name = $_FILES['newImage']['name'];
    $size = $_FILES['newImage']['size'] / 1024;
    $tmpName = $_FILES['newImage']['tmp_name'];
    $dir =   getcwd() . DIRECTORY_SEPARATOR . "..";
    $dir =  $dir. DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $name;
    
    
    
// INSERT INTO `products`(`productID`, `productName`, `portionsID`, `price`, `qty`, `shortDesc`, `fullDesc`, `catID`, `image`, `sizeID`, `outOfSeason`, `hide`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    if (!empty($newProdName) && !empty($newPrice) && !empty($newQty) && !empty($name)) {
        move_uploaded_file($tmpName, $dir);
        addProduct($productName, $portionsID, $price, $qty, $shortDesc, $fullDesc, $catID, $image, $sizeID, $outOfSeason, $hide);
        echo("<h3>You must fill every box</h3>");
    }
}

?>


<form id='addForm' action="index.php" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="newProdName">Product Name:</label>
        <input type="text" class="form-control" id="newProdName" placeholder="Enter product name" name='newProdName'>
    </div>
    <div class="form-group">
        <label for="newProdName">Portion:</label>
        <input type="text" class="form-control" id="newProdName" placeholder="Enter product name" name='newProdName'>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="checkSeason">
            <label class="form-check-label" for="checkSeason">
                Sizes?
            </label>
        </div>
    </div>
    <!-- Hide price and quantity if adding sizes. Need price and quantity per size -->
    <div class="form-group">
        <label for="newProdName">Price:</label>
        <input type="text" class="form-control" id="newPrice" placeholder="Enter price" name='newPrice'>
    </div>
    <div class="form-group">
        <label for="newQty">Quantity in Stock:</label>
        <input type="number" class="form-control" id="newQty" placeholder="Enter quantity in stock" name='newQty'>
    </div>
    <div class="form-group">
        <span class="input-group-text">Short Description</span>
        <textarea class="form-control" aria-label="With textarea"></textarea>
    </div>
    <div class="form-group">
        <span class="input-group-text">Full Description</span>
        <textarea class="form-control" aria-label="With textarea"></textarea>
    </div>
    <div class="form-group">
        <label for="newProdName">Category:</label>
        <input type="text" class="form-control" id="newProdName" placeholder="Enter product name" name='newProdName'>
    </div>
    <div class="form-group">
        <label for="addImage">Image:</label>

        <div class="input-group mb-3 form-control" style='padding: 0px; height: 100%;' placeholder='Image'>
            <input type="file" id='inputBtn' class='padding: 0px; margin: 0px; width: 100%;' name='newImage'>
        </div>
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="checkSeason">
            <label class="form-check-label" for="checkSeason">
                Out of Season
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="checkHide">
            <label class="form-check-label" for="checkHide">
                Hide
            </label>
        </div>
    </div>
    
    <input type="hidden" name="modify">
    <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
    <button type="submit" class="btn btn-outline-light rounded-0">Add Product</button>

</form>