<!DOCTYPE html>
<html lang="en">
<?php 
if (session_id() == '') {
    session_start();
}
$usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : '';

// Redirect if the user is not logged in or if they are not an admin or staff
if (!isset($_SESSION['usertype']) || ($usertype != 'admin' && $usertype != 'staff')) {
    header('Location: signin.php');
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <title>Food Orders</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
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

            // Fetch orders
            $sql = "SELECT id, name, order_date, payment_status, order_status, total FROM orders";
            $result = mysqli_query($connect, $sql);

            mysqli_close($connect);
        ?>

        <div class="content-wrapper p-5">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Food Orders</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th> 
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                                            <td><?php echo htmlspecialchars($row['order_status']); ?></td>
                                            <td><?php echo htmlspecialchars($row['total']); ?></td>
                                            <td><a href="view_order_details.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-primary">View</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">No orders found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <?php 
        include 'inc/footer.php';
    ?>

</body>
</html>
