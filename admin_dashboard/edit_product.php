<!DOCTYPE html>
<html lang="en">
<?php 
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details
$product_id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT product_name, catid, price, image FROM product WHERE id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    header('Location: product_list.php');
    exit();
}

// Fetch categories
$sql_categories = "SELECT id, category_name FROM food_category";
$categories = $conn->query($sql_categories);

$conn->close();
?>
<head>
    <meta charset="utf-8">
    <title>Edit Product</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php 
        include 'inc/head.php';
    ?>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <?php include 'inc/side_bar.php'; ?>
        <div class="content">
            <?php include 'inc/nav.php'; ?>
            <div class="container-fluid admin-login">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <h3 class="text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Edit Product</h3>
                            <form method="POST" action="update_product.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="product_name" id="floatingProductName" placeholder="Product Name" value="<?php echo $row['product_name']; ?>" required>
                                    <label for="floatingProductName">Product Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="category" id="floatingCategory" required>
                                        <option value="">Select Category</option>
                                        <?php
                                        if ($categories->num_rows > 0) {
                                            while($category = $categories->fetch_assoc()) {
                                                $selected = ($category['id'] == $row['catid']) ? 'selected' : '';
                                                echo "<option value='" . $category['id'] . "' $selected>" . $category['category_name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingCategory">Category</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="price" id="floatingPrice" placeholder="Price" value="<?php echo $row['price']; ?>" required>
                                    <label for="floatingPrice">Price</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <img src="../image_upload/category/product/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>" width="50">
                                    <input type="file" class="form-control" name="image" id="floatingImage" placeholder="Upload Image">
                                    <label for="floatingImage">Image</label>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Update</button>
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
