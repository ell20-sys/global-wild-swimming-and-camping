<?php
session_start();
include_once '../php-processes/config.php';

if (isset($_POST['review'])) {
  $rating = $_POST['rating'];
  $comment = $_POST['comment'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];

  // Insert the new review into the database
  $sql = "INSERT INTO reviews (first_Name, last_Name, rating, comment) VALUES ('$firstName', '$lastName', '$rating', '$comment')";
  $result = mysqli_query($con, $sql);

  if ($result) {
    echo '<script>alert("Review submitted successfully");</script>';
  } else {
    echo '<script>alert("Review could not be submitted");</script>';
  }
}

// Output the existing reviews
$sql = "SELECT r.rating, r.comment, r.timestamp, u.first_Name, u.last_Name
        FROM reviews AS r
        JOIN users AS u ON r.user_ID = u.user_ID";
$result = mysqli_query($con, $sql);

// Fetch all reviews and store them in an array
$reviews = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
  }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Reviews | GWSC</title>
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
          <li><a href="reviews.php" class="on_page">Reviews</a></li>
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
        echo "<a class='login-link' href='auth/login.php?redirect=$currentURL'>Login</a>";
      }
      ?>
      <button onclick="hamburgerMenu()" class="hamburger">
        <span class="menu-open">&#9776;</span>
      </button>
    </div>
  </header>
  <section class="banner">
    <div class="banner-div ban-1">
      <h1>Reviews</h1>
    </div>
  </section>
  <main>
    <section class="general-section">
      <?php
      // Display the existing reviews
      if (!empty($reviews)) {
        foreach ($reviews as $review) {
          $rating = $review['rating'];
          $comment = $review['comment'];
          $timestamp = $review['timestamp'];
          $firstName = $review['first_Name'];
          $lastName = $review['last_Name'];

          // Calculate the number of filled and unfilled stars
          $filledStars = floor($rating);
          $unfilledStars = 5 - $filledStars;

          echo "<div class='testimonial general-card'>";
          echo "<p>'" . $comment . "'</p>";
          echo "<cite>" . $firstName . " " . $lastName . ' ' . $timestamp . "</cite>";
          echo "<p>Rating: ";

          // Display filled stars
          for ($i = 0; $i < $filledStars; $i++) {
            echo "<img src='../images/rating/star-fill.svg' alt='Filled Star'>";
          }

          // Display unfilled stars
          for ($i = 0; $i < $unfilledStars; $i++) {
            echo "<img src='../images/rating/star.svg' alt='Empty Star'>";
          }

          echo "</p>";
          echo "</div>";
        }
      } else {
        echo "<div class='testimonial general-card'>";
        echo "No review found.";
        echo "</div>";
      }
      ?>
    </section>


    <section class="general-section">


      <div class="general-card review-form">
        <form method="POST" action=""> <!-- Remove the inner form tag -->
          <h3>Leave a Review</h3>
          <div>
            <label for="First name">First name:</label>
            <input type="text" name="firstName" placeholder="">
          </div>
          <div>
            <label for="lastName">Last name:</label>
            <input type="text" name="lastName" placeholder="">
          </div>
          <div>
            <label for="rating">Rating:</label>
            <select name="rating" id="">
              <option>Rate...</option>
              <option value="5">Perfect</option>
              <option value="4">Good</option>
              <option value="3">Average</option>
              <option value="2">Not that bad</option>
              <option value="1">Very Poor</option>
            </select>
          </div>
          <div>
            <label for="comment">Comment:</label>
            <textarea name="comment" required></textarea>
          </div>
          <button type="submit" value="review">Submit Review</button>
        </form>
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
          <p>You are here (<a href="reviews.php">Reviews</a>)</p>
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