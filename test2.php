<?php
include 'php/db.php';

if (!isset($_SESSION['cart'])) {
    session_start();
    $_SESSION['cart'] = [];
  

}

// Get the category ID from the URL
$catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0; // get cat id from index page.

// Fetch category name for the header
$category_query = "SELECT category_name FROM food_category WHERE id = $catid";
$category_result = mysqli_query($connect, $category_query);
$category_row = mysqli_fetch_assoc($category_result);
$category_name = $category_row['category_name'];

// Fetch data from the product table for the specific category

$sql = "SELECT id, product_name, price, image FROM product WHERE catid = $catid";
$result = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category_name; ?> Products</title>

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <?php 
        include 'inc/head-inc.php'; 
    ?>
</head>
<body>
    <?php
        include 'inc/header.php'; 
    ?>
    <div class="container-fluid fruite py-5">
    <h1 class="margin"><?php echo $category_name; ?> Products</h1> 
        <div class="container py-5 text-contnttitle">
            
            <div class="row">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="rounded position-relative fruite-item item-card">
                                <div class="fruite-img">
                                    <img src="image_upload/category/product/<?php echo $row['image']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4 style="margin-bottom: 40px;"><?php echo $row['product_name']; ?></h4>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-light fs-5 fw-bold mb-0"> RS.<?php echo $row['price']; ?> </p>
                                        <form method="post" class="add-to-cart-form" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['product_name']; ?>" data-price="<?php echo $row['price']; ?>">
                                            <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary add-cart">
                                                <i class="fa fa-shopping-bag me-2 text-primary add-cart"></i> Add to cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No products found in this category.</p>";
                }

                // Close the database connection
                mysqli_close($connect);
                ?>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End -->
 
    <!-- Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Item Added to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color:black">
                    You have successfully added the item to your cart.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                    <a href="cart.php" class="btn btn-primary">Go to Cart</a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.add-cart').forEach(function(button) {
                button.addEventListener('click', function() {
                    var form = button.closest('form');
                    var id = form.getAttribute('data-id');
                    var name = form.getAttribute('data-name');
                    var price = form.getAttribute('data-price');
                    
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'add_to_cart.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var modal = new bootstrap.Modal(document.getElementById('cartModal'));
                            modal.show();
                        }
                    };
                    xhr.send('id=' + id + '&name=' + name + '&price=' + price);
                });
            });
        });
    </script>
</body>
</html>
