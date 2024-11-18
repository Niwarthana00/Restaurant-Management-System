<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $product_id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target_dir = "../image_upload/category/product/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update with new image
            $sql = "UPDATE product SET product_name='$product_name', catid='$category', price='$price', image='$image' WHERE id='$product_id'";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        // Update without image
        $sql = "UPDATE product SET product_name='$product_name', catid='$category', price='$price' WHERE id='$product_id'";
    }

    if ($conn->query($sql) === TRUE) {
        $redirect_url = "../alert.php?type=success&title=Success&message=  Staff update successfull&redirect=admin_dashboard/product_list.php";
        echo "<script>window.location = '$redirect_url';</script>";
    } else {
        $redirect_url = "../alert.php?type=error&title=Error&message=Error:+" . $error_message . "&redirect=admin_dashboard/product_list.php";
        echo "<script>window.location = '$redirect_url';</script>";
    }

    $conn->close();
}
?>
