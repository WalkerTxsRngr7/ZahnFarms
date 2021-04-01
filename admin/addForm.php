<?php
// TODO change for this site.
if (isset($modify)){

    $name = $_FILES['newImage']['name'];
    $size = $_FILES['newImage']['size'] / 1024;
    $tmpName = $_FILES['newImage']['tmp_name'];
    $dir =   getcwd() . DIRECTORY_SEPARATOR . "..";
    $dir =  $dir. DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $name;
    
    
    

    if (!empty($newProdName) && !empty($newPrice) && !empty($newQty) && !empty($name)) {
        move_uploaded_file($tmpName, $dir);
        addProduct($newProdName, $newPrice, $newQty, $name);
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
        <label for="newProdName">Price:</label>
        <input type="text" class="form-control" id="newPrice" placeholder="Enter price" name='newPrice'>
    </div>
    <div class="form-group">
        <label for="newQty">Quantity in Stock:</label>
        <input type="text" class="form-control" id="newQty" placeholder="Enter quantity in stock" name='newQty'>
    </div>
    <div class="form-group">
        <label for="addImage">Image:</label>

        <div class="input-group mb-3 form-control" style='padding: 0px; height: 100%;' placeholder='Image'>
            <input type="file" id='inputBtn' class='padding: 0px; margin: 0px; width: 100%;' name='newImage'>
        </div>

    </div>
    <input type="hidden" name="modify">
    <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
    <button type="submit" class="btn btn-outline-light rounded-0">Add Product</button>

</form>