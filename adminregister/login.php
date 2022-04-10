<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login|Heaven's Kitchen</title>
  <link rel="stylesheet" type="text/css" href="login_register.css">
</head>
<body>

<div class="navbar">
    <div class="nav-content">
        <a  class="nav-stuff button" onclick="history.back()">Heaven's Kitchen</a>
    </div>
</div>

  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</a></button>
  	</div>
  	<p>
  		No account yet? <a href="register.php">Sign up</a>
  	</p>
  </form>

  <footer>
   <p class="footer-cred">Heaven's Kitchen || Definitely not Hell Kitchen Knockoff</p>
  </footer>
</body>
</html>