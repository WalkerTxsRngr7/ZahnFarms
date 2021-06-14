<?php
$delivered = filter_input(INPUT_POST, "delivered");
$order = getOrderByID($orderID);

if (isset($delivered)) {
    if ($order['deliveryLocation'] != 'Farm') {
        updateOrderDelivered($orderID, $order['deliveryDate']);
    } else {
        updateOrderDelivered($orderID, $delDate);
    }
    
}
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
        $customer = getCustomerByID($custID);
        $first = $customer['fName'];
        $last = $customer['lName'];
        $phone = $customer['phone'];
        $email = $customer['email'];

        echo "<p>Order: " . $orderID;
        echo "<p>Name: $last , $first</p>";

        $from = $phone;
        $phoneFormat = sprintf("%s-%s-%s",
              substr($from, 0, 3),
              substr($from, 3, 3),
              substr($from, 6));

        echo "<p>Phone: $phoneFormat</p>"; /* See if way to format as phone number */
        echo "<p>Email: $email</p>";
        ?>
        <p>Order Date: <?=$order['orderDate']?></p>
        <p>Delivery Date: <?=$order['deliveryDate']?></p>
        <p>Delivery Location: <?=$order['deliveryLocation']?></p>
        <p>Total: $<?=$order['totalPrice']?></p>
        <p>Status:
            <?php 
            if ($order['status'] == 2) {
                echo "<span style='color:green'>Delivered</span>";
            } else if ($order['status'] == 1) {
                echo "<span style='color:blue'>Paid</span>";
            } else {
                echo "<span style='color:red; text-decoration:underline;'>Pay At Pickup</span>";
            }?>

        </p>

        <button style="<?php echo ($order['status'] == 2 ? 'display:none' : '') ?>" class="no-print uk-button uk-button-default" uk-toggle="target: #delivered-modal" type="button">Delivered?</button>
        <!-- This is the modal -->
        <div id="delivered-modal" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title">Delivered?</h2>
                <form class="needs-validation" action="" method="post">
                    <label style="<?php echo ($order['deliveryLocation'] != 'Farm'? 'display:none' : '') ?>" for="delDate">Select Date of Pickup<input  name="delDate" type="date" id="delDate"></label>
                    
                    <input type='hidden' name='viewOrder' value='View'>
                    <input type='hidden' name='adminBtn' value='<?=$adminBtn?>'>
                    <input type='hidden' name='orderID' value='<?=$orderID?>'>
                    <input type='hidden' name='custID' value='<?=$custID?>'>
                    <input id="add-to-cart-btn" class="uk-button uk-button-default" type="submit" name="delivered" value="Mark Delivered">
                    <button class="cart-remove-btn uk-modal-close uk-button uk-button-default" type="button">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <hr>

    <!-- Print and normal versions of the same table. Make the same except normal has uk-table-responsive and print doesn't -->
    <div class="no-print uk-overflow-auto">
        <!-- Normal version -->
        <table class="admin-prod-table uk-table uk-table-small uk-table-divider uk-table-responsive">
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
                $orderDetails = getOrderDetails($orderID);
                foreach($orderDetails as $item){
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
                    echo "<tr>";
                    echo "<td>$number</td>";
                    echo "<td>$productName</td>";
                    echo "<td>$size";
                    echo "<td>$qty $portionDesc</td>";
                    echo "<td>$$price</td>";
                    echo "<td>$$linePrice</td>";
                    echo "</tr>"; 
                }
                $delFee = $order['deliveryFee'];
                number_format((float)$delFee, 2, '.', '');
                $sub = $order['subtotal'];
                number_format((float)$sub, 2, '.', '');
                $tax = $order['tax'];
                number_format((float)$tax, 2, '.', '');
                $total = $order['totalPrice'];
                number_format((float)$total, 2, '.', '');
                echo "
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Delivery Fee</td>
                            <td>$$delFee</td>
                         </tr>
                    ";
                    echo "
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Subtotal</td>
                            <td>$$sub</td>
                         </tr>
                    ";
                    echo " 
                         <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Tax</td>
                            <td>$$tax</td>
                        </tr>
                    ";
                    echo "
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> 
                            <td>Total</td>
                            <td>$$total</td>
                        </tr>
                    ";
            ?>
            </tbody>
        </table>
    </div>

    <div class="print uk-overflow-auto">
        <!-- Print version -->
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
                $orderDetails = getOrderDetails($orderID);
                foreach($orderDetails as $item){
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
                    echo "<tr>";
                    echo "<td>$number</td>";
                    echo "<td>$productName</td>";
                    echo "<td>$size";
                    echo "<td>$qty $portionDesc</td>";
                    echo "<td>$$price</td>";
                    echo "<td>$$linePrice</td>";
                    echo "</tr>"; 
                }
                $delFee = $order['deliveryFee'];
                number_format((float)$delFee, 2, '.', '');
                $sub = $order['subtotal'];
                number_format((float)$sub, 2, '.', '');
                $tax = $order['tax'];
                number_format((float)$tax, 2, '.', '');
                $total = $order['totalPrice'];
                number_format((float)$total, 2, '.', '');
                echo "
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Delivery Fee</td>
                            <td>$$delFee</td>
                         </tr>
                    ";
                    echo "
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Subtotal</td>
                            <td>$$sub</td>
                         </tr>
                    ";
                    echo " 
                         <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Tax</td>
                            <td>$$tax</td>
                        </tr>
                    ";
                    echo "
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> 
                            <td>Total</td>
                            <td>$$total</td>
                        </tr>
                    ";
            ?>
            </tbody>
        </table>
    </div>
</div>