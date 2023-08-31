<?php
session_start();
$_SESSION['previous_url'] = $_SERVER['HTTP_REFERER'];
include_once "../php-processes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Information | GWSC</title>
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
          <li><a href="../index.php">Home</a></li>
          <li><a href="information.php" class="on_page">Information</a></li>
          <li><a href="pitch_types_and_availability.php">Pitch Types</a></li>
          <li><a href="reviews.php">Reviews</a></li>
          <li><a href="features.php">Features</a></li>
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
    <div class="banner-div ban-4">
      <h1>Information</h1>
    </div>
  </section>
  <main>
    <section class="general-section">
      <div class="general-card">
        <h2>Pitch Types and availability</h2>
        <div>
          <?php
          $sql = "SELECT pt.pitch_type_name, cp.pitch_date, cp.pitch_capacity
FROM pitch_types pt
INNER JOIN camping_pitches cp ON pt.pitch_type_id = cp.pitch_type_id
ORDER BY pt.pitch_type_name, cp.pitch_date";

          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            $current_pitch_type = null;
            echo "<h2>Available Pitches:</h2>";

            while ($row = $result->fetch_assoc()) {
              $pitch_type_name = $row["pitch_type_name"];
              $pitch_date = $row["pitch_date"];
              $pitch_capacity = $row["pitch_capacity"];

              // Check if the pitch type has changed to print the pitch type name
              if ($current_pitch_type !== $pitch_type_name) {
                echo "<h3>{$pitch_type_name}</h3>";
                $current_pitch_type = $pitch_type_name;
              }

              // Display available dates and capacity for the pitch
              echo "<p>Date: {$pitch_date}, Capacity: {$pitch_capacity}</p>";

            }
          } else {
            echo "No pitches found.";
          }
          ?>
        </div>
      </div>
    </section>
    <section class="general-section">
      <div class="general-card">
        <h2>Features</h2>
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
            </div>
          </section>
          <a class="features-button" href="features.php">Check out more</a>

        </div>
      </div>
    </section>
    <section class="general-section">
      <div class="general-card">
        <h2>Locations</h2>
        <div class="sites">
          <?php
          $quer = mysqli_query($con, "SELECT site_id, site_name, site_location, img_src FROM sites");

          while ($row = mysqli_fetch_assoc($quer)) {
            $site_id = $row['site_id'];
            $site_name = $row['site_name'];
            $site_location = $row['site_location'];
            $img_src = $row['img_src'];
            ?>
            <figure>
              <img src="<?php echo "../" . $img_src; ?>" alt="<?php echo $site_name; ?>">
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
        <a class="features-button" href="pitch_types_and_availability.php">Book Now</a>
      </div>
    </section>
    <section class="general-section">
      <div class="general-card">
        <h2>Local attractions</h2>
        <div class="site general-card">
          <div class="attractions">
            <div class="attraction-item">
              <img src="../images/local-attractions/site1/at1" alt="Site 1 Attraction 1">
              <p></p>
            </div>
            <div class="attraction-item">
              <img src="../images/local-attractions/site1/at2" alt="Site 1 Attraction 2">
              <p>Yesterland</p>
            </div>
            <div class="attraction-item">
              <img src="../images/local-attractions/site1/at3" alt="Site 1 Attraction 3">
              <p>Golden Gate Bridge</p>
            </div>
            <div class="attraction-item">
              <img src="../images/local-attractions/site1/at4" alt="Site 1 Attraction 4">
              <p>Santa Cruz Boardwalk</p>
            </div>
            <div class="attraction-item">
              <img src="../images/local-attractions/site1/at5" alt="Site 1 Attraction 5">
              <p>Big sur</p>
            </div>
            <div class="attraction-item">
              <img src="../images/local-attractions/site1/at6" alt="Site 1 Attraction 6">
              <p>Holywood</p>
            </div>
          </div>
          <br>
          <br>
          <a class="features-button" href="local_attractions.php">View more of these </a>
        </div>
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
          <a href="#"><img src="../images/icons/social-media/facebook.svg" alt="Facebook"></a>
          <a href="#"><img src="../images/icons/social-media/twitter.svg" alt="Twitter"></a>
          <a href="#"><img src="../images/icons/social-media/instagram.svg" alt="Instagram"></a>
          <a href="#"><img src="../images/icons/social-media/youtube.svg" alt="YouTube"></a>
        </div>
        <div>
          <p>You are here (<a href="information.php">Information</a>)</p>
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