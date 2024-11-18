<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">
    <title>Shop</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Mean Menu CSS -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
    <!-- PreLoader -->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!-- PreLoader Ends -->

    <!-- Product Section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul id="categoryTab" class="nav nav-tabs" role="tablist">
                            <?php
                            include 'php/db.php';
                            $query = "SELECT * FROM food_category";
                            $result = $connect->query($query);
                            $index = 0;

                            while ($row = $result->fetch_assoc()) {
                                $categoryName = $row['category_name'];
                                echo '<li class="nav-item">
                                        <a class="nav-link ' . ($index === 0 ? 'active' : '') . '" id="' . strtolower(str_replace(' ', '-', $categoryName)) . '-tab" data-toggle="tab" href="#' . strtolower(str_replace(' ', '-', $categoryName)) . '" role="tab" aria-controls="' . strtolower(str_replace(' ', '-', $categoryName)) . '" aria-selected="' . ($index === 0 ? 'true' : 'false') . '">' . $categoryName . '</a>
                                      </li>';
                                $index++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row product-lists">
                <?php
                $result->data_seek(0);
                $index = 0;

                while ($row = $result->fetch_assoc()) {
                    $categoryId = $row['id'];
                    $categoryName = $row['category_name'];
                    echo '<div class="tab-pane fade ' . ($index === 0 ? 'show active' : '') . '" id="' . strtolower(str_replace(' ', '-', $categoryName)) . '" role="tabpanel" aria-labelledby="' . strtolower(str_replace(' ', '-', $categoryName)) . '-tab">';
                    $productQuery = "SELECT * FROM product WHERE catid = $categoryId";
                    $productResult = $connect->query($productQuery);

                    while ($productRow = $productResult->fetch_assoc()) {
                        echo '<div class="col-lg-4 col-md-6 text-center">
                                <div class="single-product-item">
                                    <div class="product-image">
                                        <a href="#"><img src="../re/image_upload/category/product/' . $productRow['image'] . '" alt="' . $productRow['product_name'] . '"></a>
                                    </div>
                                    <h3>' . $productRow['product_name'] . '</h3>
                                    <p class="product-price"><span>Per Kg</span> RS. ' . $productRow['price'] . '</p>
                                    <input class="form-check-input" type="checkbox" name="selected_products[]" value="' . $productRow['product_name'] . ' - ' . $productRow['price'] . '">
                                    <label class="form-check-label">
                                        <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                    </label>
                                </div>
                              </div>';
                    }
                    echo '</div>';
                    $index++;
                }
                ?>
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Order Form -->
    <div class="container mt-5">
        <form action="php/save_per_order.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <input type="hidden" name="selected_products_list" id="selected_products_list">
            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Count Down -->
    <script src="assets/js/jquery.countdown.js"></script>
    <!-- Isotope -->
    <script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- Waypoints -->
    <script src="assets/js/waypoints.js"></script>
    <!-- Owl Carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Mean Menu -->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!-- Sticker JS -->
    <script src="assets/js/sticker.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function() {
                var selectedProducts = [];
                $('input[name="selected_products[]"]:checked').each(function() {
                    selectedProducts.push($(this).val());
                });
                $('#selected_products_list').val(selectedProducts.join(', '));
            });
        });
    </script>
</body>
</html>
