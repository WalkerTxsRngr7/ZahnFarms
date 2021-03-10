<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zahnFarms";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

class conn{
    // check connection
    public function check_conn($servername,$username,$password,$dbname){
        $connection = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
            return "Connection failed: " . $connection->connect_error;
        }
        else{
            return "Connection Successful";
        }
    }
    // product information functions and edit once database is setup
    // public site use
    public function get_Product($product){
        $sql = "select Item From inventory WHERE Item = '$product'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                /*
                 * adding html can be done by calling the echo statement
                 * example:
                 * echo "<tr class='TableRows'>";
                 * remember this is just html code just in a php format
                 * more data can be added just a sample from my database
                 * this function can become a key to our project and more advance
                 * if you change any styling to this function its going to change the whole product page
                 * you can delete these comments once we finish the product page and add needed information
                */
                $Item = $row["Item"];
                echo $Item;
            }
        }
    }
    public function get_Product_Status($product){
        $sql = "SELECT inventory.Item,orders.Status
                FROM inventory
                INNER JOIN orders ON inventory.Item=Orders.Item Where inventory.Item = '$product'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                /*
                 * adding html can be done by calling the echo statement
                 * example:
                 * echo "<tr class='TableRows'>";
                 * remember this is just html code just in a php format
                 * more data can be added just a sample from my database
                 * this function can become a key to our project and more advance
                 * if you change any styling to this function its going to change the whole product page
                 * you can delete these comments once we finish the product page and add needed information
                */
                $Item = $row["Item"];
                $Status = $row["Status"];
                echo $Item + " - " + $Status;
            }
        }
    }
    public function getCategories(){
        $sql = "SELECT CategoryName FROM categories";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                /*
                 * adding html can be done by calling the echo statement
                 * example:
                 * echo "<tr class='TableRows'>";
                 * remember this is just html code just in a php format
                 * more data can be added just a sample from my database
                 * this function can become a key to our project and more advance
                 * if you change any styling to this function its going to change the whole product page
                 * you can delete these comments once we finish the product page and add needed information
                */
                $cat = $row["CategoryName"];
                echo $cat;
            }
        }
    }
    public function getNavbar(){
        $sql = "SELECT URL,Text FROM links";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                /*
                 * adding html can be done by calling the echo statement
                 * example:
                 * echo "<tr class='TableRows'>";
                 * remember this is just html code just in a php format
                 * more data can be added just a sample from my database
                 * this function can become a key to our project and more advance
                 * if you change any styling to this function its going to change the whole product page
                 * you can delete these comments once we finish the product page and add needed information
                */
                $link = row["URL"];
                $text = row["Text"];
                $URL = "<a href='$link'>'$text'</a>";
                echo $URL;
            }
        }
    }
    // admin functions
    public function add_New_Product($productID,$productName,$price,$quantity,$description,$categoryID,$inSeason){
        if(isset($_POST['upload_photo'])){

            $name = $_FILES['file']['name'];
            $target_dir = "127.0.0.1/Home-Server-Website/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                // Convert to base64
                $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                // Insert record
                $sql = "Insert Into inventory(productID,productName,price,quantity,description,categoryID,inSeason,img)
                values($productID,$productName,$price,$quantity,$description,$categoryID,$inSeason,$image)";
                $conn->query($sql);

                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

            }

        }
        /*
        $sql = "Insert Into inventory(productID,productName,price,quantity,description,categoryID,inSeason,img)
                values($productID,$productName,$price,$quantity,$description,$categoryID,$inSeason,$img)";
        $conn->query($sql);
        */
    }
    public function update_Product($productName,$price,$quantity,$description,$categoryID,$inSeason){
        $sql = "Update inventory SET price = '$price',quantity = '$quantity',description = '$description',categoryID = '$categoryID',inSeason = '$inSeason'
                WHERE productName = '$productName'";
        $conn->query($sql);
    }
    public function inSeason($productName){
        // price
        $priceSql = "Select price from inventory where productName = '$productName'";
        $priceResult = $conn->query($priceSql);
        $PriceRow = $priceResult->fetch_assoc();
        // quantity
        $quantitySql = "Select quantity from inventory where productName = '$productName'";
        $quantityResult = $conn->query($quantitySql);
        $quantityRow = $quantityResult->fetch_assoc();
        // description
        $descriptionSql = "Select description from inventory where productName = '$productName'";
        $descriptionResult = $conn->query($descriptionSql);
        $descriptionRow = $descriptionResult->fetch_assoc();
        // categoryID
        $categoryIDSql = "Select categoryID from inventory where productName = '$productName'";
        $categoryIDResult = $conn->query($categoryIDSql);
        $categoryIDRow = $categoryIDResult->fetch_assoc();
        // query
        $this->update_Product($productName,$priceResult["price"],$quantityResult["quantity"],$descriptionResult["description"],$categoryIDResult["categoryID"],"1");
    }
    public function offSeason($productName){
        // price
        $priceSql = "Select price from inventory where productName = '$productName'";
        $priceResult = $conn->query($priceSql);
        $PriceRow = $priceResult->fetch_assoc();
        // quantity
        $quantitySql = "Select quantity from inventory where productName = '$productName'";
        $quantityResult = $conn->query($quantitySql);
        $quantityRow = $quantityResult->fetch_assoc();
        // description
        $descriptionSql = "Select description from inventory where productName = '$productName'";
        $descriptionResult = $conn->query($descriptionSql);
        $descriptionRow = $descriptionResult->fetch_assoc();
        // categoryID
        $categoryIDSql = "Select categoryID from inventory where productName = '$productName'";
        $categoryIDResult = $conn->query($categoryIDSql);
        $categoryIDRow = $categoryIDResult->fetch_assoc();
        // query
        $this->update_Product($productName,$priceResult["price"],$quantityResult["quantity"],$descriptionResult["description"],$categoryIDResult["categoryID"],"0");
    }
    // admin  functions and public site functions
    public function add_inventory($productName,$quantity){
        // math
        $preSql = "Select quantity from inventory where productName = '$productName'";
        $preResult = $conn->query($preSql);
        $preRow = $preResult->fetch_assoc();
        $total = $preRow["quantity"] + $quantity;
        // query
        $sql = "Update inventory SET quantity = '$total' WHERE productName = '$productName'";
        $conn->query($sql);
    }
    public function subtract_inventory($productName,$quantity){
        // math
        $preSql = "Select quantity from inventory where productName = '$productName'";
        $preResult = $conn->query($preSql);
        $preRow = $preResult->fetch_assoc();
        $total = $preRow["quantity"] - $quantity;
        // query
        $sql = "Update inventory SET quantity = '$total' WHERE productName = '$productName'";
        $conn->query($sql);
    }
}
$status = new conn();
// guide
// $status->check_conn("localhost","root","","zahnFarms");
//$status->get_Product("Zoie Mug");
//$status->get_Product_Status("Zoie Mug");
//$status->getCategories();
//$status->getNavbar();
//$status->add_New_Product("1","Carrot","2.00","10","Nice healthy veggie","veggie","0");
//$status->update_Product("carrot","2.00","15","Nice healthy veggie","veggie","1");
//$status->inSeason("Carrot");
//$status->offSeason("Carrot");
//$status->add_inventory("Carrot","5");
//$status->subtract_inventory("Carrot","5");
?>