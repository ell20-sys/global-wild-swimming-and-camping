<?php
session_start();
include_once 'php-processes/config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home | GWSC</title>
  <link rel="stylesheet" href="css/styles.css">
  <!--Slider linking start-->
  <script src="sliderengine/jquery.js"></script>
  <script src="sliderengine/amazingslider.js"></script>
  <link rel="stylesheet" type="text/css" href="sliderengine/amazingslider-1.css">
  <script src="sliderengine/initslider-1.js"></script>
  <!--Slider linking end-->
</head>

<body>
  <header>
    <div class="logo-and-nav">
      <div class="logo">
        <a href="index.php">
          <span class="a1">G</span>
          <span class="a2">W</span>
          <span class="a3">S</span>
          <span class="a4">C</span>
        </a>
      </div>
      <nav id="navigation">
        <button onclick="menuClose()" class="close">
          <span class="menu-close">&times;</span>
        </button>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="pages/information.php">Information</a></li>
          <li><a href="pages/pitch_types_and_availability.php">Pitch Types</a></li>
          <li><a href="pages/reviews.php">Reviews</a></li>
          <li><a href="pages/features.php">Features</a></li>
          <li><a href="pages/contact.php">Contact</a></li>
          <li><a href="pages/local_attractions.php">Local Attractions</a></li>
        </ul>
        <div class="search" id="search">
          <form method="post">
            <input class="search" type="text" name="search" placeholder="Search" onkeyup="performSearch(this.value)">
            <div class="result" id="searchResults"></div>
          </form>
        </div>

        <script>
          function performSearch(searchTerm) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
              if (this.readyState === 4 && this.status === 200) {
                document.getElementById("searchResults").innerHTML = this.responseText;
              }
            };
            xhttp.open("GET", "search.php?term=" + searchTerm, true);
            xhttp.send();
          }

          // Set search input value on click of result item
          function selectResult(result) {
            document.getElementsByName("search")[0].value = result;
            document.getElementById("searchResults").innerHTML = "";
          }
        </script>
      </nav>
    </div>
    <div class="aside-right">
      <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $user = $_SESSION['userDetails'];
        echo '
        <a onclick="userMenu()" class="user-profile">
          <div class="profile-circle">
            <span class="initial-letter">' . strtoupper(substr($user['username'], 0, 1)) . '</span>
          </div>
        </a>
        <div class="general-card user-men" id="user-menu">
          <h2>Signed in as:</h2>
          <div class="usernam">
          ' . $user['username'] . '
          </div>
          <br>
          <ul>
            <li><a class="logout" href="pages/user/profile.php">Profile</a></li>
            <li><a class="logout" href="pages/user/bookings.php">Bookings</a></li>
            <li>
              <a class="logout" href="php-processes/logout-process.php">
                Logout
              </a>
            </li>
          </ul>
        </div>
    ';
      } else {
        $currentURL = $_SERVER['REQUEST_URI'];
        echo "<a class='login-link' href='auth/login.php?redirect=$currentURL'>Login</a>";
        echo "<a class='cta-nav' href='pages/pitch_types_and_availability.php'>Book a pitch</a>";
      }
      ?>
      <button onclick="hamburgerMenu()" class="hamburger">
        <span class="menu-open">&#9776;</span>
      </button>
    </div>
  </header>
  <!-- Insert to your webpage where you want to display the slider -->
  <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:100%;margin:0 auto;">
    <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
      <ul class="amazingslider-slides" style="display:none;">
        <li><img src="images/image2.jpeg" alt="Off the Grid"
            data-description="Discovering Remote Destinations and Hidden Gems Around the Globe" />
        </li>
        <li><img src="images/image3.jpeg" alt="Wild Adventures"
            data-description="Exploring the World&apos;s Best Wild Swimming and Camping Spots" />
        </li>
        <li><img src="images/image1.jpeg" alt="Disconnect to Reconnect"
            data-description="Unplugging and Unwinding in Nature&apos;s Beauty" />
        </li>
      </ul>
      <ul class="amazingslider-thumbnails" style="display:none;">
        <li><img src="images/image2-tn.jpeg" alt="Off the Grid" /></li>
        <li><img src="images/image3-tn.jpeg" alt="Wild Adventures" /></li>
        <li><img src="images/image1-tn.jpeg" alt="Disconnect to Reconnect" /></li>
      </ul>
      <div class="amazingslider-engine"><a href="http://amazingslider.com"
          title="Responsive JavaScript Image Slideshow">Responsive JavaScript Image Slideshow</a></div>
    </div>
  </div>
  <!-- End of body section HTML codes -->
  <main>
    <section class="general-section">
      <h2 class="featured-pitches-heading">Featured Pitch Types</h2>
      <div class="featured-pitches-grid">
        <div class="featured-pitch general-card">
          <img src="images/pitch-types/tent_pitch1.jpeg" alt="Tent Pitch">
          <h3 class="featured-pitch-heading"> Tent</h3>
          <p class="featured-pitch-description">Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
        </div>
        <div class="featured-pitch general-card">
          <img src="images/pitch-types/caravan1.jpeg" alt="Motorhome Pitch">
          <h3 class="featured-pitch-heading">Caravan</h3>
          <p class="featured-pitch-description">Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
        </div>
        <div class="featured-pitch general-card">
          <img src="images/pitch-types/motorhome1.jpeg" alt="Motorhome Pitch">
          <h3 class="featured-pitch-heading">Motorhome</h3>
          <p class="featured-pitch-description">Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
        </div>
      </div>
      <br>
      <br>
      <a href="pages/pitch_types_and_availability" class="features-button">Book a pitch</a>
    </section>
    <section class="general-section intro-sec">
      <div class="general-card intro">
        <div class="video-ad">
          <video autoplay loop muted>
            <source src="video/promo-video.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
        <div class="introo">
          <span class="sub-before-intro-heading">WHY CHOOSE GWSC FOR YOUR NEXT NATURE ADVENTURE?</span>
          <h1 class="intro-heading">Unparalleled Natural Beauty</h1>
          <p class="intro-text">
            At Gloabal Wild Swimming and Camping, we offer breathtaking landscapes, thrilling adventures,
            and sustainable tourism. Immerse yourself in nature's beauty, find renewed inspiration,
            and create unforgettable memories with us.
            Join our journey of exploration and connect with the wonders of the natural world.
          </p>
        </div>
      </div>
    </section>
    <section class="general-section">
      <h2>Look through our Amazing camping sites</h2>
      <div class="general-card sites">
        <?php
        $quer = mysqli_query($con, "SELECT site_id, site_name, site_location, img_src FROM sites LIMIT 3");

        while ($row = mysqli_fetch_assoc($quer)) {
          $site_id = $row['site_id'];
          $site_name = $row['site_name'];
          $site_location = $row['site_location'];
          $img_src = $row['img_src'];
          ?>
          <figure>
            <img src="<?php echo $img_src; ?>" alt="<?php echo $site_name; ?>">
            <figcaption>
              <h3>
                <?php echo $site_name; ?>
              </h3>
              <p>
                <?php echo $site_location; ?>
              </p>
            </figcaption>
          </figure>
          <?php
        }
        ?>
      </div>
      <br>
      <br>
      <a class="features-button" href="pages/pitch_types_and_availability.php">Check out more</a>
    </section>
    <section class="general-section">
      <h2>Our customer reviews</h2>
      <?php
      include_once 'php-processes/config.php';
      $sql = "SELECT r.review_id, r.user_ID, r.rating, r.comment, r.timestamp, u.first_Name, u.last_Name
          FROM reviews AS r
          JOIN users AS u ON r.user_ID = u.user_ID
          WHERE r.review_id = 'rev1'";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
        // Output review information
        while ($row = $result->fetch_assoc()) {
          $rating = $row['rating'];
          $comment = $row['comment'];
          $timestamp = $row['timestamp'];
          $firstName = $row['first_Name'];
          $lastName = $row['last_Name'];

          // Output the review and user information
          echo "<div class='testimonial general-card'>";
          echo "<p>'" . $comment . "'</p>";
          echo "<cite>" . $firstName . " " . $lastName . ' ' . $timestamp . "</cite>";
          echo "<p>Rating: " . $rating . "/5</p>";
          echo "</div>";
          echo "<a href='pages/reviews.php' class='features-button'>read more...</a>";
        }
      } else {
        echo " <div class='testimonial general-card'>";
        echo "No review found.";
        echo "</div>";
      }
      $con->close();
      ?>
    </section>

    <section class="general-section features">
      <h2>Discover Our Features</h2>
      <div class="general-card amenities">
        <p>Explore the wide range of features and amenities available at our location. From leisure facilities to
          on-site amenities and nearby attractions, there's something for everyone!</p>
        <a class="features-button" href="pages/features.php">Learn More</a>
      </div>
    </section>


    <section class="general-section">
      <div class="local-cont">
        <div class="local-head">
          <h2>Local Attractions</h2>
          <span>Discover amazing attractions closer to our sites</span>
        </div>
        <div class="attraction">
          <div class="general-card at">
            <img src="images/local-attractions/site1/at1" alt="Site 1 Attraction 1">
            <h3></h3>
            <p>Brief description of attraction 1.</p>
            <a href="local-attractions.php" class="features-button">Learn More</a>
          </div>
          <div class="general-card at">
            <img src="images/local-attractions/site1/at2" alt="Site 1 Attraction 3">
            <h3>Yesterland</h3>
            <p>Brief description of attraction 2.</p>
            <a href="local-attractions.php" class="features-button"> More</a>
          </div>
          <div class="general-card at">
            <img src="images/local-attractions/site1/at3" alt="Site 1 Attraction 3">
            <h3>Golden Gate Bridge</h3>
            <p>Brief description attraction 3.</p>
            <a href="local-attractions.php" class="features-button">Learn More</a>
          </div>
          <div class="general-card at">
            <img src="images/local-attractions/site1/at4" alt="Site 1 Attraction 4">
            <h3>Santa Cruz Boardwalk</h3>
            <p>Brief description of attraction 4</p>
            <a href="local-attractions.php" class="features-button">Learn More</a>
          </div>
        </div>
      </div>
    </section>
    <section class="general-section">
      <div class="tomorrow" data-location-id="052149" data-language="EN" data-unit-system="METRIC" data-skin="light"
        data-widget-type="summary" style="padding-bottom:22px;position:relative;">
        <a href="https://www.tomorrow.io/weather-api/" rel="nofollow noopener noreferrer" target="_blank"
          style="position: absolute; bottom: 0; transform: translateX(-50%); left: 50%;">
          <img alt="Powered by the Tomorrow.io Weather API"
            src="https://weather-website-client.tomorrow.io/img/powered-by.svg" width="250" height="18">
        </a>
      </div>

    </section>
    <section class="general-section visitor-cta">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2878.5558766734202!2d-110.67848992516994!3d43.82357084139713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x535251b70e976065%3A0xde8cf1d89176c21c!2sSpalding%20Bay%20Campsites!5e0!3m2!1sen!2sgh!4v1686842746220!5m2!1sen!2sgh"
        width="400" height="300" style="border:0;" allowfullscreen="" loading=""
        referrerpolicy="no-referrer-when-downgrade"></iframe>
      <div class="general-card visit">
        <h2="visitors-heading">Our Visitors so far</h2>
          <p class="visitors-count">
            <?php
            include_once 'php-processes/visitor_count.php';
            echo $counter;
            ?>
          </p>
      </div>
    </section>
  </main>
  <footer>
    <div class="footer-content">
      <div class="footer-column">
        <h4>About Us</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel velit eu nulla dignissim aliquet.
          Praesent vestibulum elit eu iaculis malesuada.</p>
      </div>
      <div class="footer-column">
        <h4>Contact Us</h4>
        <p>123 Global, City</p>
        <p>Email: gwsc@info.com</p>
        <p>Phone: 987-065-4321 | 123-456-7890</p>
      </div>
      <div class="footer-column">
        <h4>Follow Us</h4>
        <div class="social-media-icons">
          <a href="#"><img src="images/icons/social-media/facebook.svg" alt="Facebook"></a>
          <a href="#"><img src="images/icons/social-media/twitter.svg" alt="Twitter"></a>
          <a href="#"><img src="images/icons/social-media/instagram.svg" alt="Instagram"></a>
          <a href="#"><img src="images/icons/social-media/youtube.svg" alt="YouTube"></a>
        </div>
        <div>
          <p>You are here (<a href="index.php">Home</a>)</p>
          <br>
          <br>
          <p><a href="rss/">Rss Feed</a></p>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy;
        <?php echo date("Y"); ?> GWSC. All rights reserved.
      </p>
    </div>
  </footer>


  <script src="js/script.js"></script>


  <script>
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
      var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/5f87064e2901b920769365bd/default';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
</body>

</html>