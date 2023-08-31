<?php
session_start();
include_once '../php-processes/config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Local attractions | GWSC</title>
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
          <li><a href="information.php">Information</a></li>
          <li><a href="pitch_types_and_availability.php">Pitch Types</a></li>
          <li><a href="reviews.php">Reviews</a></li>
          <li><a href="features.php">Features</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="local_attractions.php" class="on_page">Local Attractions</a></li>
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
    <div class="banner-div ban-3">
      <h1>Local attractions</h1>
    </div>
  </section>
  <main>
    <section class="general-section">
      <h2>Local Attractions</h2>
      <p>Discover the amazing local attractions near our sites. Whether you're interested in tourist attractions, scenic
        walks, or historical landmarks, there's something for everyone to explore.</p>
    </section>
    <section class="general-section">
      <div class="site">
        <h3>Lakeview Campground</h3>
        <div class="attractions general-card">
          <div class="attraction-item">
            <img src="../images/local-attractions/site1/at2" alt="Site 1 Attraction 1">
            <p>Yesterland</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site1/at3" alt="Site 1 Attraction 2">
            <p>Golden Gate Bridge</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site1/at4" alt="Site 1 Attraction 3">
            <p>Santa Cruz Boardwalk</p>
          </div>
        </div>
      </div>
      <br>
      <div class="site">
        <h3>Riverside Retreat</h3>
        <div class="attractions general-card">
          <div class="attraction-item">
            <img src="../images/local-attractions/site2/at1" alt="Site 2 Attraction 1">
            <p>Whitwater Reserve</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site2/at2" alt="Site 2 Attraction 2">
            <p>Mount Roubidoux</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site2/at3" alt="Site 2 Attraction 3">
            <p>Deers</p>
          </div>
        </div>
      </div>
      <br>
      <div class="site">
        <h3>Beachside Campsite</h3>
        <div class="attractions general-card">
          <div class="attraction-item">
            <img src="../images/local-attractions/site3/at1" alt="Site 3 Attraction 1">
            <p>Laughlin</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site3/at2" alt="Site 3 Attraction 2">
            <p>Hunting Island</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site3/at3" alt="Site 3 Attraction 3">
            <p>Apalachicola</p>
          </div>
        </div>
      </div>
      <div class="site">
        <h3>Waterfront Oasis</h3>
        <div class="attractions general-card">
          <div class="attraction-item">
            <img src="../images/local-attractions/site4/at1" alt="Site 4 Attraction 1">
            <p>Phantasma</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site4/at2" alt="Site 4 Attraction 2">
            <p>Oasis Village</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site4/at3" alt="Site 4 Attraction 3">
            <p>Sunset farms</p>
          </div>
        </div>
      </div>
      <div class="site">
        <h3>Shoreline Camping Ground</h3>
        <div class="attractions general-card">
          <div class="attraction-item">
            <img src="../images/local-attractions/site5/at1" alt="Site 5 Attraction 1">
            <p>Annett's Mono Village</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site5/at1" alt="Site 5 Attraction 2">
            <p>Mammoth</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site5/at3" alt="Site 5 Attraction 3">
            <p>Murray Bay</p>
          </div>
        </div>
      </div>
      <div class="site">
        <h3>Lakeside Haven</h3>
        <div class="attractions general-card">
          <div class="attraction-item">
            <img src="../images/local-attractions/site6/at1" alt="Site 6 Attraction 1">
            <p>The haven</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site6/at2" alt="Site 6 Attraction 2">
            <p>The Banjaran Hotsprings</p>
          </div>
          <div class="attraction-item">
            <img src="../images/local-attractions/site6/at3" alt="Site 6 Attraction 3">
            <p>Khao Sok national Park</p>
          </div>
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
          <p>You are here (<a href="local_attractions.php">Local Attractions</a>)</p>
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