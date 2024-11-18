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
    if (isset($_POST['update'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $_POST['product_id']) {
                $item['quantity'] = $_POST['quantity'];
                break;
            }
        }
    } elseif (isset($_POST['remove'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $_POST['product_id']) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }

    header('Location: cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1>Shopping Cart</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $total_price += $item['price'] * $item['quantity'];
                        ?>
                        <tr>
                            <td><?php echo $item['product_name']; ?></td>
                            <td><?php echo $item['price']; ?></td>
                            <td>
                                <form method="post" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                </form>
                            </td>
                            <td><?php echo $item['price'] * $item['quantity']; ?></td>
                            <td>
                                <form method="post" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                    <button type="submit" name="remove" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th><?php echo $total_price; ?></th>
                    </tr>
                </tfoot>
            </table>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</body>
</html>
