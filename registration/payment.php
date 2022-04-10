<?php
require_once 'db.php';
$user_email = $_SESSION['username'];
if (!$user_email || empty($user_email)) {
    header('Location: login.php');
}
if (!empty($_SESSION['user_type']) && $_SESSION['user_type']==='staff') {
    header('Location: admin.php');
}
$result = $conn->query("SELECT * FROM customer WHERE customer_username='$user_email'");
$user = $result->fetch_assoc();
if($_SERVER['REQUEST_METHOD']==='POST') {
    $data = json_decode(file_get_contents('php://input'),false);
    $payment_method = $data->payment_method;
    $payment_amount = $data->payment_amount;
    $payment_receipt = $data->payment_receipt;
    $order_ID = $data->order_ID;
  
    
    // $conn->query("INSERT INTO payment(payment_method,payment_amount,payment_receipt,order_ID) VALUES('$payment_method','$payment_amount','$payment_receipt','$order_ID')");

    echo json_encode([]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Home | Heaven's Kitchen</title>
</head>
<body>
    <header>
        <h1><a href="index.php">
            <img src="resources/logo.png" width="70" alt="">
            <span>Heaven's Kitchen</span>
        </a></h1>
        <nav>
            <ul>
                <li><a href="index.php#about">About Us</a></li>
                <li><a href="index.php#menu">Menu</a></li>
                <li><a href="index.php#contact">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <h3>SECURE CHECKOUT</h3>
    <div class="container">
        <div class="row">
            <div class="operations col col-md-4">
                <h4>1. REVIEW YOUR ORDER (<span class="num-of-items"></span> ITEMS)</h4>
                <ul id="order-review">
                    
                </ul>

                <div class="px-2">
                    <strong>For Quick payment</strong>
                    <div>
                        <button id="check-out-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn d-flex justify-content-center align-items-center" style="background-color: yellow; width: 100%; height: 40px;">Check out with <i class="bi bi-credit-card mx-2" style="color: #000; font-size: 30px;"></i></button>
                    </div>
                </div>
            </div>
            <div class="operations col col-md-4">
                <h4>2. DELIVERY ADDRESS</h4>
                <small>All fields are required</small>
                <form>
                    <div class="mb-3">
                        <label  class="form-label"><strong>Email address<i class="bi bi-asterisk"></i></strong></label>
                        <input type="email" class="form-control" readonly value="<?php echo $user['customer_email'];?>" placeholder="zero@origin.com">
                      </div>
                    <div class="mb-3">
                    <label  class="form-label"><strong>Name<i class="bi bi-asterisk"></i></strong></label>
                    <input type="text" class="form-control" value="<?php echo $user['customer_name'];?>">
                    </div>

                    <div class="mb-3">
                        <label  class="form-label"><strong>Telephone<i class="bi bi-asterisk"></i></strong></label>
                        <input type="text" class="form-control" value="<?php echo $user['customer_phone'];?>">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label"><strong>Delivery Address<i class="bi bi-asterisk"></i></strong></label>
                        <input type="text" class="form-control" value="<?php echo $user['customer_address'];?>">
                    </div>
                </form>
            </div>
            <div class="col col-md-4">
                <div class="payment-methods my-2 p-2">
                    <h4>3. SELECT PAYMENT METHOD</h4>
                    <div>
                        <div class="my-2">
                            <input type="radio" name="payment-method" value="card" checked><i class="bi bi-credit-card mx-2" style="color: #000; font-size: 30px;"></i>Card
                        </div>
                        <div>
                            <input type="radio" name="payment-method" value="e-wallet">
                        <img src="resources/e-wallet.png" width="35" alt="E-wallet logo"> E-wallet
                        </div>
                        <div class="my-2">
                            <input type="radio" name="payment-method" value="grab-pay">
                        <img src="resources/grabpay.png" width="35" alt="Grab Pay"> Grab Pay
                        </div>
                    </div>
                    
                </div>
                <div class="my-5 order-summary">
                    <h4>ORDER SUMMARY</h4>
                    <ul>
                        <li class="order-summary-items"><span>1x Note Sleeve,Tan</span> <strong></strong></li>
                        <li class="d-flex"><strong>Subtotal</strong> <strong class="order-summary-subtotal"></strong></li>
                        <li class="d-flex b-none"><strong>Shipping to Malaysia</strong> <strong>FREE</strong></li>
                        <li class="d-flex b-none"><strong>Order Discount</strong> <strong class="order-discount">MYR 0</strong></li>
                        <li class="d-flex b-none"><strong>ORDER TOTAL</strong> <strong class="order-summary-total">MYR 14</strong></li>
                    </ul>
                </div>
                <div class="my-5">
                    <button class="pay-btn" type="submit">PAY NOW</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Get A Reward</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
              <img src="resources/voucher.jpg" class="image-thumbnail" width="450" alt="">
          </div>
          <div class="my-2">
              <input type="text" id="discount-code" class="form-control form-control-lg" placeholder="Enter the Code to get a !DISCOUNT">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="claim-btn">Claim</button>
        </div>
      </div>
    </div>
  </div>
    <a href="https://www.flaticon.com/free-icons/digital-wallet" title="digital wallet icons">Digital wallet icons created by fjstudio - Flaticon</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/js/scripts.js"></script>
</body>
</html>