<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="index.php">
            <img src="imgs/logo.png" alt="logo" style="width: 100px; height: 100%; padding: 15px;">
        </a>
        <span style="color:white;">Gallery </span> <span style="color: #d89c34;"> Cafe</span></a>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#menu-cats">Online order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="per_ordering.php">Pre-order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#promotion">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="table_reservation.php">Table reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cantact_us.php">Contact us</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                </li>
                <?php if (isset($_SESSION['email'])): ?>
                <li class="nav-item dropdown custom-dropdown">
                    <a class="nav-link" href="#" id="customDropdownToggle"><i class="fa fa-user" aria-hidden="true"></i></a>
                    <div class="custom-dropdown-menu" id="customDropdownMenu">
                        <a class="dropdown-item" href="#"><?php echo $_SESSION['email']; ?></a>
                        <a class="dropdown-item" href="php/logout.php">Logout</a>
                    </div>
                </li>
                <?php else: ?>
                <li class="nav-item">
                <a href="login_html.php" class="book-a-table-btn scrollto d-none d-lg-flex">Login</a>
                </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link book-a-table-btn scrollto d-none d-lg-flex" href="admin_dashboard/index.php">Dashboard</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
