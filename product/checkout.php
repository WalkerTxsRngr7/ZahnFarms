<!-- Choose location first -->
<!-- Locations: 
Springfield: $10 delivery fee, none on others. Sam's Club E. Sunshine. Wednesday 4-4:30PM.  Monday latest for same Wednesday delivery
Marshfield: Farmer's Market, ...address... Friday 2:30-6:30PM.  Wednesday latest for this Friday delivery
Farm in Elkland: 9018 St Hwy W, Elkland, MO Mon-Sat by appt. Call or email.
 -->

<!-- If unknownPounds or unknown total pay all at once at pickup. -->



<?php
if (!isset($_SESSION)) { /* check if session is created */
  session_start();
}
if (!isset($_SESSION['cart'])){ /* check if cart is created in session */
  $_SESSION['cart'] = array();
}
 
$title = "Home";
$headTitle = "Zahn Farms";
include "../views/header.php";

$payOnline = true;
$itemCnt = count($_SESSION['cart']);
$delFee = 0;
$subtotal = 0;
$tax = 0;
$total = 0;
$delTime = "";

$email = null;
$address2 = null;

$custID = filter_input(INPUT_POST, "custID");
$fName = filter_input(INPUT_POST, "fName");
$lName = filter_input(INPUT_POST, "lName");
$address1 = filter_input(INPUT_POST, "address1");
$address2 = filter_input(INPUT_POST, "address2");
$phone = filter_input(INPUT_POST, "phone");
$email = filter_input(INPUT_POST, "email");
$city = filter_input(INPUT_POST, "city");
$state = filter_input(INPUT_POST, "state");
$zip = filter_input(INPUT_POST, "zip");

$checkout = filter_input(INPUT_POST, "checkout");
$delDate = filter_input(INPUT_POST, "delDate");
$delLoc = filter_input(INPUT_POST, "delLoc");

$placeOrder = filter_input(INPUT_POST, "placeOrder");
$order = filter_input(INPUT_POST, "order");
$catID = filter_input(INPUT_POST, "catID");
$prodID = filter_input(INPUT_POST, "prodID");
$prodName = filter_input(INPUT_POST, "productName");
$qty = filter_input(INPUT_POST, "qty");
$sizeName = filter_input(INPUT_POST, "size");



?>
<div class='content-container checkout-page'>

    <?php
    if ($_SESSION['cart'] == null) {
        header("Location: ../product");
    }
    foreach($_SESSION['cart'] as $item){
        $prod = prodByID($item['prod']['productID']);
        
        // Determine if needs to be paid inperson
        if ($prod['portionsID'] == 6) {
            $payOnline = false;
            // echo "<h4>" . $prod['productName'] . "</h4>";
        }

        // calculate itemPrice
        if ($item['size'] != null){
            $size = sizeByName($item['size']['sizeName'], $item['prod']['sizeID']);
            $itemPrice = $size['price'] * $item['qty'];
        } else {
            $itemPrice =  $prod['price'] * $item['qty'];
        }
        // add itemPrice to subtotal
        $subtotal += $itemPrice;
        // calculate tax
        $cat = catByID($item['prod']['catID']);
        $tax += $cat['taxRate'] * $itemPrice;
        ?>

    <?php
    }

    // calculate total 
    $total = $subtotal + $tax;

    ?>


    <?php
    if (isset($checkout)) {
        // if customer already exists in session 
        if (!isset($_SESSION['custID'])) {
            $cust = getCustomerByNameAndPhone($fName, $lName, $phone);

            // if customer doesn't exist. Create one
            if ($cust == null) {
                insertCustomer($fName, $lName, $phone, $address1, $address2, $city, $state, $zip, $email);
                $cust = getCustomerByNameAndPhone($fName, $lName, $phone);
                echo "Customer Created with id of " . $cust['customerID'];
            }
            $_SESSION['custID'] = $cust['customerID'];
            echo "Session Created";
        
        }
        
        
    
        

    ?>


    <!-- paypal -->
    <!-- test user login -->
    <!-- email: sb-d8yho5993816@personal.example.com
    password: j]3k/JRP
 -->
    <script src="https://www.paypal.com/sdk/js?client-id=AZP2Q8KFepMqbIDqrpD4eudCxQ1bvKqDjlMppasBzmqZbrfpNZWBTonhkgQbdsD2fG59Ou0o5_nvWK1B
">
    // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
    </script>



    





    <!-- Bootstrap checkout form -->
    <div class="py-5 text-center">
        <h2 class="checkout-title">Checkout</h2>
    </div>

    <div class="py-5 text-center">
        <span class="checkout-title">Delivery Location:<h4><?php 
            if ($delLoc == "Farm") {
                echo "Zahn Farms<br>9018 St Hwy W, Elkland, MO";
                $delDate = "Mon-Sat by appointment";
                $delTime = "Call or Email to set up<br>(417) 719-7517<br>BZahn01@Yahoo.com";
            } else if ($delLoc == "Marshfield") {
                echo "Marshfield Farmer's Market<br>...address...";
                $delTime = "2:30-6:30PM";
            } else if ($delLoc == "Springfield") {
                echo "Springfield Sam's Club<br>3660 E Sunshine St, Springfield, MO";
                $delTime = "4PM";

                $delFee = 10;
                $subtotal += $delFee;
                $total = $subtotal + $tax;
            }
        ?>
            </h4>
        </span>
        <span class="checkout-title">Delivery Date:<h4><?=$delDate?><br><?=$delTime?></h4></span>
    </div>

    <div style="justify-content:center" class="row">
        <div class="col-md-4 order-md-1">
            
            <ul class="checkout-cart list-group mb-3">

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Delivery Fee</h6>
                    </div>
                    <span class="text-muted">$<?=number_format((float)$delFee, 2, '.', '')?></span>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Subtotal</h6>
                    </div>
                    <span class="text-muted">$<?=number_format((float)$subtotal, 2, '.', '')?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Tax</h6>
                    </div>
                    <span class="text-muted">$<?=number_format((float)$tax, 2, '.', '')?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <!-- check if total is known and can pay online -->
                    <?php if ($checkout) {
                        echo "<span>Total (USD)</span>";
                        echo "<strong>$" . number_format((float)$total, 2, '.', '') . "</strong>";
                    } else {
                        echo "<span>Estimated Total (USD)<br><small
                        class='text-muted'>Pay at Pickup</small></span>";
                        echo "<strong>~$" . number_format((float)$total, 2, '.', '') . "</strong>";
                    }?>
                </li>
            </ul>
        </div>

        <script>
        // This function displays Smart Payment Buttons on your web page.
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: "USD",
                            value: '<?=$total?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    document.getElementById('placeOrder').click();
                });
            }
        }).render('#paypal-button-container');
        </script>
        <!-- check if can pay online -->
        <?php
        // Admin place order
        if (isset($_SESSION['login']) == "valid") {
        ?>  
            <div class="col-md-4 order-md-2">
                <div class="text-center">
                    <h4>Add Order to System<br><small>As Admin</small> </h4>
                    <h4>~$<?=number_format((float)$total, 2, '.', '')?></h4>
                    <form action="thankYou.php" method="post">
                        <button class="btn checkout-btn btn-lg btn-block" type="submit">Place Order</button>
                        <input type="hidden" name="placeOrder">
                        <input type="hidden" name="checkout" value="<?php echo ($checkout? 'true': 'false')?>">
                        <input type="hidden" name="delDate" value="<?=$delDate?>">
                        <input type="hidden" name="delLoc" value="<?=$delLoc?>">
                        <input type="hidden" name="subtotal" value="<?=$subtotal?>">
                        <input type="hidden" name="delFee" value="<?=$delFee?>">
                        <input type="hidden" name="tax" value="<?=$tax?>">
                        <input type="hidden" name="total" value="<?=$total?>">
                    </form>
                </div>
            </div>
        <?php
        } else if ($checkout){?>
            <!-- display paypal buttons -->
            <div class="col-md-4 order-md-2">
                <div id="paypal-button-container"></div>
            </div>
            <form action="thankYou.php" method="post">
                <button style="display:none" id="placeOrder" name="placeOrder" class="btn checkout-btn btn-lg btn-block" type="submit">Place Order</button>
                <input type="hidden" name="checkout" value="<?php echo ($checkout? 'true': 'false')?>">
                <input type="hidden" name="delDate" value="<?=$delDate?>">
                <input type="hidden" name="delLoc" value="<?=$delLoc?>">
                <input type="hidden" name="subtotal" value="<?=$subtotal?>">
                <input type="hidden" name="delFee" value="<?=$delFee?>">
                <input type="hidden" name="tax" value="<?=$tax?>">
                <input type="hidden" name="total" value="<?=$total?>">
            </form>

        <?php 
        } else { ?>
            <div class="col-md-4 order-md-2">
                <div class="text-center">
                    <h4>Estimated Total to be Paid at Pickup</h4>
                    <h4>~$<?=number_format((float)$total, 2, '.', '')?></h4>
                    <form action="thankYou.php" method="post">
                        <button class="btn checkout-btn btn-lg btn-block" type="submit">Place Order</button>
                        <input type="hidden" name="placeOrder">
                        <input type="hidden" name="checkout" value="<?php echo ($checkout? 'true': 'false')?>">
                        <input type="hidden" name="delDate" value="<?=$delDate?>">
                        <input type="hidden" name="delLoc" value="<?=$delLoc?>">
                        <input type="hidden" name="subtotal" value="<?=$subtotal?>">
                        <input type="hidden" name="delFee" value="<?=$delFee?>">
                        <input type="hidden" name="tax" value="<?=$tax?>">
                        <input type="hidden" name="total" value="<?=$total?>">
                    </form>
                </div>
            </div>

        <?php } ?>
        
    </div>

    <?php
    } else if (!isset($checkout)) {


    ?>


    <!-- Bootstrap checkout form -->
    <div class="py-5 text-center">
        <h2 class="checkout-title">Checkout</h2>
    </div>

    <div class="row">

        <div style="margin:auto" class="col-md-8 order-md-1">
            <form class="needs-validation" action="" method="post">
                
                <h4 class="mb-3 checkout-title">Order</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Delivery Location</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delLoc" id="radioFarm"
                                value="Farm" onclick="locationSelect(this);" required>
                            <label class="form-check-label" for="radioFarm">
                                Farm in Elkland:<br>
                                <small>9018 St Hwy W, Elkland, MO.<br>Mon-Sat by appointment.</small>

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delLoc" id="radioMarshfield"
                                value="Marshfield" onclick="locationSelect(this);">
                            <label class="form-check-label" for="radioMarshfield">
                                Marshfield Farmer's Market:<br>
                                <small>...address...<br>Fridays 2:30-6:30PM.</small>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delLoc" id="radioSpringfield"
                                value="Springfield" onclick="locationSelect(this);">
                            <label class="form-check-label" for="radioSpringfield">
                                Springfield Sam's Club: <small>($10 delivery fee)</small><br>
                                <small>3660 E Sunshine St, Springfield, MO<br>Wednesdays 4PM.</small>

                            </label>
                        </div>
                    </div>

                    <?php
                    // get how many days till next delivery day for selected location. For checking if this week is valid for delivery
                        $start_date = date_create(date('Y-m-d'));
                        $end_date_wed   = date_create(date('Y-m-d', strtotime('this Wednesday')));
                        $end_date_fri   = date_create(date('Y-m-d', strtotime('this Friday')));
                        //difference between two dates
                        $diff_wed = date_diff($start_date,$end_date_wed);
                        $diff_fri = date_diff($start_date,$end_date_fri);

                        
                        //find the number of days between two dates
                        // echo "Difference between two dates: ".$diff->format("%a"). " Days ";
                    ?>
                    <div class="col-md-6 mb-3">
                        <label for="delDate">Delivery Date</label><br>
                        <!-- Date picker. Sets min to location's delivery day that is at least 2 days from today. Sets max to 4 weeks from today  -->

                        <!-- Farm selected -->
                        <p style="display:none" id="delDateFarm">
                            Call or Email to set up pickup.<br>(417) 719-7517<br>BZahn01@Yahoo.com
                        </p>
                        <!-- Marshfield Selected -->
                        <input name="delDate" disabled type="date" id="delDateMarshfield" required min="<?php 
                                if ($diff_fri->format("%a") < 2) {
                                    echo date('Y-m-d', strtotime('+14 day', strtotime('last Friday')));
                                } else {
                                    echo date('Y-m-d', strtotime('+7 day', strtotime('last Friday')));
                                }?>" max="<?=date('Y-m-d', strtotime('+4 week'))?>" step="7">
                        <!-- Springfield Selected -->
                        <input name="delDate" style="display:none;" disabled type="date" id="delDateSpringfield" required min="<?php 
                                if ($diff_wed->format("%a") < 2) {
                                    echo date('Y-m-d', strtotime('+14 day', strtotime('last Wednesday')));
                                } else {
                                    echo date('Y-m-d', strtotime('+7 day', strtotime('last Wednesday')));
                                }?>" max="<?=date('Y-m-d', strtotime('+4 week'))?>" step="7">


                        <br>
                        <small id="delDateSmall">Choose a delivery location</small>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                </div>

                <script>
                function locationSelect(loc) {
                    var select = loc.value;
                    document.getElementById("delDateSmall").style = "display:block";
                    document.getElementById("delDateFarm").style = "display:none";
                    document.getElementById("delDateMarshfield").style = "display:none";
                    document.getElementById("delDateSpringfield").style = "display:none";

                    if (select == "Farm") {
                        document.getElementById("delDateFarm").style = "display:block";
                        document.getElementById("delDateSmall").style = "display:none";
                        document.getElementById("delDateMarshfield").value = "";
                        document.getElementById("delDateSpringfield").value = "";
                    } else if (select == "Marshfield") {
                        document.getElementById("delDateMarshfield").style = "display:block";
                        document.getElementById("delDateMarshfield").disabled = false;
                        document.getElementById("delDateSmall").innerHTML = "Fridays 2:30-6:30PM";
                        document.getElementById("delDateSpringfield").value = "";
                    } else if (select == "Springfield") {
                        document.getElementById("delDateSpringfield").style = "display:block";
                        document.getElementById("delDateSpringfield").disabled = false;
                        document.getElementById("delDateSmall").innerHTML = "Wednesdays 4PM";
                        document.getElementById("delDateMarshfield").value = "";
                        // add delivery fee
                        document.getElementById("delFee").value = "10";
                    }
                }
                </script>



                <?php
                if (!isset($_SESSION['custID'])) {
                ?>

                <hr class="mb-4">

                <!-- Customer Info -->
                <h4 class="mb-3 checkout-title">Billing Address</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fName">First Name</label>
                        <input name="fName" type="text" class="form-control" id="fName" placeholder="First Name" value=""
                            required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lName">Last Name</label>
                        <input name="lName" type="text" class="form-control" id="lName" placeholder="Last Name" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone <small>(No Special Characters)</small></label>
                        <input name="phone" type="tel" class="form-control" id="phone" placeholder="1234567890" value=""
                            pattern="[0-9]{10}" required autocomplete="tel-national">
                        <!-- <label for="phone">Phone <small>e.g. 123-456-7890</small></label>
                        <input type="tel" class="form-control" id="phone" placeholder="123-456-7890" value=""
                        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required autocomplete="tel-national"> -->
                        <div class="invalid-feedback">
                            Valid phone number is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email <small>(Optional)</small></label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input name="address1" type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                    <div class="invalid-feedback">
                        Please enter your address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <small>(Optional)</small></label>
                    <input name="address2" type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">City</label>
                        <input name="city" type="text" class="form-control" id="address" placeholder="City" required>
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select name="state" class="custom-select d-block w-100" id="state" required>
                            <option selected hidden disabled>Choose...</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">Dist of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input name="zip" type="text" class="form-control" id="zip" placeholder="Zip" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                <?php } ?>
                <hr class="mb-4">
                <button class="btn checkout-btn btn-lg btn-block" type="submit">Continue to Checkout</button>
                <input type="hidden" name="checkout" value="<?=$payOnline?>">
                <!-- <?php 
                if (!$payOnline) {
                    echo "<label>Pay at Pickup</label>";
                }
                ?> -->

                <!-- <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Paypal</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button> -->
            </form>
        </div>
    </div>
    <?php } ?>
</div>
<?php


include "../views/footer.php";
?>