<?php
session_start();

if (!isset($_SESSION['order_message'])) {
    header("Location: index.php");
    exit();
}

$order_message = $_SESSION['order_message'];
unset($_SESSION['order_message']); // Clear the message after displaying it
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="home">
    <!-- Modal HTML -->
    <div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: black; color: white;">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderSuccessModalLabel">Order Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ok" style="filter: invert(1);"></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $order_message; ?></p>
                    <p>Your order will be prepared soon.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalButton">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <script>
        // Show the modal when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            var orderSuccessModal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
            orderSuccessModal.show();

            // Redirect to checkout page when "Close" button is clicked
            document.getElementById('closeModalButton').addEventListener('click', function() {
                window.location.href = 'checkout.php';
            });
        });
    </script>
</body>
</html>
