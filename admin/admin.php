<?php
if (isset($_SESSION['login']) != "valid"){
    header("Location: ../admin");
}
?>

<div class="adminBtns">
    <form method="post">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <!-- <a class="nav-link active" href="#">Active</a> -->
                <button type="submit" class="<?=($adminBtn == 'add'? 'active': '')?> btn btn-outline-light rounded-0" name="adminBtn" value='add'>Add</button>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">Link</a> -->
                <button type="submit" class="<?=($adminBtn == 'edit'? 'active': '')?> btn btn-outline-light rounded-0" name="adminBtn" value='edit'>Edit</button>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">Link</a> -->
                <button type="submit" class="<?=($adminBtn == 'orders'? 'active': '')?> btn btn-outline-light rounded-0" name="adminBtn" value='orders'>Orders</button>
            </li>
        </ul>
        
        
        
    </form>
</div>

<?php

if ($adminBtn == "add"){
    include "./addForm.php";
} else if ($adminBtn == "edit"){
    include "./editForm.php";
} else if ($adminBtn == "orders"){
    include "orders.php";
} else {
    echo ("<h3 id='adminBtnAlert'>Select a tab to begin</h3>");
}




?>