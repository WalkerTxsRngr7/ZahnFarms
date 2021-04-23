<?php
$aryProd = productsByCatID($catID);
?>
<div class="admin-prod-container">
  <table class="admin-prod-table uk-table uk-table-small uk-table-divider uk-table-responsive">
    <thead>
      <tr>
        <th class="uk-table-shrink" scope="col"></th>
        <th class="uk-table-expand" scope="col"></th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Sizes</th>
        <th class="uk-table-shrink" scope="col">Stock</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($aryProd as $prod){ /* foreach product */
        $portion = portionByID($prod['portionsID']);
      ?>
      <tr>
        <td>
          <form method='post' action=''>
            <Button class="uk-button uk-button-default" type="submit">Edit</Button>
            <input type="hidden" name="prodID" value="<?=$prod['productID']?>">
            <input type='hidden' name='adminBtn' value='<?=$adminBtn?>'>
          </form>
        </td>
        <td>
          <img class="uk-width-small" src="../images/<?=$prod['image']?>" alt="<?=$prod['productName']?> Image">
        <td><?=$prod['productName']?></td>
        <td class="uk-text-nowrap">
          <?php
          if ($prod['sizeID'] != null) { /* if has sizes */
            $sizeAry = sizesByID($prod['sizeID']); 
            foreach ($sizeAry as $size){ /* price and portion for each size */
            ?>
          $<?=$size['price']?>
          <?=$portion['portionsDesc']?>
          <br>
          <?php } ?>
        </td>
        <td class="uk-text-nowrap">
          <?php
              foreach ($sizeAry as $size){ /* Sizename for each size */
            ?>
          <?=$size['sizeName']?>
          <br>
          <?php } ?>
        </td>
        <td>
          <?php
          foreach ($sizeAry as $size){ /* Stock for each size */
          ?>
          <?=$size['qty']?>
          <br>
          <?php } ?>

          <?php 
          } else { /* doesnt have sizes */
          ?>
          $<?=$size['price']?>
          <?=$portion['portionsDesc']?>
        </td>
        <td>
        </td>
        <td>
          <?=$size['qty']?>
          <?php } ?>
        </td>
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>