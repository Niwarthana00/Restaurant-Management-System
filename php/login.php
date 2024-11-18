<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $connect->real_escape_string($_POST['email']);
    $password = $connect->real_escape_string($_POST['password']);

    // Query to get the user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Hash the input password with MD5 to compare
        $hashedPassword = md5($password);
        
        // Verify the MD5 hashed password
        if ($hashedPassword === $user['password']) {
            // Set session variables
            $_SESSION['email'] = $user['email'];
            $_SESSION['usertype'] = $user['usertype'];
            
            // Redirect to the homepage 
            header("Location: ../index.php");
            exit();
        } else {
            // Password does not match
            header("Location: ../login_html.php?error=1");
            exit();
        }
    } else {
        // No user found with that email
        header("Location: ../login_html.php?error=1");
        exit();
    }
}
?>
