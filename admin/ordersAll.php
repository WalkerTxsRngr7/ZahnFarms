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
        <?php
        foreach($orders as $ord){
            $Customer = getCustomerByID($ord['customerID']);
            $OrderID = $ord["orderID"];
            $Status = $ord['status'];
            $OrderDateRow = $ord['orderDate'];
            $OrderDate = new DateTime($OrderDateRow);
            $DeliveryDateRow = $ord['deliveryDate'];
            $DeliveryDate = new DateTime($DeliveryDateRow);
            $DeliveryLocation = $ord['deliveryLocation'];
            $Total = $ord['totalPrice'];
            $orderID = $ord['orderID'];
            echo "<tr>";
            echo
            "<td>
                    <form method='post' action=''>
                        <input class='uk-button uk-button-default' type='submit' name='viewOrder' value='View'>
                        <input type='hidden' name='adminBtn' value='$adminBtn'>
                        <input type='hidden' name='orderID' value='$orderID'>
                    </form>
                </td>";
            echo "<td>$OrderID</td>";
            echo "<td>" . $Customer['lName'] . ", " . $Customer['fName'] . "</td>";
            if($Status === 1){
                echo "<td>Paid</td>";
            }
            else{
                echo "<td>Unpaid</td>";
            }
            echo "<td>";
            echo $OrderDate->format('m-d-y');
            echo  "</td>";
            echo "<td>";
            echo $DeliveryDate->format('m-d-y');
            echo  "</td>";
            echo "<td>$DeliveryLocation</td>";
            echo "<td>$" . number_format((float)$Total, 2, '.', '') . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>