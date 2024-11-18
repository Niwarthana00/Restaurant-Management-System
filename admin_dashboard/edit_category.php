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

// Fetch category details based on ID
$id = isset($_GET['id']) ? $_GET['id'] : '';
$sql = "SELECT category_name, description, image FROM food_category WHERE id = '$id'";
$result = $conn->query($sql);
$record = $result->fetch_assoc();
$conn->close();
?>
<head>
    <meta charset="utf-8">
    <title>Edit Category</title>
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
                            <h3 class="text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Edit Category</h3>
                            <form method="POST" action="update_category.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="category_name" id="floatingCategoryName" placeholder="Category Name" value="<?php echo $record['category_name']; ?>" required>
                                    <label for="floatingCategoryName">Category Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="description" id="floatingDescription" placeholder="Description" rows="3" required><?php echo $record['description']; ?></textarea>
                                    <label for="floatingDescription">Description</label>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                    <?php if ($record['image']) { ?>
                                        <img src="../image_upload/category/menu/<?php echo $record['image']; ?>" alt="Current Image" width="100">
                                    <?php } ?>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
