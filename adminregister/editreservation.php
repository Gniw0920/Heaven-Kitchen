<?php
    require_once "db.php";

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $id= $_REQUEST['id'];
        $sql = "SELECT * FROM reservation where reservation_ID=$id";
        $result = $conn->query($sql);
    }
?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>Heaven Kitchen</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="admin.css">
        </head>
    <body>
        <div class="navbar">
            <div class="nav-content">
                <a onclick="history.back()" class="nav-stuff button">Definitely not Hell Kitchen Knockoff</a>
            </div>
        </div>

            <div class="reservation" id="contact">
                <h1>Edit Reservation Information</h1><br>
                <form action="editreservation.php" method="POST">
                    <p><input class="details" type="text" placeholder="Name" required name="Name" value="<?php echo $row['customer_name']; ?>"></p>
                    <p><input class="details" type="number" placeholder="How many people" required
                            name="People" value="<?php echo $row['reservation_ppl_qty']; ?>"></p>
                    <p><input class="details" type="datetime-local" placeholder="Date and time" required
                            name="date" value="<?php echo $row['reservation_date_time']; ?>"></p>
                    <p><input class="details" type="text" placeholder="Message \ Special requirements"
                            required name="Message" value="<?php echo $row['reservation_msg']; ?>"></p>
                    <p><button class="button btn" type="submit" name="edit">Edit</button></p>
                </form>
            </div>
        </div>

    </body>
    
    </html>
    <?php

if(isset($_POST["edit"]))
{
    
	$name = $_POST["Name"];  	
	$ppl = $_POST["People"];  	
	$date = $_POST["date"];  	
	$msg = $_POST["Message"];  	
	
	mysqli_query($connect,"UPDATE reservation SET customer_name='$name', reservation_ppl_qty='$ppl', reservation_date_time='$date', reservation_msg='$msg' WHERE reservation_id='$id' ");
	
	?>
	
		<script type="text/javascript">
			alert(" Info updated ");
		</script>
	
	<?php
	
	
	header( "refresh:0.5; url=admin.php" );
	
}

?>