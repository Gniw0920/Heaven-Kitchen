<?php
require_once "db.php";
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
$menu = "";
if ($result->num_rows > 0) {
            
    while($row = $result->fetch_assoc()) {
    
        $menu .="
        <tr>
            <th scope='row'>".$row['feedback_ID']."</th>
            <td>".$row['feedback_rating']." star rating</td>
            <td>".$row['feedback_comment']."</td>
            <td>
            <form action='delete.php' method='POST'>
                <input type='hidden' name='id' value='".$row['feedback_ID']."'>
                <input type='hidden' name='table-name' value='menu'>
            </form>
            </td>
        </tr>
            ";
    }
} else {
    $menu = "<tr>Menu Is Empty</tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home | Heaven Kitchen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <link rel="stylesheet" href="original.css">
        <style>
            .nav-content {
                margin-top: -10px;
            }
        </style>
    </head>
<body>
    <div class="navbar">
        <div class="nav-content">
            <a href="#home" class="nav-stuff button" onclick="history.back()">Definitely not Hell Kitchen Knockoff</a>
        </div>
    </div>
    <br>
    <br>
    <div class="content">
    <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFive">
        <div class="accordion-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Rate Given</th>
                    <th scope="col">Comment</th>
                    </tr>
                </thead>
                  <tbody>
                        <?php echo $menu; ?>
                    </tbody>
            </table>
        </div>
    </div>
    </div>
    <footer>
        <div class="footer-content">
                    <img src="../logo.png" class="logo" alt="">
                    <div class="footer-ul-container">
                        <ul class="category">
                            <li class="category-title">Staff Recruitment</li>
                            <li><a href="mailto:soowing209@gmail.com?subject=recruit for Waiter position" class="footer-link">Waiter</a></li>
                            <li><a href="mailto:soowing209@gmail.com?subject=recruit for Chef position" class="footer-link">Chef</a></li>
                            <li><a href="mailto:soowing209@gmail.com?subject=recruit for Janitor position" class="footer-link">Janitor</a></li>
                        </ul>
                        <ul class="category">
                            <li class="category-title">Opening Hour</li>
                            <div class="time">
                                <p>Thursday - Saturday</p>
                                <p>Lunch: 12pm - 2.15pm</p>
                                <p>Tuesday - Saturday</p>
                                <p>Dinner: 6 - 11pm</p>
                            </div>
                        </ul>
                        <ul class="category">
                            <li class="category-title">Check up others experience with us!</li>
                            <li><a href="#" class="footer-link">Our Rating</a></li>
                        </ul>
                    </div>
                    
        
                </div>
                <p class="footer-title">Quick Tips</p>
                
                <p class="info">Please simply introduce yourself when applying the job</p>
                <p class="info">Tel - 03 7859 547</p>
                <div class="footer-social-container">
                    <div>
                        <a href="../term/term.html" class="social-links">Terms and Services</a>
                        <a href="../privacy/privacy.html" class="social-links">Privacy Policy</a>
                    </div>
                    <div>
                        <a href="https://www.instagram.com/" class="social-links">Instagram</a>
                        <a href="https://www.facebook.com/" class="social-links">Facebook</a>
                        <a href="https://www.twitter.com/" class="social-links">Twitter</a>
                    </div>
                </div>
                <p class="footer-cred">Heaven's Kitchen || Definitely not Hell Kitchen Knockoff</p>
        </footer>
    
</body>
</html>