<?php
include_once 'db.php';  
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $rpass = $_POST['rpassword'];

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email already registered']);
        exit();
    }

    if ($pass === $rpass) {
        // Hash the password using MD5
        $hashedPass = md5($pass);

        $sql = "INSERT INTO users (name, phonenumber, email, password, usertype) 
                VALUES ('$name', '$phone', '$email', '$hashedPass', 'customer')";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register']);
        }   
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
    }
}
?>
 