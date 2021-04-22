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
include "../views/headerCheckout.php";

$catID = filter_input(INPUT_POST, "catID");
$prodID = filter_input(INPUT_POST, "prodID");
$prodName = filter_input(INPUT_POST, "productName");
$qty = filter_input(INPUT_POST, "qty");
$sizeName = filter_input(INPUT_POST, "size");
$order = filter_input(INPUT_POST, "order");
$customerName = filter_input(INPUT_POST, "customerName");

$payOnline = true;
$itemCnt = count($_SESSION['cart']);
$delFee = 0;
$subtotal = 0;
$tax = 0;
$total = 0;

?>
<div class='content-container checkout-page'>

    <?php
    if ($_SESSION['cart'] == null) {
        echo "<h3 id='cart-empty'>Cart is Empty</h3>";
    }
    foreach($_SESSION['cart'] as $item){
        $prod = prodByID($item['prod']['productID']);
        
        // Determine if needs to be paid inperson
        if ($prod['portionsID'] == 6) {
            $payOnline = false;
            echo "<h4>" . $prod['productName'] . "</h4>";
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
        // calculate total 
        $total += $itemPrice;
        ?>

    <?php
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



    <script>
        // paypal.Buttons().render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.


        paypal.Buttons({
            createOrder: function (data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: "USD",
                            value: '<?=$total?>'
                        }
                    }]
                });
            }
        }).render('#paypal-button-container');
    </script>





    <!-- Bootstrap checkout form -->
    <div class="py-5 text-center">
        <h2 class="checkout-title">Checkout</h2>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="checkout-title">Your cart</span>
                <span class="badge badge-light badge-pill"><?=$itemCnt?></span>
            </h4>
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
                    <span>Total (USD) <br><small
                            class="text-muted"><?php echo (!$payOnline ? 'Pay at Pickup':'') ?></small></span>

                    <strong>$<?=number_format((float)$total, 2, '.', '')?></strong>
                </li>
                <hr class="mb-4">
                <li>
                    <div id="paypal-button-container"></div>
                </li>
            </ul>
        </div>





        <div class="col-md-8 order-md-1">
            <form class="needs-validation" novalidate>
                <!-- Order Info -->
                <!-- 
customerID
orderDate
status
deliveryDate
deliveryTime
deliveryLocation
subtotal
deliveryFee
tax
totalPrice -->
                <h4 class="mb-3 checkout-title">Order</h4>
                <div class="row">

                    <?php
                    // get how many days till next wednesday. For checking if this week is valid for delivery
                        // $start_date = date_create('2021-04-20');
                        $start_date = date_create(date('Y-m-d'));
                        $end_date   = date_create(date('Y-m-d', strtotime('next Wednesday')));;
                        
                        //difference between two dates
                        $diff = date_diff($start_date,$end_date);
                        
                        //find the number of days between two dates
                        echo "Difference between two dates: ".$diff->format("%a"). " Days ";
                    ?>

                    <div class="col-md-6 mb-3">
                        <label for="firstName">Delivery Date</label>
                        <input type="date" class="datepicker" min="<?php echo date('Y-m-d', strtotime("-7 day", strtotime('next Wednesday')));?>" value="<?php echo date('Y-m-d', strtotime('next Wednesday'));?>" max="<?=date('Y-m-d', strtotime("+7 day", time()))?>"> <!-- value <?=date('Y-m-d')?> -->
                        <input type="submit">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <script>
                        // var date = document.getElementById('bookdate'),
                        // errorMessage = date.title;
                        //     function noSundays(e){
                        //         var day = new Date(e.target.value).getUTCDay();
                        //         // Days in JS range from 0-6 where 0 is Sunday and 6 is Saturday
                        //         if ( day == 0 ){
                        //             date.title = '';
                        // e.target.setCustomValidity(errorMessage);
                        //         } else {
                        // e.target.setCustomValidity('');
                        //         }}
                        // date.addEventListener('#bookdate',noSundays);
                        // function startDate() {
                        //     var dtToday = new Date();

                        //     var month = dtToday.getMonth() + 1;
                        //     var day2 = dtToday.getDate();
                        //     var year = dtToday.getFullYear();

                        //     var day = new Date(e.target.value).getUTCDay();

                        //     while (day != 3) {
                        //         day.stepDown();
                        //     }
                        // }
                        
                        // $(function() {
                        //     $( "#datepicker-5" ).datepicker({
                        //     beforeShowDay : function (date) {
                        //         var dayOfWeek = date.getDay ();
                        //         // 0 : Sunday, 1 : Monday, ...
                        //         if (dayOfWeek == 0 || dayOfWeek == 6) return [false];
                        //         else return [true];
                        //     }
                        //     });
                        // });


                        // function nextSession(date) {
                        //     var ret = new Date(date||new Date());
                        //     ret.setDate(ret.getDate() + (3 - 1 - ret.getDay() + 7) % 7 + 1);
                        //     return ret;
                        // };




                        // document.getElementById('datePicker').value = nextSession(Date()).toDateInputValue();

                        // $('.datepicker').pickadate({
                        //     disable: [
                        //         1, 4, 7
                        //     ],
                        //     min: [2021,4,14],
                        //     max: [2021,4,29]
                        // });


                        // $(function(){
                        //     var dtToday = new Date();

                        //     var month = dtToday.getMonth() + 1;
                        //     var day = dtToday.getDate();
                        //     var year = dtToday.getFullYear();

                        //     if(month < 10)
                        //         month = '0' + month.toString();
                        //     if(day < 10)
                        //         day = '0' + day.toString();

                        //     var maxDate = year + '-' + month + '-' + day;    
                        //     $('#txtDate').attr('max', maxDate);

                        //     var now = new Date(),
                        //     // minimum date the user can choose, in this case now and in the future
                        //     minDate = now.toISOString().substring(0,10);
                        //     $('#delDate').prop('min', minDate);
                        // });

                        
                    </script>

                    <div class="col-md-6 mb-3">
                        <label for="lastName">Delivery Time</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone">Delivery Location</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Default radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Default checked radio
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <div class="uk-margin">
                            <div class="uk-form-label">Radio</div>
                            <div class="uk-form-controls">
                                <label><input class="uk-radio" type="radio" name="radio1"> Option 01</label><br>
                                <label><input class="uk-radio" type="radio" name="radio1"> Option 02</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                    <div class="invalid-feedback">
                        Please enter your address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">City</label>
                        <input type="text" class="form-control" id="address" placeholder="City" required>
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" required>
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
                        <input type="text" class="form-control" id="zip" placeholder="Zip" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">

                <!-- Customer Info -->
                <h4 class="mb-3 checkout-title">Billing Address</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First Name" value=""
                            required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone (123-456-7890)</label>
                        <input type="tel" class="form-control" id="phone" placeholder="123-456-7890" value=""
                            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                        <div class="invalid-feedback">
                            Valid phone number is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                    <div class="invalid-feedback">
                        Please enter your address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">City</label>
                        <input type="text" class="form-control" id="address" placeholder="City" required>
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" required>
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
                        <input type="text" class="form-control" id="zip" placeholder="Zip" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn checkout-btn btn-lg btn-block" type="submit">Continue to Checkout</button>
                <?php 
                if (!$payOnline) {
                    echo "<label>Pay at Pickup</label>";
                }
                ?>

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
</div>
<?php


include "../views/footer.php";
?>