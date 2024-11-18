<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Categories List</title>
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
        <h6 class="mb-4">Categories List</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category Name</th>
                        <th scope="col" width="500">Description</th>
                        <th scope="col">Image</th>
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

                    // Fetch category details
                    $sql = "SELECT id, category_name, description, image FROM food_category ORDER BY id ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td scope='row'>" . $row["id"] . "</th>";
                            echo "<td>" . $row["category_name"] . "</td>";
                            echo "<td width='500'>" . $row["description"] . "</td>";
                            echo "<td><img src='../image_upload/category/menu/" . $row["image"] . "' alt='" . $row["category_name"] . "' width='50'></td>";
                            echo "<td>";
                            echo "<a href='edit_category.php?type=category&id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Edit</a> ";
                            echo "<a href='javascript:void(0);' onclick='confirmDelete(\"food_category\", " . $row["id"] . ")' class='btn btn-danger btn-sm'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No categories found</td></tr>";
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

    <script>
        function confirmDelete(table, id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = 'delete.php?table=' + table + '&id=' + id;
            }
        }
    </script>

</body>

</html>
