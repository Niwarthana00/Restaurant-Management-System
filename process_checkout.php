<?php
session_start();
include 'php/db.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login_html.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $district = mysqli_real_escape_string($connect, $_POST['district']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $payment_method = mysqli_real_escape_string($connect, $_POST['payment_method']);
    
    $cart_items = $_SESSION['cart'];
    $order_success = true;

    foreach ($cart_items as $id => $item) {
        // Fetch product ID from the product table using product name
        $product_name = $item['product_name'];
        $product_id_query = "SELECT id FROM product WHERE product_name = '$product_name'";
        $product_id_result = mysqli_query($connect, $product_id_query);
        $product_id_row = mysqli_fetch_assoc($product_id_result);
        $product_id = $product_id_row['id'];

        $quantity = $item['quantity'];
        $price = $item['price'];
        $total = $price * $quantity;
// insert all the data
        $sql = "INSERT INTO orders (name, address, district, phone, email, product_id, product_name, quantity, price, total, payment_method) 
                VALUES ('$name', '$address', '$district', '$phone', '$email', '$product_id', '$product_name', '$quantity', '$price', '$total', '$payment_method')";

        if (!mysqli_query($connect, $sql)) {
            $order_success = false;
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }

    if ($order_success) {
        unset($_SESSION['cart']); // Clear cart after successful order

        if ($payment_method === 'cod') {
            $_SESSION['order_message'] = "You have successfully placed your order!";
            header("Location: order_success.php");
        } else if ($payment_method === 'card') {
            header("Location: credit_card_details.php");
        }
    }
}
?>
