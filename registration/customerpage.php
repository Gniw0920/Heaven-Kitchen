<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
    include_once 'db.php';
    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);
    $item = "";

    if ($result->num_rows > 0) {
            
        while($row = $result->fetch_assoc()) {
        
            $item .="
                <h4>".$row['menu_name']."</h4>
                <p class='grey'>".$row['menu_price']."</p><br>

                ";
        }
    } else {
        $item = "Menu Is Empty";
    }        
 include_once 'inc_headers.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Heaven Kitchen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="customerpage.css">
    </head>
<body>
    <div class="navbar">
        <div class="nav-content">
            <a href="#home" class="nav-stuff button">Heaven's Kitchen</a>
            <div class="nav-righty">
                <a href="customerpage.php?logout='1'" class="nav-stuff button">Logout</a>
                <a href="#intro" class="nav-stuff button">Introduction</a>
                <a href="#menu" class="nav-stuff button">Menu</a>
                <a href="cart.php" class="nav-stuff button">Order</a>
                <a href="#reservation" class="nav-stuff button">Reservation</a>
                <a href="../about us/about us.html" class="nav-stuff button">About Us</a>
                <a href="../rating/rating.php" class="nav-stuff button">Rate Us</a>
            </div>
        </div>
    </div>

    <header class="header" id="home">
        <img class="header-img" src="cook.jpg">
        <h1 class="header-name">Heaven Kitchen</h1>
    </header>

    <div class="content">
        <div class="introduction" id="intro">
            <div class="intro-col content">
                <img src="1.jpg" class="pic">
            </div>

            <div class="intro-col content">
                <h1 class="intro-title">Introduction</h1><br>
                <h5 class="intro-title">Fine dine experience with affordable price</h5>
                <p class="intro-text">Founded in 2021 by JS Lam. Heaven Kitchen is a young retaurant that seek the chance to serve our customer with finest dining experience. By using the fresh, imported ingredients, we will guarantee your every food we serve will take your to voyage in the ocean of food. Yet, our 5star rated reataurant is worth you to spend a peaceful,comfort dining moment with your 
                      <span class="tag">life partner</span>.</p>
            </div>
        </div>

        <hr>

        <div class="menu" id="menu">
            <div class="menu-col menu-content">
                <h1 class="menu-center">Our Menu</h1><br>
                <?php echo $item; ?>
            </div>

            <div class="menu-col menu-content">
                <img src="2.jpg" class="pic" alt="Menu">
            </div>
        </div>

        <hr>

        <div class="reservation" id="reservation">
            <h1>Reservation</h1><br>
            <p>We offer full-service catering for any event, large or small. We understand your needs and we will cater
                the food to satisfy the biggerst criteria of them all, both look and taste.</p>
            <p class="address"><b>Address:Unit T2-3A-3 & Unit T2-3A-3A level 3A IOI City Tower Two Lebuh IRC, Ioi Resort, 62502 Putrajaya, Selangor</b></p>
            <p>You can make a reservation through the form below or contact us through our phone number 03-8943 3384.</p>
            <form action="reservation.php" method="post">
                <p><input class="details" type="text" placeholder="Name" name="Name" id="Name"></p>
                <p><input class="details" type="number" placeholder="How many people" name="People" id="People"></p>
                <p><input class="details" type="date" min="<?php echo date('Y-m-d'); ?>" placeholder="Date and time" name="date" id="date" value=''></p>
                <p><input class="details" type="text" placeholder="Message \ Special requirements" name="Message" id="Message"></p>
                <p><button class="button btn" type="submit" name="submit" onclick="myFunction()">Make a reservation</button></p>
		        <script>function myFunction() {alert("You had book successfully");}</script>
            </form>
        </div>
    </div>

<footer>
<div class="footer-content">
            <img src="logo.png" class="logo" alt="">
            <div class="footer-ul-container">
                <ul class="category">
                    <li class="category-title">Staff Recruitment</li>
                    <li><a href="mailto:soowing209@gmail.com?subject=recruit for Waiter position" class="footer-link">Waiter</a></li>
                    <li><a href="mailto:soowing209@gmail.com?subject=recruit for Chef position" class="footer-link">Chef</a></li>
                    <li><a href="mailto:soowing209@gmail.com?subject=recruit for Janitor position" class="footer-link">Janitor</a></li>
                </ul>
                <ul class="category">
                    <li class="category-title">Opening Hour</li>
                    <div class=time>
                        <p>Thursday - Saturday</p>
                        <p>Lunch: 12pm - 2.15pm</p>
                        <p>Tuesday - Saturday</p>
                        <p>Dinner: 6 - 11pm</p>
                    </div>
                </ul>
                <ul class="category">
                    <li class="category-title">Check up the rating given by our customer!</li>
                    <li><a href="../ratingviewer2/ratingviewer.php" class="footer-link">Our Rating</a></li>                
                </ul>
            </div>
            

        </div>
        <p class="footer-title">Quick Tips</p>
        
        <p class="info">Please simply introduce yourself when applying the job</p>
        <p class="info">Tel - 03 7859 547</p>
        <div class="footer-social-container">
            <div>
                <a href="../term/term.html" class="social-links">Terms and Services</a>
                <a href="../privacy/privacy.html" class="social-links">Privacy Policy</a>
            </div>
            <div>
                <a href="https://www.instagram.com/" class="social-links">Instagram</a>
                <a href="https://www.facebook.com/" class="social-links">Facebook</a>
                <a href="https://www.twitter.com/" class="social-links">Twitter</a>
            </div>
        </div>
        <p class="footer-cred">Heaven's Kitchen || Definitely not Hell Kitchen Knockoff</p>
</footer>

</body>
</html>

<script type="text/javascript">
window.onload = function(){ 
    <?php  if (isset($_SESSION['username'])) : ?>
    	alert("Hello <?php echo $_SESSION['username']; ?>,Welcome to Heaven's Kitchen");
        <?php endif ?>
        }
</script>