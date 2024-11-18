<!DOCTYPE html>
<?php 
   session_start();
?>  
<html lang="en">  
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to The Gallery Cafe, Colombo's premier dining destination. Enjoy delicious dishes, special events, and exciting promotions in a vibrant atmosphere.">
    <meta name="keywords" content="Gallery Cafe, Colombo restaurant, dining, food, events, promotions, special offers">
    <meta name="author" content="The Gallery Cafe">
    <title>Welcome to The Gallery Cafe</title>
   

    <?php 
        include 'inc/head-inc.php'; 
    ?>
 

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
<!-- Home Section Start -->
<section id="home" class="home-section">
    <div class="background-images">
        <div class="background-image visible"></div>
        <div class="background-image"></div>
        <div class="background-image"></div>
        <div class="background-image"></div>
        <div class="background-image"></div>
    </div>
    <div class="image-overlay">
        <h2>The Gallery Cafe</h2>
        <p>Enjoy our delicious dishes and cozy ambiance.</p>
        <a href="index.php#menu-cats" class="button">Explore Menu</a>
    </div>
</section>
<!-- Home Section End -->

<!-- Menu Section Start -->
<section id="menu-cats" class="py-5">
    <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <?php
            // SQL query to select data
            $sql = "SELECT id, category_name, description, image FROM food_category";
            $result = $connect->query($sql);

            if ($result === false) {
                // Handle query error
                die("Error: " . $connect->error);
            }

            if ($result->num_rows > 0) {
               
              // repeat untill table empty 
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card-wrapper col-md-3 py-3">';
                    echo '<div class="card text-center">';
                    echo '<img src="image_upload/category/menu/' . $row["image"] . '" alt="' . $row["category_name"] . '" class="img-set">';
                    echo '<div class="card-body">';
                    echo '<h3 class="cat-name">' . $row["category_name"] . '</h3>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '<a href="test2.php?catid=' . $row["id"] . '" class="btn btn-primary">Order now</a>'; // attach categoryid in url for identify the catergory
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No categories available.</p>';
            }
            $connect->close();
            ?>
        </div>
    </div>
</section>
<!-- Menu Section End -->

<!-- ======= About Section ======= -->
<section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="assets/img/about.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <center><h1 style="color:#cda45e;"> AboutUs</h1> </center>
            <h3>Welcome to Gallery Cafe: Colombo's Premier Dining Destination</h3>
            <p class="fst-italic">
              Welcome to Gallery Cafe, a premier dining destination located in the heart of Colombo. 
              Our cafe combines a vibrant atmosphere with exquisite cuisine, ensuring an unforgettable experience for all our guests. Here's what we offer:
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i>Elegant cafe in Colombo offering fine dining and artistic ambiance. </li>
              <li><i class="bi bi-check-circle"></i> Enjoy online orders, table reservations, and seamless pre-ordering.</li>
              <li><i class="bi bi-check-circle"></i> Discover exciting promotions and seasonal offers at Gallery Cafe.</li>
            </ul>
            <p>
            At Gallery Cafe, we are committed to providing an exceptional dining experience. Whether you're savoring a meal, hosting an event,
             or taking advantage of our convenient online services, we strive to make every moment memorable.
             Visit us in Colombo and discover the perfect blend of culinary excellence and artistic charm. We look forward to serving you!
            </p>
          </div>
        </div>

      </div>
    </section>
    <!-- End About Section -->

  <!--Special food section Start -->

 <section id="specials" class="specials">
 <div class="section-title">
          <h2>Specials</h2>
          <p>Check Our Special Foods</p>
        </div>
      <div class="container" data-aos="fade-up">

      

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Vegetarian Delight Pizza</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Chocalate lava cacke</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Mango Sticky Rice</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Seafood Platter</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Grilled Chicken Salad</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>A veggie lover's dream come true!</h3>
                    <p class="fst-italic">Savor our Vegetarian Delight Pizza, loaded with a medley of fresh vegetables, including bell peppers, mushrooms, onions,
                         olives, and tomatoes, all atop a perfectly baked crust. Topped with a generous layer of mozzarella cheese and our signature savory tomato
                          sauce, this pizza is a true treat for vegetable lovers. Perfectly seasoned and baked to perfection, 
                          it’s a delicious and wholesome choice for any meal.
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/pizza.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>A warm, gooey chocolate paradise</h3>
                    <p class="fst-italic">Indulge in our decadent Chocolate Lava Cake, a rich and moist chocolate cake with a warm, 
                        gooey center that oozes with molten chocolate. Served with a scoop of creamy vanilla ice cream, this dessert is a perfect blend of hot and
                         cold, offering a heavenly treat for chocolate lovers. Every bite is a delightful experience, making it the ultimate sweet indulgence. </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/chocalatlava.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>A sweet symphony of mango and coconut</h3>
                    <p class="fst-italic">Experience the delightful fusion of flavors with our Mango Sticky Rice. This traditional Thai dessert features perfectly ripe, 
                        sweet mango slices served alongside creamy coconut milk-infused sticky rice. The combination of the juicy mango and the rich, 
                        slightly sweet rice creates a refreshing and satisfying treat, perfect for ending your meal on a high note. </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/mango.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>A treasure trove of ocean delights.</h3>
                    <p class="fst-italic">Dive into our Seafood Platter, featuring a delectable assortment of the freshest seafood.
                         Enjoy succulent shrimp, tender calamari, and perfectly grilled fish, all served with a zesty dipping sauce. 
                         This bountiful platter is ideal for seafood lovers looking to savor a variety of ocean flavors in one satisfying dish.</p>
                </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/seafood.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Fresh, grilled perfection in every bite</h3>
                    <p class="fst-italic"> Enjoy our Grilled Chicken Salad, featuring tender, juicy chicken grilled to perfection and served on a bed of crisp, 
                        mixed greens. This refreshing salad is topped with a medley of fresh vegetables and your choice of dressing,
                         making it a light yet satisfying meal. Perfect for a healthy lunch or dinner, it combines delicious flavors with a nutritious twist. </p>
                </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/green.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    
    <!-- ======= Events Section ======= -->
<section id="events" class="events">
<div class="section-title">
      <h2>Events</h2>
      <p>Organize Your Events in our Restaurant</p>
    </div>
  <div class="container" data-aos="fade-up">
    <div class="events-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-wrapper">
        <!-- Repeat for other events -->
        <div class="swiper-slide">
          <div class="row event-item">
            <div class="col-lg-6">
              <img src="assets/img/Birthday-Parties.png" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content">
              <h3>Birthday Parties</h3>
              <div class="price">
                <p><span>RS. 10000</span></p>
              </div>
              <p class="fst-italic">
              Celebrate your special day in style with us! Our restaurant transforms into a festive haven where every birthday is honored with a tailored experience, 
              </p>
              <p>
              Celebrate your special day with us! Our restaurant offers a memorable birthday experience with customized packages designed to make 
              your celebration unforgettable. Enjoy a delicious menu tailored to your preferences, personalized decorations, and exceptional service.
               Whether it's an intimate gathering or a grand party, we ensure every detail is perfect.
               Make your birthday truly special with our exclusive offers and let us help you create cherished memories with friends and family. </p>
            </div>
          </div>
        </div>
        <!-- Repeat for other events -->
                 <!-- Repeat for other events -->
        <div class="swiper-slide">
          <div class="row event-item">
            <div class="col-lg-6">
              <img src="assets/img/wedding.jpeg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content">
              <h3>Wedding event</h3>
              <div class="price">
                <p><span>RS. 15000</span></p>
              </div>
              <p class="fst-italic">"Celebrate your special day surrounded by artful elegance at the Gallery Cafe Hotel, where every moment is crafted with love and care."              </p>
              <p>
              A wedding event at the Gallery Cafe Hotel promises an enchanting blend of elegance and charm. Nestled within a picturesque setting,
               the hotel offers a unique and intimate atmosphere perfect for celebrating love. The Gallery Cafe, known for its artistic ambiance and cozy charm, 
               provides a stunning backdrop for both the ceremony and reception. With its tasteful decor, beautiful artwork, and warm lighting,
                 </p>
            </div>
          </div>
        </div>
        <!-- Repeat for other events -->
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section><!-- End Events Section -->


<!-------------------promation ---------------------------->
<div class="container" id="promotion">
    <div class= "col-12 py-3 text-contnttitle">
        <h1> Promotion </h1>
    </div>
        </div>

<div class="container display-flex" data-aos="fade-up" data-aos-delay="100">
    <div class="card-wrapper col-md-4 p-3">
        <div class="card text-center">
            <video autoplay loop muted playsinline>
                <source src="pro1.mp4" type="video/mp4">
            </video>
            <div class="card-body">
            <p> <b> Indulge in our delicious Combo Meal featuring a juicy Beef Burger, crispy French Fries, and a refreshing Soft Drink. 
                All this for just RS.1500! Treat yourself to this amazing deal and enjoy a satisfying meal that hits all the right spots. </b> </p>
            </div>
        </div>
    </div>

    <div class="card-wrapper col-md-4 p-3">
    <div class="card text-center">
        <video autoplay loop muted playsinline>
            <source src="pro2.mp4" type="video/mp4">
        </video>
        <div class="card-body">
            <p> <b> Enjoy our mouth-watering, spicy Hot Biryani with a sizzling 25% off! 
                Dive into the rich flavors and aromatic spices that make this dish a favorite. 
                Don’t miss out on this fiery deal—perfect for biryani lovers!</b> </p>
            </div>
    </div>
</div>

<div class="card-wrapper col-md-4 p-3">
    <div class="card text-center">
        <video autoplay loop muted playsinline>
            <source src="pro3.mp4" type="video/mp4">
        </video>
        <div class="card-body">
            <p> <b> EGet our delicious Chicken Wrapper at an unbeatable 50% off! Savor the tender chicken wrapped in a soft tortilla, 
                packed with fresh ingredients and bursting with flavor. Hurry, this incredible offer won't last long!</b> </p>
            </div>
    </div>
</div>
</div>
<!--------------------------------------promotion end --------------------------------->
  

  
  

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
