<!DOCTYPE html>
<html lang="en">
<?php 
if(session_id() == '') {
    session_start();
}
$_SESSION["usertype"] = "admin_logged_in";
if (!isset($_SESSION['usertype'])) {
    header('Location: signin.php');
    exit;
}
?>
<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <?php 
        include 'inc/head.php';
    ?>
</head>

<body>
    
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <?php 
        include 'inc/side_bar.php';
        ?>


        <!-- Content Start -->
        <div class="content">
        <?php 
        include 'inc/nav.php';
    ?>

    <?php
        include '../php/db.php';

        // Fetch order details
        if (isset($_GET['id'])) {
            $orderId = $_GET['id'];
            $sql = "SELECT * FROM orders WHERE id = $orderId";
            $result = mysqli_query($connect, $sql);
            $order = mysqli_fetch_assoc($result);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $payment_status = $_POST['payment_status'];
            $order_status = $_POST['order_status'];
            
            $updateSql = "UPDATE orders SET payment_status = '$payment_status', order_status = '$order_status' WHERE id = $orderId";
            if (mysqli_query($connect, $updateSql)) {
                echo "<script>alert('Order updated successfully');</script>";
                echo "<script>window.location.href = 'view.php?id=$orderId';</script>";
            } else {
                echo "Error updating record: " . mysqli_error($connect);
            }
        }

        mysqli_close($connect);
        ?>
    <div class="container mt-5">
        <h2>Order Details</h2>
        <?php if ($order): ?>
            <form method="post">
                <div class="form-group">
                    <label for="orderId">Order ID</label>
                    <input type="text" class="form-control" id="orderId" name="orderId" value="<?php echo $order['id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName" value="<?php echo $order['name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" readonly><?php echo $order['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control" id="district" name="district" value="<?php echo $order['district']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $order['phone']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $order['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="product_id">Product ID</label>
                    <input type="text" class="form-control" id="product_id" name="product_id" value="<?php echo $order['product_id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $order['product_name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $order['quantity']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $order['price']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" class="form-control" id="total" name="total" value="<?php echo $order['total']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="orderDate">Order Date</label>
                    <input type="text" class="form-control" id="orderDate" name="orderDate" value="<?php echo $order['order_date']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select class="form-control" id="payment_status" name="payment_status">
                        <option value="pending" <?php if ($order['payment_status'] == 'pending') echo 'selected'; ?>>Pending</option>
                        <option value="failed" <?php if ($order['payment_status'] == 'failed') echo 'selected'; ?>>Failed</option>
                        <option value="cancel" <?php if ($order['payment_status'] == 'cancel') echo 'selected'; ?>>Cancel</option>
                        <option value="success" <?php if ($order['payment_status'] == 'success') echo 'selected'; ?>>Success</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="order_status">Order Status</label>
                    <select class="form-control" id="order_status" name="order_status">
                        <option value="pending" <?php if ($order['order_status'] == 'pending') echo 'selected'; ?>>Pending</option>
                        <option value="confirm" <?php if ($order['order_status'] == 'confirm') echo 'selected'; ?>>Confirm</option>
                        <option value="processing" <?php if ($order['order_status'] == 'processing') echo 'selected'; ?>>Processing</option>
                        <option value="canceling" <?php if ($order['order_status'] == 'canceling') echo 'selected'; ?>>Canceling</option>
                        <option value="ready for delivery" <?php if ($order['order_status'] == 'ready for delivery') echo 'selected'; ?>>Ready for Delivery</option>
                        <option value="completed" <?php if ($order['order_status'] == 'completed') echo 'selected'; ?>>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        <?php else: ?>
            <p>Order not found.</p>
        <?php endif; ?>
    </div>



    <?php 
        include 'inc/footer.php';
    ?>

</body>

</html>
