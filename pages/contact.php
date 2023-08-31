<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  echo "<script>alert('Please log in first.');</script>";
  echo "<script>window.location.href = '../auth/login.php';</script>";
  exit;
}

include_once '../php-processes/config.php';
if (isset($_POST['send'])) {
  $email = $_POST['email'];
  $comment = $_POST['comment'];

  // Since the conID field is likely auto-increment, we can omit it from the query.
  $sql = "INSERT INTO contactmessages (email, comment) VALUES ('$email', '$comment')";
  $check = mysqli_query($con, $sql);

  if ($check) {
    echo "<script>alert('Message sent successfully!');</script>";
  } else {
    echo "<script>alert('Failed to send message');</script>";
  }
  $con->close();
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contact | GWSC</title>
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
          <li><a href="contact.php" class="on_page">Contact</a></li>
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
        echo "<a class='login-link' href='../auth/login.php'>Login</a>";
      }
      ?>
      <button onclick="hamburgerMenu()" class="hamburger">
        <span class="menu-open">&#9776;</span>
      </button>
    </div>
  </header>
  <section class="banner">
    <div class="banner-div ban-6">
      <h1>Contact us</h1>
    </div>
  </section>
  <main>
    <section class="general-section main-contact">
      <h2>Connect with us</h2>
      <p>Talk to our 24/7 customer service personnel for all problems regarding the website</p>
      <div class="contacts">
        <div class="contact-items item-1">
          <h3>Calls Us</h3>
          <div>
            <span>Phone:</span><br>
            <span>+19 224 556</span>
          </div>
          <div></div>
        </div>
        <div class="contact-items item-2">
          <h3>Email us too</h3>
          <div>
            <span>Email:</span><br>
            <span>info@gwsc.com</span>
          </div>
          <div></div>
        </div>
        <div class="contact-items item-3">
          <h3>Or Visit Us</h3>
          <div>
            <span>Address:</span><br>
            <span>123, Camping streek - UK</span>
          </div>
          <div></div>
        </div>
      </div>
    </section>

    <section class="general-section mapform">
      <form action="" class="general-card mapform-form normal-form" method="post">
        <h2>Contact Us</h2>
        <div class="input_field"><input type="email" name="email" id="" placeholder="Email" required></div>
        <div class="input_field"><textarea name="comment" id="" cols="30" rows="10" placeholder="Enter your message"
            required></textarea></div>
        <div>
          <div>
            <span>
              By sending us a message you are accepting to abide by our <a href="../auth/terms.php">Terms
                of Service</a> and <a href="../auth/terms.php#privacy-section">Privacy Policy.</a></span>
          </div>
          <button type="submit" name="send">Send</button>
        </div>
      </form>
      <div class="general-card mapform-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2878.5558766734202!2d-110.67848992516994!3d43.82357084139713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x535251b70e976065%3A0xde8cf1d89176c21c!2sSpalding%20Bay%20Campsites!5e0!3m2!1sen!2sgh!4v1686842746220!5m2!1sen!2sgh"
          width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
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
          <p>You are here (<a href="contact.php">Contact</a>)</p>
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
</body>

</html>