<?php
    require_once "db.php";

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        // When the delete button is clicked within the items table at the admin panel
        // This code will execute
        $customer_ID = $_REQUEST['id'];
        $table_name = $_REQUEST['table-name'];
    
        
        // Then finally the details regarding that particular items are deleted
        $sql = "DELETE FROM ".$table_name." WHERE ".$table_name."_ID='$customer_ID'";
        $conn->query($sql);

        header('Location: admin.php');
    }

    header('Location: admin.php');