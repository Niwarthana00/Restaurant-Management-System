<?php
include '../php/db.php';

// Fetch order details
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $sql = "SELECT * FROM orders WHERE id = $orderId";
    $result = mysqli_query($connect, $sql);
    $order = mysqli_fetch_assoc($result);

    // Fetch order items
    $sqlItems = "SELECT * FROM orders WHERE id = $orderId";
    $resultItems = mysqli_query($connect, $sqlItems);
    $orderItems = mysqli_fetch_all($resultItems, MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_status = $_POST['payment_status'];
    $order_status = $_POST['order_status'];  

    $updateSql = "UPDATE orders SET payment_status = '$payment_status', order_status = '$order_status' WHERE id = $orderId";
    
    if (mysqli_query($connect, $updateSql)) {     
        echo "<script>alert('Order updated successfully');</script>";
        echo "<script>window.location.href = 'view_order_details.php?id=$orderId';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<?php 
if(session_id() == '') {
    session_start();
}

?>
<head>
    <meta charset="utf-8">
    <title>Order Details</title>
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

        <div class="content-wrapper">
            <!-- Content -->        
            <div class="container-xxl flex-grow-1 container-p-y"> 
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="mb-1">
                            <span class="h5">Order #<?php echo $order['id']; ?> </span>
                            <span class="badge bg-label-success me-1 ms-2"><?php echo ucfirst($order['payment_status']); ?></span>
                            <span class="badge bg-label-info"><?php echo ucfirst($order['order_status']); ?></span>
                        </div>
                        <p class="mb-0"><?php echo date('M d, Y', strtotime($order['order_date'])); ?></p>
                    </div>
                </div>

                <!-- Order Details Table -->
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title m-0">Order details</h5>
                            </div>
                            <div class="card-datatable table-responsive"> 
                                <table class="datatables-order-details table border-top dataTable no-footer dtr-column">
                                    <thead>
                                        <tr>
                                            <th class="w-50 sorting_disabled" rowspan="1" colspan="1" aria-label="products">Products</th>
                                            <th class="w-25 sorting_disabled" rowspan="1" colspan="1" aria-label="price">Price</th>
                                            <th class="w-25 sorting_disabled" rowspan="1" colspan="1" aria-label="qty">Qty</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $subtotal = 0;
                                        foreach ($orderItems as $item): 
                                            $total = $item['price'] * $item['quantity'];
                                            $subtotal += $total;
                                        ?>
                                        <tr>
                                            <td><?php echo $item['product_name']; ?></td>
                                            <td><?php echo $item['price']; ?></td>
                                            <td><?php echo $item['quantity']; ?></td>
                                            <td><?php echo $total; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                                            <td><strong>$<?php echo $subtotal; ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="card-title m-0">Shipping address</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-0"><?php echo $order['address']; ?></p>
                            </div>
                        </div>
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between pb-2">
                                <h5 class="card-title m-0">Billing address</h5>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title m-0">Customer details</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center mb-6">
                                    <div class="avatar me-3">
                                        <img src="./Demo _ Order Details - eCommerce _ sneat - Bootstrap Dashboard PRO_files/1.png" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-0"><?php echo $order['name']; ?></h6>
                                        <span>Customer Name: #<?php echo $order['name']; ?></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start align-items-center mb-6">
                                    <h6 class="text-nowrap mb-0">12 Orders</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">Contact info</h6>
                                </div>
                                <p class=" mb-1">Email: <?php echo $order['email']; ?></p>
                                <p class=" mb-0">Mobile: <?php echo $order['phone']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST">
                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select id="payment_status" name="payment_status" class="form-control">
                            <option value="paid" <?php if($order['payment_status'] == 'paid') echo 'selected'; ?>>Paid</option>
                            <option value="unpaid" <?php if($order['payment_status'] == 'unpaid') echo 'selected'; ?>>processing</option>
                            <option value="unpaid" <?php if($order['payment_status'] == 'unpaid') echo 'selected'; ?>>Unpaid</option>
                            <option value="unpaid" <?php if($order['payment_status'] == 'unpaid') echo 'selected'; ?>>Cancelled</option>


                        </select>
                    </div>

                    <div class="form-group">
                        <label for="order_status">Order Status</label>
                        <select id="order_status" name="order_status" class="form-control">
                            <option value="ready to pickup" <?php if($order['order_status'] == 'ready to pickup') echo 'selected'; ?>>Ready to Pickup</option>
                            <option value="processing" <?php if($order['order_status'] == 'processing') echo 'selected'; ?>>Processing</option>
                            <option value="completed" <?php if($order['order_status'] == 'completed') echo 'selected'; ?>>Completed</option>
                            <option value="cancelled" <?php if($order['order_status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Order</button>
                </form>
            </div>
        </div>

        <?php 
        include 'inc/footer.php';
        ?>
    </div>

</body>
</html>
