<?php
session_start();
        $conn=mysqli_connect("localhost", "root", "", "heaven kitchen");
		if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
		echo("Server Error");
        }
        if(isset($_POST['submit'])) {
        $Name =  $_POST['Name'];
        $People = $_POST['People'];
        $date =  $_POST['date'];
        $Message = $_POST['Message'];
          
        $sql="INSERT INTO reservation (customer_name,reservation_date_time,reservation_ppl_qty,reservation_msg) VALUES ('$Name', '$date','$People','$Message')";
		$res= mysqli_query($conn, $sql);
		header('location: customerpage.php');
		}
		
		else
		{
			echo("Error");
		}
		
?>