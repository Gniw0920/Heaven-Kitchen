<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Heaven's Kitchen</title>
  <link rel="stylesheet" type="text/css" href="login_register.css">
</head>
<body>

<div class="navbar">
    <div class="nav-content">
        <a  class="nav-stuff button" onclick="history.back()">Heaven's Kitchen</a>
    </div>
</div>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="name">
  	</div>
	  <div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="address">
  	</div>
	  <div class="input-group">
  	  <label>Phone Number</label>
  	  <input type="text" name="phone">
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
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>

	<footer>
		<p class="footer-cred">Heaven's Kitchen || Definitely not Hell Kitchen Knockoff</p>
	</footer>
</body>
</html>