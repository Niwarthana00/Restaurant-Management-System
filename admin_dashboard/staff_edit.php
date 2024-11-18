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

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch staff details
$staff_id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT name, phonenumber, email FROM users WHERE id = '$staff_id' AND usertype = 'staff'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    header('Location: staff_user.php');
    exit();
}

$conn->close();
?>
<head>
    <meta charset="utf-8">
    <title>Edit Staff</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php 
        include 'inc/head.php';
    ?>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <?php include 'inc/side_bar.php'; ?>
        <div class="content">
            <?php include 'inc/nav.php'; ?>
            <div class="container-fluid admin-login">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <h3 class="text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Edit Staff</h3>
                            <form method="POST" action="update_staff.php">
                                <input type="hidden" name="id" value="<?php echo $staff_id; ?>">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="floatingName" placeholder="Name" value="<?php echo $row['name']; ?>" required>
                                    <label for="floatingName">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="phone" id="floatingPhone" placeholder="077-8906782" value="<?php echo $row['phonenumber']; ?>" required>
                                    <label for="floatingPhone">Phone Number</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="name@example.com" value="<?php echo $row['email']; ?>" required>
                                    <label for="floatingEmail">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password (Leave blank to keep existing password)</label>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'inc/footer.php'; ?>
</body>
</html>
