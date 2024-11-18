<!DOCTYPE html>
<?php
if (session_id() == '') {
    session_start();
}

// Check if the user is logged in and if their usertype is either 'admin' or 'staff'
$usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : '';

if (!isset($_SESSION['usertype']) || ($usertype != 'admin' && $usertype != 'staff')) {
    header('Location: signin.php');
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Table Reservations</title>
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
        <div class="content-wrapper p-5">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Table Reservations</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Number of Persons</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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

                                // Fetch bookings
                                $sql = "SELECT * FROM table_booking";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . htmlspecialchars($row["id"]) . "</th>";
                                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["start_time"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["end_time"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["person"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
                                        echo "<td>";
                                        echo "<a href='#' class='btn btn-primary btn-sm'>Edit</a> ";
                                        echo "<a href='#' class='btn btn-danger btn-sm'>Delete</a> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>No bookings found</td></tr>";
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>
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
