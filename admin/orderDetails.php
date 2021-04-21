<?php
    $orders = getAllOrders();
?>

<!-- example -->
<?php
// foreach ($orders as $order ) {
//     echo("
//     <tr>
//         <th scope='row'>$order[orderID]</th>
//         <td>$order[customerName]</td>
//         <td>$order[productID]</td>
//         <td>$order[qtyOrdered]</td>
//     </tr>");
// }
?>



<div style="width:90%; margin:auto">
    <div class="print">
        <p>Zahn Farms</p>
        <p>417-719-7517</p>
        <p>bzahn01@yahoo.com</p>
        <p>9018 State Hwy W, Elkland, MO 65644</p>
    </div>
    <hr class="print">
    <div class="uk-column-1-2 uk-column-divider">
        <?php
        $Customer = getCustomerByID($_POST['orderID']);
        $first = $Customer['fName'];
        $last = $Customer['lName'];
        $phone = $Customer['phone'];
        $email = $Customer['email'];

        echo "<p>Order: " . $_POST['orderID'];
        echo "<p>Name: $last , $first</p>";
        echo "<p>Phone: $phone</p>"; /* See if way to format as phone number */
        echo "<p>Email: $email</p>";
        ?>
        <p>Order Date: 4/1/2021</p>
        <p>Delivery Date: 4/5/2021 3:00PM</p>
        <p>Delivery Location: Farm</p>
        <p>Total: $27.97</p>
        <p style="text-decoration:underline;">Status: Pay At Pickup</p>  <!-- Paid, Pay At Pickup, Delivered  Style: Paid(Blue) Unpaid(Red, underline) Delivered(Green)--> 
        <button class="no-print uk-button uk-button-default">Delivered?</button> <!-- To change status to delivered -->
    </div>
    <hr>

    <!-- Print and normal versions of the same table. Make the same except normal has uk-table-responsive and print doesn't -->
    <div class="no-print uk-overflow-auto"> <!-- Normal version -->
        <table class="uk-table uk-table-small uk-table-divider uk-table-striped uk-table-responsive">
            <thead>
                <tr>
                    <th class="uk-table-shrink" scope="col">Order Line Number</th> <!-- order Line number -->
                    <th scope="col">Product</th>
                    <th scope="col">Size</th> 
                    <th scope="col">Quantity</th> 
                    <th scope="col">Item Price</th>
                    <th scope="col">Line Price</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $order = getOrderDetails($_POST['orderID']);
                foreach($order as $item){
                    $number = 1;
                    $prod = prodByID($item['productID']);
                    $productName = $prod['productName'];
                    $qty = $item['quantityOrdered'];
                    $portion = portionByID($prod['portionsID']);
                    $portionDesc = $portion['portionsDesc'];
                    $size = $item['sizeName'];
                    $price = $item['priceEach'];
                    $linePrice = $qty * $price;
                    $linePrice = number_format((float)$linePrice, 2, '.', '');

                    // products rows
                    echo "<tr>";
                    echo "<td>$number</td>";
                    echo "<td>$productName</td>";
                    echo "<td>$size";
                    echo "<td>$qty $portionDesc</td>";
                    echo "<td>$$price</td>";
                    echo "<td>$$linePrice</td>";
                    echo "</tr>";
                }
            ?>
            <?php
                $amounts = getOrdersByID($_POST['orderID']);
                $sub = $amounts['subtotal'];
                $delv = $amounts['deliveryFee'];
                $tax = $amounts['tax'];
                $total = $amounts['total'];
                echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal</td>
                    <td>$sub</td>
                </tr>
                ";
                echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tax</td>
                    <td>$tax</td>
                </tr>
                ";
                echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td> 
                    <td></td> 
                    <td>Total</td>
                    <td>$total</td>
                </tr>
                "
            ?>
            </tbody>
        </table>
    </div>

    <div class="print uk-overflow-auto"> <!-- Print version -->
        <table class="uk-table uk-table-small uk-table-divider">
            <thead>
                <tr>
                    <th class="uk-table-shrink" scope="col">Order Line Number</th> <!-- order Line number -->
                    <th scope="col">Product</th>
                    <th scope="col">Size</th> 
                    <th scope="col">Quantity</th> 
                    <th scope="col">Item Price</th>
                    <th scope="col">Line Price</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $order = getOrderDetails($_POST['orderID']);
            foreach($order as $item){
                $number = 1;
                $prod = prodByID($item['productID']);
                $productName = $prod['productName'];
                $qty = $item['quantityOrdered'];
                $portion = portionByID($prod['portionsID']);
                $portionDesc = $portion['portionsDesc'];
                $size = $item['sizeName'];
                $price = $item['priceEach'];
                $linePrice = $qty * $price;
                $linePrice = number_format((float)$linePrice, 2, '.', '');

                // products rows
                echo "<tr>";
                echo "<td>$number</td>";
                echo "<td>$productName</td>";
                echo "<td>$size";
                echo "<td>$qty $portionDesc</td>";
                echo "<td>$$price</td>";
                echo "<td>$$linePrice</td>";
                echo "</tr>";
            }
            ?>
            <?php
            $amounts = getOrdersByID($_POST['orderID']);
            $sub = $amounts['subtotal'];
            $delv = $amounts['deliveryFee'];
            $tax = $amounts['tax'];
            $total = $amounts['total'];
            echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal</td>
                    <td>$sub</td>
                </tr>
                ";
            echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tax</td>
                    <td>$tax</td>
                </tr>
                ";
            echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td> 
                    <td></td> 
                    <td>Total</td>
                    <td>$total</td>
                </tr>
                "
            ?>
            </tbody>
        </table>
    </div>
</div>
