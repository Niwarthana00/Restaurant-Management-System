<?php 
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login_html.php");
    exit();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pre-order</title>
    <link rel="icon" href="imgs/logo.png" sizes="48x48">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

   <!-- Main CSS File -->
<link href="css/main.css" rel="stylesheet">
    <link href="css/preorder.css" rel="stylesheet">
    <?php 
  //      include 'inc/head-inc.php'; 
    ?>
    <style>
        .navbar ul {
    margin: 0;
    padding: 0;
    display: flex;
    list-style: none;
    align-items: center;
}
        .custom-dropdown-menu {
            display: none;
            position: absolute;
            background-color: #000;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            top: 100%;
            right: 0;
            z-index: 1000;
        }
        .custom-dropdown-menu.show {
            display: block;
        }
        .custom-dropdown {
            position: relative;
        }
        .custom-dropdown .fa-user::after {
            content: "\25BC"; /* Unicode character for down arrow */
            display: inline-block;
            margin-left: 5px;
            font-size: 12px;
            vertical-align: middle;
        }
    </style>

<!-- Vendor CSS Files -->
<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<!-- <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="menu-page">
    <?php include 'inc/header.php'; ?>
    <div class="container menu-container">
        <h2>Menu</h2>
        <ul class="nav nav-tabs menu-nav-tabs" id="categoryTab" role="tablist">
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
        <div class="tab-content menu-tab-content" id="categoryTabContent">
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
                    echo '<div class="form-check">
                            <input class="form-check-input menu-form-check-input" type="checkbox" name="selected_products[]" value="' . $productRow['product_name'] . ' - ' . $productRow['price'] . '">
                            <label class="form-check-label menu-form-check-label">
                                <img src="../neww/image_upload/category/product/' . $productRow['image'] . '" alt="' . $productRow['product_name'] . '" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                ' . $productRow['product_name'] . ' - RS. ' . $productRow['price'] . '
                            </label>
                          </div>';
                }
                echo '</div>';
                $index++;
            }
            ?>
        </div>
        <form action="php/save_per_order.php" method="post" class="mt-5">
            <div class="form-group menu-form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control menu-form-control" id="name" name="name" required>
            </div>
            <div class="form-group menu-form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control menu-form-control" id="email" name="email" required>
            </div>
            <div class="form-group menu-form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control menu-form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group menu-form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control menu-form-control" id="date" name="date" required>
            </div>
            <input type="hidden" name="selected_products_list" id="selected_products_list">
            <button type="submit" class="btn btn-primary menu-btn-primary">Submit Order</button>
        </form>
    </div>
    <?php 
        include 'inc/footer.php';
    ?>

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
