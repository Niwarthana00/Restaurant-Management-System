<!DOCTYPE html>
<html lang="en">
<?php
if (session_id() == '') {
    session_start();
}

?>
<head>
    <meta charset="utf-8">
    <title>Add new product</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php include 'inc/head.php'; ?>
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

        <?php include 'inc/side_bar.php'; ?>

        <!-- Content Start -->
        <div class="content">
            <?php include 'inc/nav.php'; ?>

            <div class="container-fluid admin-login">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.php" class="">
                                    <h3 class="text-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Product</h3>
                                </a>
                            </div>

                            <?php
                            if (isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                                    <?= $_SESSION['message'] ?>
                                    <?php unset($_SESSION['message']); ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="add_product.php" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="product_name" id="floatingInput" placeholder="Product Name" required>
                                    <label for="floatingInput">Product Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="catid" id="floatingSelect" required>
                                        <option selected>Select Category</option>
                                        <?php
                                        // Fetch categories from the database
                                        $conn = new mysqli("localhost", "root", "", "test1");
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }
                                        $sql = "SELECT id, category_name FROM food_category";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                                            }
                                        }
                                        $conn->close();
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Category</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="price" id="floatingInput" placeholder="Price" required>
                                    <label for="floatingInput">Price</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" name="image" id="floatingInput" placeholder="Image" required>
                                    <label for="floatingInput">Image</label>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'inc/footer.php'; ?>
</body>

</html>
