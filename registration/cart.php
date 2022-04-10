<?php

require_once "db.php";

    // Incase no user email is within the session, then the user should be redirected
    // to login page first
    if (!$_SESSION['username'] || empty($_SESSION['username'])) {
        header('Location: login.php');
    }

    if (!empty($_SESSION['user_type']) && $_SESSION['user_type']==='staff') {
        header('Location: admin.php');
    }
    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);
    $menu = "";

    if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
            
                $menu .="
                <li data-id='".$row['menu_ID']."' class='menu-item'>
                    <div><strong>Name</strong> <span>".$row['menu_name']."</span></div>
                    <div><strong>Price</strong> <span>".$row['menu_price']."</span></div>
                    <div><strong>Quantity</strong> <span>1</span></div>
                    <div><input type='checkbox'></div>
                </li>
                    ";
            }
        } else {
            $menu = "<li>Menu Is Empty</li>";
        }

        

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home | Heaven Kitchen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/original.css">
    </head>
<body>
    <div class="navbar">
        <div class="nav-content">
            <a href="index.php" class="nav-stuff button">Definitely not Hell Kitchen Knockoff</a>
            <div class="nav-righty">
                <a href="index.php#about" class="nav-stuff button">About</a>
                <a href="index.php#menu" class="nav-stuff button">Menu</a>
                <a href="index.php#contact" class="nav-stuff button">Contact</a>
                <a href="reservation.php" class="nav-stuff button">Reservation</a>
                <a href="logout.php" class="nav-stuff button">Logout</a>
            </div>
        </div>
    </div>
    <ul class="items-list">
        <h1>Add Food To Cart</h1>
        <p id="counter">0 items</p>
        <a href="payment.php">Proceed to paymant</a>
        <?php echo $menu; ?>
    </ul>
    <script src="js/scripts.js"></script>
</body>
</html>