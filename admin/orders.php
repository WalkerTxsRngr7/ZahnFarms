<?php
    $orders = getAllOrders();
?>

<table class="table table-striped table-dark">
  <thead class="thead-light">
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Product ID</th>
      <th scope="col">Qty Ordered</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($orders as $order ) {
    echo("
    <tr>
        <th scope='row'>$order[orderID]</th>
        <td>$order[customerName]</td>
        <td>$order[productID]</td>
        <td>$order[qtyOrdered]</td>
    </tr>");
}
?>
  </tbody>
</table>