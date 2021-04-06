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
        <p>Order #: 13</p>
        <p>Name: Doe, John</p>
        <p>Phone: 417-745-3375</p>
        <p>Email: bobsmith@gmail.com</p>
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
                <tr>
                    <td>1</td>
                    <td>Beef</td>
                    <td>Small (1-1.5 lbs)</td>
                    <td>4 lbs</td> <!-- need to show portion -->
                    <td>$5.99</td>
                    <td>$19.99</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Beef</td>
                    <td>Small (1-1.5 lbs)</td>
                    <td>4 lbs</td> <!-- need to show portion -->
                    <td>$5.99</td>
                    <td>$19.99</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal</td>
                    <td>$15.99</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tax</td>
                    <td>$2.99</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> 
                    <td>Total</td>
                    <td>$20.99</td>
                </tr>
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
                <tr>
                    <td>1</td>
                    <td>Beef</td>
                    <td>Small (1-1.5 lbs)</td>
                    <td>4 lbs</td> <!-- need to show portion -->
                    <td>$5.99</td>
                    <td>$19.99</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Beef</td>
                    <td>Small (1-1.5 lbs)</td>
                    <td>4 lbs</td> <!-- need to show portion -->
                    <td>$5.99</td>
                    <td>$19.99</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal</td>
                    <td>$15.99</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tax</td>
                    <td>$2.99</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> 
                    <td>Total</td>
                    <td>$20.99</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
