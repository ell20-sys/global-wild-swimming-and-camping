<?php
session_start();
$_SESSION['previous_url'] = $_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Features | GWSC</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
  <header>
    <div class="logo-and-nav">
      <div class="logo">
        <a href="../index.php">
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
          <!--Navigation links-->
          <li><a href="../index.php">Home</a></li>
          <li><a href="information.php">Information</a></li>
          <li><a href="pitch_types_and_availability.php">Pitch Types</a></li>
          <li><a href="reviews.php">Reviews</a></li>
          <li><a href="features.php" class="on_page">Features</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="local_attractions.php">Local Attractions</a></li>
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
            xhttp.open("GET", "../search.php?term=" + searchTerm, true);
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
            <li><a class="logout" href="user/profile.php">Profile</a></li>
            <li><a class="logout" href="user/bookings.php">Bookings</a></li>
            <li>
              <a class="logout" href="../php-processes/logout-process.php">
                Logout
              </a>
            </li>
          </ul>
        </div>
    ';
      } else {
        $currentURL = $_SERVER['REQUEST_URI'];
        echo "<a class='login-link' href='../auth/login.php?redirect=$currentURL'>Login</a>";
      }
      ?>
      <button onclick="hamburgerMenu()" class="hamburger">
        <span class="menu-open">&#9776;</span>
      </button>
    </div>
  </header>
  <section class="banner">
    <div class="banner-div ban-5">
      <h1>Features</h1>
    </div>
  </section>
  <main class="feat">
    <div class="feature-section">
      <section class="general-section">
        <h2>Features</h2>
        <div class="feature-grid">
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/entertainment" alt="">Entertainment</li>
            </ul>
          </div>
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/fitness" alt="">Fitness Center</li>
            </ul>
          </div>
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/swim-pool" alt="">Swimming Pool</li>
            </ul>
          </div>
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/sports" alt="">Sports Facilities</li>
            </ul>
          </div>
        </div>
      </section>
      <br>
      <section class="general-section">
        <h2>On-Site Amenities</h2>
        <div class="feature-grid">
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/parking" alt="">Car Parking</li>
            </ul>
          </div>
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/shower" alt="">Showers</li>
            </ul>
          </div>
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/internet" alt="">Internet Access</li>
            </ul>
          </div>
        </div>
      </section>
      <br>
      <section class="general-section">
        <h2>Nearby Amenities</h2>
        <div class="feature-grid">
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/restocaf" alt="">Restaurants and Cafes</li>
            </ul>
          </div>
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/shop" alt="">Shopping Centers</li>
            </ul>
          </div>
          <div class="feature-box">
            <ul class="feature-list">
              <li><img src="../images/icons/features/pargreen" alt="">Parks and Green Spaces</li>
            </ul>
          </div>
        </div>
      </section>
      <br>
      <section class="general-section">
        <h2>Rules</h2>
        <ol>
          <li>Respect quiet hours from 10 PM to 8 AM.</li>
          <li>No open fires allowed in the camping area.</li>
          <li>Dispose of waste in designated bins and recycling stations.</li>
        </ol>
        <p>To ensure the safety and comfort of all guests, please adhere to the following rules and guidelines during
          your visit.</p>
      </section>


    </div>
    <div class="general-section feature-aside">
      <div>
        <h2>Wearable Technology Categories</h2>
        <ul class="aside-grid-container">
          <li>
            <span class="general-card aside-li">Smartwatches</span>
            <div class="techs">
              <img src="../images/tech/watch/watch1" alt="Pitcture of a watch 1">
              <img src="../images/tech/watch/watch2" alt="Pitcture of a watch 2">
              <img src="../images/tech/watch/watch3" alt="Pitcture of a watch 3">
              <img src="../images/tech/watch/watch4" alt="Pitcture of a watch 4">
            </div>
          </li>
          <li>
            <span class="general-card aside-li">Activity Trackers</span>
            <div class="techs">
              <img src="../images/tech/activity/activity1" alt="Pitcture of activity tracker 1">
              <img src="../images/tech/activity/activity2" alt="Pitcture of activity tracker 2">
              <img src="../images/tech/activity/activity3" alt="Pitcture of activity tracker 3">
              <img src="../images/tech/activity/activity4" alt="Pitcture of activity tracker 4">
            </div>
          </li>
          <li>
            <span class="general-card aside-li">Smart Clothing</span>
            <div class="techs">
              <img src="../images/tech/clothing/clothing1" alt="Pitcture of smart clothing 1">
              <img src="../images/tech/clothing/clothing2" alt="Pitcture of smart clothing 2">
              <img src="../images/tech/clothing/clothing3" alt="Pitcture of smart clothing 3">
              <img src="../images/tech/clothing/clothing4" alt="Pitcture of smart clothing 4">
            </div>
          </li>
          <li>
            <span class="general-card aside-li">Smart Jewelry</span>
            <div class="techs">
              <img src="../images/tech/jews/jew1" alt="Pitcture of Smart Jewelry 1">
              <img src="../images/tech/jews/jew2" alt="Pitcture of Smart Jewelry 2">
              <img src="../images/tech/jews/jew3" alt="Pitcture of Smart Jewelry 3">
              <img src="../images/tech/jews/jew4" alt="Pitcture of Smart Jewelry 4">
            </div>
          </li>
        </ul>
      </div>
    </div>
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
          <a href="#"><img src="../images/icons/social-media/facebook.svg" alt="Facebook"></a>
          <a href="#"><img src="../images/icons/social-media/twitter.svg" alt="Twitter"></a>
          <a href="#"><img src="../images/icons/social-media/instagram.svg" alt="Instagram"></a>
          <a href="#"><img src="../images/icons/social-media/youtube.svg" alt="YouTube"></a>
        </div>
        <div>
          <p>You are here (<a href="features.php">Features</a>)</p>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy;
        <?php echo date("Y"); ?> GWSC. All rights reserved.
      </p>
    </div>
  </footer>

  <script src="../js/script.js"></script>
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