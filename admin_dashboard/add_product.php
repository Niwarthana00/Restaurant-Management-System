<?php
if (session_id() == '') {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Collect and sanitize input
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $catid = $conn->real_escape_string($_POST['catid']);
    $price = $conn->real_escape_string($_POST['price']);
    $image = $_FILES['image'];

    // Handle image upload
    $target_dir = "C:/xampp/htdocs/php/re/image_upload/category/product/";
    $target_file = $target_dir . basename($image["name"]);
    $file_name = basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = array("jpg", "jpeg", "png", "gif");

    // Check if file is a valid image
    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        $_SESSION['message'] = "File is not an image.";
        $_SESSION['msg_type'] = "danger";
        header('Location: add_new_product.php');
        exit;
    }

    // Check file size (5MB max)
    if ($image["size"] > 5000000) {
        $_SESSION['message'] = "Sorry, your file is too large.";
        $_SESSION['msg_type'] = "danger";
        header('Location: add_new_product.php');
        exit;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, $allowed_types)) {
        $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['msg_type'] = "danger";
        header('Location: add_new_product.php');
        exit;
    }

    // Attempt to upload file
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Insert product into database
        $sql = "INSERT INTO product (product_name, catid, price, image) VALUES ('$product_name', '$catid', '$price', '$file_name')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "New product added successfully";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
            $_SESSION['msg_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
        $_SESSION['msg_type'] = "danger";
    }

    $conn->close();
    header('Location: add_new_product.php');
    exit;
} else {
    $_SESSION['message'] = "Invalid request method.";
    $_SESSION['msg_type'] = "danger";
    header('Location: add_new_product.php');
    exit;
}
?>
