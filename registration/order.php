<?php
require_once 'db.php';
if (!$_SESSION['email'] || empty($_SESSION['email'])) {
    header('Location: login.php');
}
if($_SERVER['REQUEST_METHOD']==='POST') {
    $data = json_decode(file_get_contents('php://input'),false);
    $order_total_price = $data->price;
    $order_qty = $data->quantity;
    $id = random_int(10,1000);
    $user_email = $_SESSION['email'];
    $result = $conn->query("SELECT * FROM customer WHERE customer_email='$user_email'");
    $user_id = $result->fetch_assoc()['customer_ID'];
    $conn->query("INSERT INTO `order`(order_total_price,order_qty,customer_ID) VALUES('$order_total_price','$order_qty','$user_id')");

    $result = $conn->query("SELECT order_ID FROM `order` ORDER BY `order_ID` DESC LIMIT 1");
    $order_ID = $result->fetch_assoc()['order_ID'];

    echo json_encode(['order_ID'=>$order_ID,'price'=>$order_total_price, 'quantity'=> $order_qty,'customer_ID'=> $user_id]);
}

