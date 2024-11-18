<?php
if(session_id() == '') {
    session_start();
    $usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : '';

}
if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] != 'admin_logged_in') {
    header('Location: signin.php');
    exit;
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
    $category_name = $conn->real_escape_string($_POST['category_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $image = $_FILES['image'];

    // Handle image upload
    $target_dir = "C:/xampp/htdocs/php/re/image_upload/category/menu/";
    $target_file = $target_dir . basename($image["name"]);
    $file_name= basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = array("jpg", "jpeg", "png", "gif");

    // Check if file is a valid image
    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit;
    }

    // Check file size (5MB max)
    if ($image["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        exit;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit;
    }

    // Attempt to upload file
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Insert category into database
        $sql = "INSERT INTO food_category (category_name, description, image) VALUES ('$category_name', '$description', '$file_name')";

        if ($conn->query($sql) === TRUE) {
            echo "New category added successfully";
            header('Location: add_new_category.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
