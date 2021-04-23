<?php
    $orders = getAllOrders();
?>

<div style="width:100%;">
    <table class="orders-table uk-table uk-table-small uk-table-divider uk-table-responsive">
        <thead>
            <tr>
                <th class="uk-table-shrink" scope="col"></th>
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
        <?php
        foreach($orders as $ord){
            $Customer = getCustomerByID($ord['customerID']);
            $custID = $Customer['customerID'];
            $OrderID = $ord['orderID'];
            $Status = $ord['status'];
            $OrderDateRow = $ord['orderDate'];
            $OrderDate = $OrderDateRow;
            $DeliveryDateRow = $ord['deliveryDate'];
            $DeliveryDate = $DeliveryDateRow;
            $DeliveryLocation = $ord['deliveryLocation'];
            $Total = $ord['totalPrice'];
            $orderID = $ord['orderID'];
            echo "<tr>";
            echo
            "<td class='view-btn'>
                    <form method='post' action=''>
                        <input class='order-btn uk-button' type='submit' name='viewOrder' value='View'>
                        <input type='hidden' name='adminBtn' value='$adminBtn'>
                        <input type='hidden' name='orderID' value='$orderID'>
                        <input type='hidden' name='custID' value='$custID'>
                    </form>
                </td>";
            echo "<td>$OrderID</td>";
            echo "<td>" . $Customer['lName'] . ", " . $Customer['fName'] . "</td>";
            /* Status: Paid, Unpaid, Delivered. Give different class depending on status. status-paid, status-unpaid, status-delivered  Paid, Pay At Pickup, Delivered  Style: Paid(Blue) Unpaid(Red, underline) Delivered(Green) Border solid 3px */
            if($Status == 2){ 
                echo "<td class='delivered'>Delivered</td>";
            }
            else if($Status == 1){ 
                echo "<td class='paid'>Paid</td>";
            } else {
                echo "<td class='unpaid'>Unpaid</td>";
            }
            echo "<td>";
            echo $OrderDate;
            echo  "</td>";
            echo "<td>";
            echo $DeliveryDate;
            echo  "</td>";
            echo "<td>$DeliveryLocation</td>";
            echo "<td>$" . number_format((float)$Total, 2, '.', '') . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>