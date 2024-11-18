 <!DOCTYPE html>
<?php 
   session_start();

   if (!isset($_SESSION['email'])) {
       header("Location: login_html.php");
       exit();
   }
?>  
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to The Gallery Cafe</title>

    <?php 
        include 'inc/head-inc.php'; 
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="css/menu.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">


<!-- special food & event style start -->
      <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
      <!-- Vendor CSS Files -->
      <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


      <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">

<!-- special food & event style end -->
 <style>
  [data-aos][data-aos][data-aos-delay="100"].aos-animate, body[data-aos-delay="100"] [data-aos].aos-animate {
    transform: translateZ(0);
  }
  </style>


</head>

<body class="home">
<?php
    include 'inc/header.php'; 
    include 'php/db.php';
?>

<!-- Book Table start-->
<section class="reservation-section">
    <div class="reservation-container">
        <h2 class="reservation-title">Reservation</h2>
        <h1 class="reservation-heading">BOOK A TABLE</h1>
        <form class="reservation-form" action="php/table_booking.php" method="POST">
            <div class="form-row">
                <input type="text" name="name" placeholder="Your Name*" required>
                <input type="email" name="email" placeholder="Email Address*" required>
                <input type="text" name="phone" placeholder="Phone*" required>
            </div>
            <div class="form-row">
            <input type="date" name="date" class="form-control book_date" placeholder="DD/MM/YYYY*" required>
                <select name="start_time" class="combo" required>
                    <option value="">Start Time*</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="18:00">6:00 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="21:00">9:00 PM</option>
                </select>
                <select name="end_time" class="combo" required>
                    <option value="">End Time*</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="18:00">6:00 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="21:00">9:00 PM</option>
                </select>
                <input type="number" name="person" placeholder="Person*" required>
            </div>
            <div class="form-row">
                <textarea name="message" placeholder="Additional information"></textarea>
            </div>
            <button type="submit">BOOK NOW</button>
        </form>
    </div>
</section>
<!-- Book Table end -->



<?php 
    include 'inc/footer.php';
?>

<!-- Vendor JS Files -->
<script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>
