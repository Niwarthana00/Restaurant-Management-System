<?php
session_start();
include 'php/db.php';

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $owner = $_POST['owner'];
    $cvv = $_POST['cvv'];
    $card_number = $_POST['card_number'];
    $expiry_month = $_POST['expiry_month'];
    $expiry_year = $_POST['expiry_year'];
    
    // Validate card number
    $card_number = mysqli_real_escape_string($connect, $card_number);
    $sql = "SELECT * FROM credit_card_details WHERE card_number='$card_number'";
    $result = mysqli_query($connect, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Validate expiration date
        $current_year = date('Y');
        $current_month = date('m');
        
        if (($expiry_year > $current_year) || ($expiry_year == $current_year && $expiry_month >= $current_month)) {
            // Success message
            echo "<script>alert('Payment successful!'); window.location.href='index.php';</script>";
        } else {
            // Error: Expiration date is in the past
            echo "<script>alert('Error: Expiration date is in the past.');</script>";
        }
    } else {
        // Error: Invalid card number
        echo "<script>alert('Error: Invalid card number.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1>Confirm Your Payment</h1>
        <form method="POST" action="process_credit_card.php">
            <div class="first-row">
                <div class="owner">
                    <h3>Owner</h3>
                    <div class="input-field">
                        <input type="text" name="owner" required>
                    </div>
                </div>
                <div class="cvv">
                    <h3>CVV</h3>
                    <div class="input-field">
                        <input type="password" name="cvv" required>
                    </div>
                </div>
            </div>
            <div class="second-row">
                <div class="card-number">
                    <h3>Card Number</h3>
                    <div class="input-field">
                        <input type="text" name="card_number" required>
                    </div>
                </div>
            </div>
            <div class="third-row">
                <h3>Expiry Date</h3>
                <div class="selection">
                    <div class="date">
                        <select name="expiry_month" id="months" required>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                        <select name="expiry_year" id="years" required>
                            <?php
                            $current_year = date('Y');
                            for ($i = 0; $i < 10; $i++) {
                                echo "<option value='" . ($current_year + $i) . "'>" . ($current_year + $i) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="cards">
                        <img src="imgs/mc.png" alt="">
                        <img src="imgs/vi.png" alt="">
                        <img src="imgs/pp.png" alt="">
                    </div>
                </div>    
            </div>
            <div class="button-container">
            <button class="confirm-btn"> Confirm</button>
               
                <a href="index.php" class="btn-cancel" >Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
