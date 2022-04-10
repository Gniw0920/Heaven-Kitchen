<?php
require_once "db.php";

// Incase no user email is within the session, then the user should be redirected
// to login page first
// var_dump($_SESSION['email']);
// exit;
if (!$_SESSION['username'] || empty($_SESSION['username'])) {
    header('Location: login.php');
}

$sql = "SELECT * FROM menu";
$result = $conn->query($sql);
$menu = "";
if ($result->num_rows > 0) {
            
    while($row = $result->fetch_assoc()) {
    
        $menu .="
        <tr>
            <th scope='row'>".$row['menu_ID']."</th>
            <td>".$row['menu_name']."</td>
            <td>".$row['menu_price']."</td>
            <td>".$row['menu_quantity']."</td>
            <td>
            <form action='delete.php' method='POST'>
                <input type='hidden' name='id' value='".$row['menu_ID']."'>
                <input type='hidden' name='table-name' value='menu'>
                <button class='btn btn-danger'>Delete</button>
            </form>
            </td>
        </tr>
            ";
    }
} else {
    $menu = "<tr>Menu Is Empty</tr>";
}

$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
$customer = "";
if ($result->num_rows > 0) {
            
    while($row = $result->fetch_assoc()) {
    
        $customer .="
        <tr>
            <th scope='row'>".$row['customer_ID']."</th>
            <td colspan='2'>".$row['customer_name']."</td>
            <td>".$row['customer_username']."</td>
            <td>".$row['customer_email']."</td>
            <td>".$row['customer_phone']."</td>
            <td colspan='2'>".$row['customer_address']."</td>
            <td>
            <form style='margin-top:-10px;' action='delete.php' method='POST'>
                <input type='hidden' name='id' value='".$row['customer_ID']."'>
                <input type='hidden' name='table-name' value='customer'>
                <button class='btn btn-danger'>Delete</button>
            </form>
            </td>
        </tr>
            ";
    }
} else {
    $customer = "<tr>No Customers</tr>";
}

$sql = "SELECT * FROM reservation";
$result = $conn->query($sql);
$reservation = "";
if ($result->num_rows > 0) {
            
    while($row = $result->fetch_assoc()) {
    
        $reservation .="
        <tr>
            <th scope='row'>".$row['reservation_ID']."</th>
            <td>".$row['customer_name']."</td>
            <td>".$row['reservation_date_time']."</td>
            <td>".$row['reservation_ppl_qty']."</td>
            <td>".$row['reservation_msg']."</td>
            <td>
            <form action='delete.php' method='POST'>
                <input type='hidden' name='id' value='".$row['reservation_ID']."'>
                <input type='hidden' name='table-name' value='reservation'>
                <button class='btn btn-danger'>Delete</button>
            </form>
            </td>
            <td>
            <form action='editreservation.php' method='POST'>
                <input type='hidden' name='id' value='".$row['reservation_ID']."'>
                <input type='hidden' name='table-name' value='reservation'>
                <button class='btn btn-danger'>Edit</button>
            </form>
            </td>
            

        </tr>
            ";
    }
} else {
    $reservation = "<tr>No Customers</tr>";
}

$sql = "SELECT * FROM delivery";
$result = $conn->query($sql);
$delivery = "";
if ($result->num_rows > 0) {
            
    while($row = $result->fetch_assoc()) {
    
        $delivery .="
        <tr>
            <th scope='row'>".$row['delivery_ID']."</th>
            <td>".$row['order_ID']."</td>
            <td>".$row['delivery_time']."</td>
            <td>".$row['delivery_date']."</td>
            <td>
            <form action='delete.php' method='POST'>
                <input type='hidden' name='id' value='".$row['delivery_ID']."'>
                <input type='hidden' name='table-name' value='delivery'>
                <button class='btn btn-danger'>Delete</button>
            </form>
            </td>
        </tr>
            ";
    }
} else {
    $delivery = "<tr>Delivery</tr>";
}

$sql = "SELECT * FROM `order`";
$result = $conn->query($sql);
$orders = "";
if ($result->num_rows > 0) {
            
    while($row = $result->fetch_assoc()) {
    
        $orders .="
                <option value='".$row['order_ID']."'>".$row['order_ID']."</option>
            ";
    }
} else {
    $orders = "<option>No Orders</option>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home | Heaven Kitchen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <link rel="stylesheet" href="admin.css">
        <style>
            .nav-content {
                margin-top: -10px;
            }
        </style>
    </head>
<body>
    <header class="navbar">
        <div class="nav-content">
            <a href="index.php#home" class="nav-stuff button">Definitely not Hell Kitchen Knockoff</a>
            <div class="nav-righty">
                <a href="logout.php" class="nav-stuff button">Logout</a>
            </div>
        </div>
    </header>
    <div class="container-fluid mt-5 pt-2">
    <div class="row">
            <div class="operations col col-md-3">
                <div class="row p-2">
                    <h3>Add Menu Item</h3>
                    <form action="menu.php" method="post" class="form-group">
                    <input class="form-control form-control-lg" name="menu-name" type="text" placeholder="Menu Name">
                    <input class="form-control form-control-lg" name="menu-price" type="number" placeholder="Menu Price">
                    <input class="form-control form-control-lg" name="menu-quantity" type="number" min="1" placeholder="Menu Quantity">
                    <button class="btn btn-warning">Add</button>
                    </form>
                </div>
                <div class="row p-2">
                    <h3>Report Delivery</h3>
                    <form action="delivery.php" method="post" class="form-group">
                    <input class="form-control form-control-lg" type="date" name="delivery-date">
                    <input class="form-control form-control-lg" type="time" name="delivery-time">
                    <select name="order-id" style="width:100px;">
                        <?php echo $orders;?>
                    </select>
                    <button class="btn btn-warning">Report</button>
                    </form>
                </div>
            </div>
            <div class="col col-md-8">
                <h2>Entries</h2>
                <div class="row">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                           Menu
                        </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu Name</th>
                                <th scope="col">Menu Price</th>
                                <th scope="col">Menu Quantity</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php echo $menu; ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                           Customers
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col" colspan='2'>Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col" colspan='2'>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $customer; ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Reservations
                        </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Reservation Name</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">People</th>
                                <th scope="col">Special Requirements</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php echo $reservation; ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                           Deliveries
                        </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $delivery; ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>