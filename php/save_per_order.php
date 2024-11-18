<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login_html.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $selectedProducts = $_POST['selected_products_list'];
    
    $totalPrice = 0;
    $productsArray = explode(", ", $selectedProducts);
    
    foreach ($productsArray as $product) {
        $productDetails = explode(" - ", $product);
        $totalPrice += floatval($productDetails[1]);
    }
    
    //SQL insert query
    $query = "INSERT INTO per_orders (name, email, phone, order_date, product_name, price, total_price) VALUES ('$name', '$email', '$phone', '$date', '$selectedProducts',  $totalPrice, $totalPrice)";
    
    if ($connect->query($query) === TRUE) {
        $redirect_url = "../alert.php?type=success&title=Success&message=Order Successfull&redirect=per_ordering.php";
        echo "<script>window.location = '$redirect_url';</script>";
    } else {
        $redirect_url = "../alert.php?type=error&title=Error&message=Error:+" . $error_message . "&redirect=per_ordering.php";
        echo "<script>window.location = '$redirect_url';</script>";
    }
    
    $connect->close();
}
?>
