<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>
    <?php 
        include 'inc/head-inc.php'; 
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/menu.css" rel="stylesheet">
</head>
<body class="back-img">
<?php
    include 'inc/header.php'; 
?>
    <div class="main">
        <div class="container login-wrapper">
            <div class="booking-content col-8">
                <div class="booking-image">
                    <img class="booking-img" src="imgs/form-img.jpg" alt="Image">
                </div>
                <div class="booking-form">
                    <div id="message-div"></div> <!-- Div for displaying messages -->
                    <form id="booking-form" method="POST" action="php/register.php">
                        <h2>Register account!</h2>
                        <div class="form-group form-input">
                            <input type="text" name="name" id="name" value="" required/>
                            <label for="name" class="form-label">Your Full name</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="number" name="phone" id="phone" value="" required />
                            <label for="phone" class="form-label">Your phone number</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="email" name="email" id="email" value="" required />
                            <label for="email" class="form-label">Your Email Address</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" name="password" id="password" value="" required />
                            <label for="password" class="form-label">Create password</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" name="rpassword" id="rpassword" value="" required />
                            <label for="rpassword" class="form-label">Confirm password</label>
                        </div>
                        
                        <div class="form-submit" style="margin-top: 50px;">
                            <button type="submit" name="submit" class="submit" id="submit"> Register </button>     
                            <p style="color: goldenrod;">Already have an account? <a href="login_html.php" style="color: red;">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/register.js"></script> <!-- Include the JavaScript file -->
    <?php 
    include 'inc/footer.php';
    ?>
</body>
</html>
