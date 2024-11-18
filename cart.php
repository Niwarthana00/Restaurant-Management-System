<?php
// continue session
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login_html.php");
    exit();
}
include 'php/db.php'; 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart_items = $_SESSION['cart'];
$delivery_charge = 350; //default add deliver charj

function calculate_total($cart_items, $delivery_charge) {
    $total = 0;
    foreach ($cart_items as $item) {
        $total += $item['price'] * $item['quantity']; // calculate part and get total
    }
    return $total;
}

$total_price = calculate_total($cart_items, $delivery_charge);
if (!empty($cart_items)) {
    $total_price += $delivery_charge;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $product_id = $_POST['product_id'];

    if ($action == 'remove') { //remove item
        unset($_SESSION['cart'][$product_id]);
    } elseif ($action == 'update') { // update qty
        $quantity = intval($_POST['quantity']);
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }

    $cart_items = $_SESSION['cart'];
    $total_price = calculate_total($cart_items, $delivery_charge);
    if (!empty($cart_items)) {
        $total_price += $delivery_charge;
    }
}
$_SESSION['total_price'] = $total_price;
$_SESSION['cart_items'] = $cart_items;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <?php 
        include 'inc/head-inc.php'; 
    ?>
</head>
<body>
<?php
    include 'inc/header.php'; 
    
?>
    <div class="container py-5" style="margin-top:140px !important;">
        <h1>Shopping Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Handle</th>
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
                        <td>RS. <?php echo $item['price']; ?></td>
                        <td>
                            <form method="post" class="update-cart-form">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <div class="input-group">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" class="form-control" min="1">
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                </div>
                            </form>
                        </td>
                        <td>RS. <?php echo $item['price'] * $item['quantity']; ?></td>
                        <td>
                            <form method="post" class="remove-cart-form">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (!empty($cart_items)) : ?>
            <div class="d-flex justify-content-end">
                <h4>Delivery Charge: RS. 350</h4>
            </div>
            <div class="d-flex justify-content-end">
                <h4>Total: RS. <?php echo $total_price; ?></h4>
            </div>
        <?php else : ?>
            <div class="d-flex justify-content-end">
                <h4>Total: RS. 0</h4>
            </div>
        <?php endif; ?>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
