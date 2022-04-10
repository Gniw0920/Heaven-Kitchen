<?php
require_once 'db.php';
if (!$_SESSION['email'] || empty($_SESSION['email'])) {
    header('Location: login.php');
}
if(isset($_POST)) {
    $data = json_decode(file_get_contents('php://input'),false);
    $order_total_price = $data->price;
    $order_qty = $data->quantity;
    $reward_discount_code = $data->discount_code;
    $id = random_int(10,1000);
    $user_id = $data->customer_ID;
    $order_id = $data->order_ID;
    
    $conn->query("INSERT INTO reward(reward_discount_code,customer_ID,order_ID) VALUES('$reward_discount_code','$user_id','$order_id')");

    if($reward_discount_code==='HK2020') {

        echo json_encode(['data'=>[
            'order_ID'=>intval($order_id),
            'discounted'=> true
        ]]);
    } else {
        echo json_decode(['error'=>true]);
    }
}

