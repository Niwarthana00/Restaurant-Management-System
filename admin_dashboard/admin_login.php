<?php
session_start();
include '../php/db.php';

$email = $_POST['email']; 
$password = $_POST['password']; 

// Sanitize inputs
$email = mysqli_real_escape_string($connect, $email);

// Encrypt the entered password with MD5
$encrypted_password = md5(mysqli_real_escape_string($connect, $password));

// Query to check if the email and encrypted password exist
$sql = "SELECT * FROM users WHERE email='$email' AND password='$encrypted_password';";
$result = mysqli_query($connect, $sql);

$checkResult = mysqli_num_rows($result);

if ($checkResult > 0) {
    $row = mysqli_fetch_assoc($result);
    $usertype = $row['usertype'];
    
    if ($usertype == 'admin' || $usertype == 'staff') {
        $_SESSION['usertype'] = $usertype;
        header('Location: home.php');
        exit();
    } else {
        // Redirect to index.php with error query parameter
        header('Location: index.php?error=1');
        exit();
    }
} else {
    // Redirect to index.php with error query parameter
    header('Location: index.php?error=1');
    exit();
}
?>
