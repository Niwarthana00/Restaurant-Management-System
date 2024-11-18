<!DOCTYPE html>
<html lang="en">
<?php 
if (session_id() == '') {
    session_start();
}

// Check if the user is logged in and has the correct usertype
$usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : '';

if (!isset($_SESSION['usertype']) || $usertype != 'admin') {
    header('Location: signin.php');
    exit();
}
?>
<head>
    <meta charset="utf-8">
    <title>Add New Staff</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php 
        include 'inc/head.php';
    ?>
</head>

<body>
    
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <?php 
        include 'inc/side_bar.php';
        ?>

        <!-- Content Start -->
        <div class="content">
        <?php 
        include 'inc/nav.php';
        ?>

        <div class="container-fluid admin-login">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.php" class="">
                                <h3 class="text-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Staff</h3>
                            </a>
                        </div>
                        
                        <form method="POST" action="add_staff.php">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Name" required>
                                <label for="floatingInput">Enter your name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="phone" id="floatingInput" placeholder="077-8906782" required>
                                <label for="floatingInput">Enter your phone number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                         
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>

    <?php 
        include 'inc/footer.php';
    ?>

</body>

</html>
