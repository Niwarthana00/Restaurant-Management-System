<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login_html.php");
    exit();
}

include 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $person = $_POST['person'];
    $message = $_POST['message'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $redirect_url = "../alert.php?type=error&title=Error&message=Invalid+email+format&redirect=error_page.php";
        echo "<script>window.location = '$redirect_url';</script>";
        exit();
    }

    // Validate phone number (example: 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $redirect_url = "../alert.php?type=error&title=Error&message=Invalid+phone+number&redirect=error_page.php";
        echo "<script>window.location = '$redirect_url';</script>";
        exit();
    }

    // SQL statement
    $stmt = $connect->prepare("INSERT INTO table_booking (name, email, phone, date, start_time, end_time, person, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $name, $email, $phone, $date, $start_time, $end_time, $person, $message);

    // Execute the statement
    if ($stmt->execute()) {
        $redirect_url = "../alert.php?type=success&title=Success&message=Booking+successful&redirect=index.php";
    } else {
        $error_message = $stmt->error; // Get the error message
        $redirect_url = "../alert.php?type=error&title=Error&message=Error:+" . $error_message . "&redirect=error_page.php";
    }

    echo "<script>window.location = '$redirect_url';</script>";
    $stmt->close();
    $connect->close();
}
?>
