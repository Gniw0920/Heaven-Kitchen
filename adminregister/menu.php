<?php
    require_once 'db.php';
    if(isset($_POST)) {
       $menu_name =$_POST['menu-name'];
       $menu_price =$_POST['menu-price'];
       $menu_quantity =$_POST['menu-quantity'];
       $id = random_int(10,1000);
       $username = $_SESSION['username'];
       $result = $conn->query("SELECT * FROM staff WHERE staff_username='$username'");
       $user_id = $result->fetch_assoc()['staff_ID'];

      
    
       $conn->query("INSERT INTO menu(menu_name,menu_price,menu_quantity,staff_ID) VALUES('$menu_name','$menu_price','$menu_quantity','$user_id')");
       header('Location: admin.php');
      // INSERT INTO menu(menu_ID, menu_name,menu_price,menu_quantity,customer_ID,staff_ID) VALUES(30,'item1',200,1,2,50)
    }