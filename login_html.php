<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Cafe Login</title>

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

<!-- Login Section Start -->
<div class="main">
    <div class="container login-wrapper">
        <div class="booking-content col-8">
            <div class="booking-image visible">
                <img class="booking-img" src="imgs/img1.jpg" alt="Image">
            </div>
            <div class="booking-form">
                <?php
                if (isset($_GET['error']) && $_GET['error'] == '1') {
                    echo '<div class="alert alert-danger" role="alert">Incorrect username or password.</div>'; //show erro message 
                }
                ?>
                <form id="booking-form" method="POST" action="php/login.php">
                    <h2>Login account!</h2>
                    <div class="form-group form-input">
                        <input type="text" name="email" id="name" value="" required/>
                        <label for="name" class="form-label">Email</label>
                    </div>
                    <div class="form-group form-input">
                        <input type="password" name="password" id="password" value="" required />
                        <label for="password" class="form-label">Enter password</label>
                    </div>
                    <div class="form-submit">
                        <button type="submit" name="submit" class="submit" id="submit"> Login </button>     
                        <p>Don't have an account? <a href="register_html.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End -->

<?php 
    include 'inc/footer.php';
?>
</body>
</html>
