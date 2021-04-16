<?php
if (isset($_SESSION['login']) != "valid"){
    header("Location: ../admin");
}
?>

<div class="admin-btns no-print">
    <form method="post">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <!-- <a class="nav-link active" href="#">Active</a> -->
                <button type="submit"
                    class="<?=($adminBtn == 'add'? 'active': '')?> btn btn-outline-light rounded-0" name="adminBtn"
                    value='add'>Add</button>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">Link</a> -->
                <button type="submit"
                    class="<?=($adminBtn == 'edit'? 'active': '')?> btn btn-outline-light rounded-0" name="adminBtn"
                    value='edit'>Edit</button>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">Link</a> -->
                <button type="submit"
                    class="<?=($adminBtn == 'orders'? 'active': '')?> btn btn-outline-light rounded-0"
                    name="adminBtn" value='orders'>Orders</button>
            </li>
        </ul>



    </form>
</div>

<div class="content-container">
<?php

if ($adminBtn == "add"){
    include "./add.php";
} else if ($adminBtn == "edit"){
    include "./edit.php";
} else if ($adminBtn == "orders"){
    include "orders.php";
} else {
    echo ("<h3 id='adminBtnAlert'>Select a tab to begin</h3>");
}
?>
</div>