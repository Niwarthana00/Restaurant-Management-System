<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="home.php" class="navbar-brand mx-4 mb-5" style="margin-top: 50px;">
            <h3 class="text-primary">Gallery Cafe</h3>
            <!-- PHP to determine the title based on usertype -->
            <?php
            if(session_id() == '') {
                session_start();
            }
            $usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : '';
            $panelTitle = ($usertype == 'admin') ? 'Admin Panel' : 'Operational Staff ';
            ?>
            <span style="margin-left:30px;"><?php echo $panelTitle; ?></span>
        </a>
        <img src="../imgs/logo.png" alt="logo" style="width: 100px; height: 100%; margin-left: 50px; margin-top: -40px;">
        <div class="navbar-nav w-100">
            <!-- Always accessible to all user types -->
            <a href="home.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            
            <!-- Accessible to both admin and staff -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Orders</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="food_order.php" class="dropdown-item">Food order</a>
                    <a href="table_re.php" class="dropdown-item">Table reservation</a>
                    <a href="per_order_display.php" class="dropdown-item">Preorder foods</a>
                </div>
            </div>

            <!-- Conditional access for Users section -->
            <?php if($usertype == 'admin') { ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users" aria-hidden="true"></i>Users</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="staff_user.php" class="dropdown-item">Staff user</a>
                    <a href="customers.php" class="dropdown-item">Customers</a>
                    <a href="add_new_staff.php" class="dropdown-item">Add new staff</a>
                </div>
            </div>

            <!-- Conditional access for Products section -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Products</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="product_list.php" class="dropdown-item">Product list</a>
                    <a href="add_new_product.php" class="dropdown-item">Add new product</a>
                    <a href="category.php" class="dropdown-item">Category list</a>
                    <a href="add_new_category.php" class="dropdown-item">Add new category</a>
                </div>
            </div>

            
            <?php } ?>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
