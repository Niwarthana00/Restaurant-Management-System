<?php
session_start();
include 'php/db.php';

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $card_number = $_POST['card_number'];
    
    // Validate card number
    $card_number = mysqli_real_escape_string($connect, $card_number);
    $sql = "SELECT * FROM credit_card_details WHERE card_number='$card_number'";
    $result = mysqli_query($connect, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Success message
        $redirect_url = "alert.php?type=success&title=Success&message=Payment Successfull&redirect=index.php";
        echo "<script>window.location = '$redirect_url';</script>";
    } else {
        // Error: Invalid card number
        $redirect_url = "alert.php?type=error&title=Error&message=Error:+" . $error_message . "&redirect=index.php";
        echo "<script>window.location = '$redirect_url';</script>";
    }
}
?>
