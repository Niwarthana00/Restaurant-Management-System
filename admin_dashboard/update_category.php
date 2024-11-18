<?php
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

    // Get form data
    $id = $_POST['id'];
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target_dir = "../image_upload/category/menu/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update with new image
            $sql = "UPDATE food_category SET category_name='$category_name', description='$description', image='$image' WHERE id='$id'";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        // Update without image
        $sql = "UPDATE food_category SET category_name='$category_name', description='$description' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        $redirect_url = "../alert.php?type=success&title=Success&message=  Staff update successfull&redirect=admin_dashboard/category.php";
        echo "<script>window.location = '$redirect_url';</script>";
    } else {
        $redirect_url = "../alert.php?type=error&title=Error&message=Error:+" . $error_message . "&redirect=admin_dashboard/category.php";
        echo "<script>window.location = '$redirect_url';</script>";
    }

    $conn->close();
}
?>
