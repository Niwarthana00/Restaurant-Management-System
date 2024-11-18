<?php
session_start();

if (!isset($_SESSION['cart'])) {
    session_start();
    $_SESSION['cart'] = [];
  
// continue session


if (!isset($_SESSION['email'])) {
    header("Location: login_html.php");
    exit();
}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'product_name' => $name,
            'price' => $price,
            'quantity' => 1
        ];
    }

    echo 'Item added to cart';
}
?>
