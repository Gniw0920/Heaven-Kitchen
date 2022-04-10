<!DOCTYPE html>
<html>
    <head>
        <title>Heaven's Kitchen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="rating.css">
        <style>
            .slidecontainer {
                width: 100%;
            }
  
            .slider {
                -webkit-appearance: none;
                appearance: none;
                width: 100%;
                height: 25px;
                background: #d3d3d3;
                outline: none;
                opacity: 0.7;
                -webkit-transition: .2s;
                transition: opacity .2s;
            }
            
            .slider:hover {
                opacity: 1
            }
            
            .slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 25px;
                height: 25px;
                background:#dcaa17;
                cursor: pointer;
            }
            
            .slider::-moz-range-thumb {
                width: 25px;
                height: 25px;
                background:#dcaa17;
                cursor: pointer;
            }
        </style>
    </head>
<body>
    <div class="navbar">
        <div class="nav-content">
            <a  class="nav-stuff button" onclick="history.back()">Heaven's Kitchen</a>
        </div>
    </div>

    <div class="content">
        <div class="reservation">
            <h1>Feedback</h1><br>
            <p>Feel free to tell others your experience.</p>
            <form action="rate.php" method="post">
                <div class="slidecontainer">
                    <input type="range" min="0" max="5" value="3" class="slider" id="rating" required name="rating">
                    <p>Rating: <span id="star" name="star"></span> star</p>
                </div>
                <p><input class="details" type="text" placeholder="Tells other your experience..." required name="Message" id="Message"></p>
                <p><button class="button btn" name="submit" type="submit" onclick="myFunction()">Feedback</button></p>
                <script>function myFunction() {alert("Thank You for rating us!");}</script>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <img src="logo.png" class="logo" alt="">
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
                    <li class="category-title">Tells Others your experience with us!</li>
                    <li><a href="#" class="footer-link">Rate Us</a></li>
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
            <div>
                <p class="footer-cred">Heaven's Kitchen || Definitely not Hell Kitchen Knockoff</p>
            </div>
        </footer>

</body>
</html>

<script>
    var slider = document.getElementById("rating");
    var output = document.getElementById("star");
    output.innerHTML = slider.value;
    slider.oninput = function() {
    output.innerHTML = this.value;}
</script>