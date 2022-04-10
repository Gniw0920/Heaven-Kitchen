<?php
session_start();
    $conn=mysqli_connect("localhost", "root", "", "heaven kitchen");
	if($conn === false){
        die("ERROR: Could not connect.".mysqli_connect_error());
		echo("Server Error");
    }
        
    if(isset($_POST['submit'])){
        $Rate=$_POST['rating'];
        $Message=$_POST['Message'];
        
        $sql="INSERT INTO feedback(feedback_rating,feedback_comment) VALUES ('$Rate','$Message')";
		$res= mysqli_query($conn, $sql);
		header('location: rating.php');
    }
		
	else{
		echo("Data cannot enter");
	}		
?>