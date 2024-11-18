<?php
session_start();
include 'php/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login_html.php");
    exit();
}

$email = $_SESSION['email'];
$cart_items = $_SESSION['cart_items'];
$total_price = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;
$delivery_charge = 350;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
       <!-- Main CSS File -->
<link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="css/checkout.css">
<!-- Vendor CSS Files -->
<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<!-- <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="assets/css/style.css" rel="stylesheet">
    <style>
        .form-control {
            border-color: yellow;
            background-color: black;
            color: white;
        }

        .form-control:focus {
            background-color: black;
        }

        .btn-primary {
            background-color: yellow;
            border-color: yellow;
            color: black;
        }

        .btn-primary:hover {
            background-color: darkorange;
            border-color: darkorange;
        }

        .order-summary {
            margin-top: 20px;
            background-color: black;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .custom-dropdown-menu {
            display: none;
            position: absolute;
            background-color: #000;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            top: 100%;
            right: 0;
            z-index: 1000;
        }
        .custom-dropdown-menu.show {
            display: block;
        }
        .custom-dropdown {
            position: relative;
        }
        .custom-dropdown .fa-user::after {
            content: "\25BC"; /* Unicode character for down arrow */
            display: inline-block;
            margin-left: 5px;
            font-size: 12px;
            vertical-align: middle;
        }
        input[type="radio"]{
            width: auto;
            display: inline;
        }
    </style>

</head>
<body>
    <?php include 'inc/header.php'; ?>
    <div class="container mt-5" style="margin-top:140px !important;">
        <div class="row">
            <div class="col-md-6">
                <h2>Checkout</h2>
                <form id="checkout-form" action="process_checkout.php" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="address" name="address" placeholder="Shipping Address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="district" name="district" placeholder="District" required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <div>
                            <input type="radio" id="master" name="payment_method" value="cod" required>
                            <label for="master">COD</label>
                        </div>
                        <div>
                            <input type="radio" id="visa" name="payment_method" value="card" required>
                            <label for="visa">Credit Card</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart_items as $id => $item) : 
                                // Fetch the image path from the database
                                $image_query = "SELECT image FROM product WHERE id = $id";
                                $image_result = mysqli_query($connect, $image_query);
                                $image_row = mysqli_fetch_assoc($image_result);
                                $image_path = "image_upload/category/product/" . $image_row['image'];
                            ?>
                                <tr>
                                    <td><img src="<?php echo $image_path; ?>" alt="<?php echo $item['product_name']; ?>" class="img-thumbnail" width="100"></td>
                                    <td><?php echo $item['product_name']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td>RS. <?php echo $item['price'] * $item['quantity']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <h4>Delivery Charge: RS. 350</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <h4>Total: RS. <?php echo $total_price ; ?></h4>
                    </div>
                    <a href="cart.php" class="btn btn-secondary mt-3">Go Back to Cart</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            var name = document.getElementById('name').value;
            var address = document.getElementById('address').value;
            var district = document.getElementById('district').value;
            var phone = document.getElementById('phone').value;
            var paymentMethodMaster = document.getElementById('master').checked;
            var paymentMethodVisa = document.getElementById('visa').checked;

            if (!name || !address || !district || !phone || (!paymentMethodMaster && !paymentMethodVisa)) {
                alert('Please fill in all required fields.');
                event.preventDefault();
            }

            var phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone)) {
                alert('Please enter a valid 10-digit phone number.');
                event.preventDefault();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
