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
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Prepare SQL statement
    $sql = "UPDATE users SET name='$name', phonenumber='$phone', email='$email' WHERE id='$id' AND usertype='customer'";

    if ($conn->query($sql) === TRUE) {
        $redirect_url = "../alert.php?type=success&title=Success&message=  Customer update successfull&redirect=admin_dashboard/customers.php";
        echo "<script>window.location = '$redirect_url';</script>";
    } else {
        $redirect_url = "../alert.php?type=error&title=Error&message=Error:+" . $error_message . "&redirect=admin_dashboard/customers.php";
        echo "<script>window.location = '$redirect_url';</script>";
    }

    $conn->close();
}
?>