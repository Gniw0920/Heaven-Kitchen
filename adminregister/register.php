<?php
        require_once 'db.php';
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            // User registration
                $name = $_POST['name'];
                $user_type = $_POST['user-type'];
                $email = $_POST['email'];
                $phone = intval($_POST['phone']);
                $password = $_POST['password'];
                $username = $_POST['username'];
                $address = '';

                $sql = "";

                // Check the user email in the database
                if ($user_type==='staff') {
                    $sql = "SELECT * FROM staff WHERE staff_email='$email'";
                } else if($user_type==='customer') {
                    $address = $_POST['address'];

                    $sql = "SELECT * FROM customer WHERE customer_email='$email'";
                }
            
                $result = $conn->query($sql);
               
                
                
           
        if ($result->num_rows > 0) {
            // If the user is in the system then they 
            // will be required to login in instead of creating account
          
                header('Location: login.php');
            } else {
                try {
                        // This is where password hashing occurs and account creation is completed
                        $id = random_int(10,999);
                        if ($user_type==='staff') {
                        $sql = "INSERT INTO staff(staff_name,staff_username, staff_email,staff_phone, staff_password) VALUES('$name','$username', '$email','$phone','$password')";
                        $conn->query($sql);
                        
                        $_SESSION['name'] = $name;
                        $_SESSION['email'] = $email;
                        $_SESSION['user_type'] = 'staff';
                      
                        header('Location: admin.php');

                        } else if($user_type==='customer') {
                            $sql = "INSERT INTO customer(customer_name,customer_username, customer_address, customer_email,customer_phone, customer_password) VALUES('$name','$username','$address', '$email','$phone','$password')";
                            $conn->query($sql);
                        
                            $_SESSION['name'] = $name;
                            $_SESSION['email'] = $email;
                            $_SESSION['user_type'] = 'customer';

                            header('Location: cart.php');
                        }
                        
            } catch (Error $error) {
                $errors = $error;
                var_dump($error);
                exit;
            }
        }
        }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Register|Heaven's Kitchen</title>
  <link rel="stylesheet" type="text/css" href="login_register.css">
</head>
<body>

<div class="navbar">
    <div class="nav-content">
        <a  class="nav-stuff button" onclick="history.back()">Heaven's Kitchen</a>
    </div>
</div>
  <div class="header">
  	<h2>Admin Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="name" value="<?php echo $email; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
	<div class="input-group">
  	  <label>Phone Number</label>
  	  <input type="text" name="phone" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</a></button>
  	</div>
  	<p>
  		Already have account? <a href="login.php">Sign in</a>
  	</p>
  </form>

	<footer>
		<p class="footer-cred">Heaven's Kitchen || Definitely not Hell Kitchen Knockoff</p>
	</footer>
</body>
</html>