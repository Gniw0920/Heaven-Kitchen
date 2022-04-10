<?php

require_once 'db.php';

    if($_SERVER['REQUEST_METHOD']==='POST') {
        $order_ID =$_POST['order-id'];
        $delivery_date =$_POST['delivery-date'];
        $delivery_time =$_POST['delivery-time'];
        $user_email =$_SESSION['email'];

        $result = $conn->query("SELECT * FROM staff WHERE staff_email='$user_email'");
        $user_id = $result->fetch_assoc()['staff_ID'];
        
        $conn->query("INSERT INTO delivery(delivery_time,delivery_date,order_ID,staff_ID) VALUES('$delivery_time','$delivery_date','$order_ID','$user_id')");
        header('Location: admin.php');
     }
