<?php
include '../php/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $phonenumber = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = 'staff';

    // Encrypt the password using MD5
    $encrypted_password = md5($password);

    // Insert into users table
    $sql = "INSERT INTO users (name, phonenumber, email, password, usertype) 
            VALUES ('$name', '$phonenumber', '$email', '$encrypted_password', '$usertype')";

    if ($connect->query($sql) === TRUE) {
        $redirect_url = "../alert.php?type=success&title=Success&message= New Staff add successfull&redirect=admin_dashboard/add_new_staff.php";
        echo "<script>window.location = '$redirect_url';</script>";
    } else {
        $redirect_url = "../alert.php?type=error&title=Error&message=Error:+" . $error_message . "&redirect=admin_dashboard/add_new_staff.php";
        echo "<script>window.location = '$redirect_url';</script>";
    }
}
?>
