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


<div style="width:80%; margin:auto">
    <table class="uk-table uk-table-small uk-table-hover uk-table-striped uk-table-responsive">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th> 
                <th scope="col">Status</th>
                <th scope="col">Order Date</th>
                <th scope="col">Delivery Date</th>
                <th scope="col">Delivery Location</th>
                <th scope="col">Total</th> <!-- May add another field to the table for unpaid total -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <form method="post" action="">
                        <input class="uk-button uk-button-default" type="submit" name="viewOrder" value="View">
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="orderID" value="<?=$order['orderID']?>">
                    </form>
                </td>
                <td>1</td>
                <td>Doe, John</td> <!-- Put Last Name, First Name -->
                <td>Paid</td> <!-- Status: Paid, Unpaid, Delivered. Give different class depending on status. status-paid, status-unpaid, status-delivered --> <!-- Paid, Pay At Pickup, Delivered  Style: Paid(Blue) Unpaid(Red, underline) Delivered(Green) Border solid 3px--> 
                <td>4/1/2021</td> 
                <td>4/5/2021 3:00PM</td> <!-- Put Date and time together -->
                <td>Farm</td>
                <td>$79.99</td>
            </tr>
            <tr>
                <td>
                    <form method="post" action="">
                        <input class="uk-button uk-button-default" type="submit" name="viewOrder" value="View">
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="orderID" value="<?=$order['orderID']?>">
                    </form>
                </td>
                <td>1</td>
                <td>Doe, John</td> <!-- Put Last Name, First Name -->
                <td>Paid</td> <!-- Status: Paid, Unpaid, Delivered. Give different class depending on status. status-paid, status-unpaid, status-delivered -->
                <td>4/1/2021</td> 
                <td>4/5/2021 3:00PM</td> <!-- Put Date and time together -->
                <td>Farm</td>
                <td>$79.99</td>
            </tr>
            <tr>
                <td>
                    <form method="post" action="">
                        <input class="uk-button uk-button-default" type="submit" name="viewOrder" value="View">
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="orderID" value="<?=$order['orderID']?>">
                    </form>
                </td>
                <td>1</td>
                <td>Doe, John</td> <!-- Put Last Name, First Name -->
                <td>Paid</td> <!-- Status: Paid, Unpaid, Delivered. Give different class depending on status. status-paid, status-unpaid, status-delivered -->
                <td>4/1/2021</td> 
                <td>4/5/2021 3:00PM</td> <!-- Put Date and time together -->
                <td>Farm</td>
                <td>$79.99</td>
            </tr>
            <tr>
                <td>
                    <form method="post" action="">
                        <input class="uk-button uk-button-default" type="submit" name="viewOrder" value="View">
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="orderID" value="<?=$order['orderID']?>">
                    </form>
                </td>
                <td>1</td>
                <td>Doe, John</td> <!-- Put Last Name, First Name -->
                <td>Paid</td> <!-- Status: Paid, Unpaid, Delivered. Give different class depending on status. status-paid, status-unpaid, status-delivered -->
                <td>4/1/2021</td> 
                <td>4/5/2021 3:00PM</td> <!-- Put Date and time together -->
                <td>Farm</td>
                <td>$79.99</td>
            </tr>
            <tr>
                <td>
                    <form method="post" action="">
                        <input class="uk-button uk-button-default" type="submit" name="viewOrder" value="View">
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="orderID" value="<?=$order['orderID']?>">
                    </form>
                </td>
                <td>1</td>
                <td>Doe, John</td> <!-- Put Last Name, First Name -->
                <td>Paid</td> <!-- Status: Paid, Unpaid, Delivered. Give different class depending on status. status-paid, status-unpaid, status-delivered -->
                <td>4/1/2021</td> 
                <td>4/5/2021 3:00PM</td> <!-- Put Date and time together -->
                <td>Farm</td>
                <td>$79.99</td>
            </tr>
            <tr>
                <td>
                    <form method="post" action="">
                        <input class="uk-button uk-button-default" type="submit" name="viewOrder" value="View">
                        <input type="hidden" name="adminBtn" value="<?=$adminBtn?>">
                        <input type="hidden" name="orderID" value="<?=$order['orderID']?>">
                    </form>
                </td>
                <td>1</td>
                <td>Doe, John</td> <!-- Put Last Name, First Name -->
                <td>Paid</td> <!-- Status: Paid, Unpaid, Delivered. Give different class depending on status. status-paid, status-unpaid, status-delivered -->
                <td>4/1/2021</td> 
                <td>4/5/2021 3:00PM</td> <!-- Put Date and time together -->
                <td>Farm</td>
                <td>$79.99</td>
            </tr>
        </tbody>
    </table>
</div>