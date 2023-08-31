<?php
session_start();
include_once '../php-processes/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pitch types and availability | GWSC</title>
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
          <li><a href="pitch_types_and_availability.php" class="on_page">Pitch Types</a></li>
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
    <div class="banner-div ban-2">
      <h1>Pitch Types and Availability</h1>
    </div>
  </section>

  <main>
    <section class="general-section pitch-sec review-form">
      <form method="post">
        <label for="site">Select Date:</label>
        <input type="date" name="dates" min="2023-06-01" max="2023-09-30" required>
        <label for="site">Select Site:</label>
        <select id="site" name="site" required>
          <?php
          include_once '../php-processes/config.php';

          $query = "SELECT site_id, site_name FROM sites";
          $result = $con->query($query);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              // Ensure that the value attribute contains the site_id
              echo '<option value="' . $row["site_id"] . '">' . $row["site_name"] . '</option>';
            }
          }

          $con->close();
          ?>
        </select>

        <br><br>
        <div class="form-button">
          <input type="submit" name="check" value="Check Availability">
        </div>
      </form>

      <p>We recommend booking in advance, especially during peak seasons.</p>
      <p>Contact our customer support team for any queries or assistance.</p>
    </section>

    <?php
    $con = mysqli_connect("localhost", "root", "", "gwsc_db");
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if (isset($_POST['check'])) {
      $siteId = $_POST['site'];
      $selectedDate = date("Y-m-d", strtotime($_POST["dates"]));
      echo "<section class='general-section'><div class='general-card'>";

      $siteQuery = "SELECT *
                  FROM site_camping_swimming_view
                  WHERE site_id = $siteId";

      $siteResult = $con->query($siteQuery);

      if ($siteResult) {
        if ($siteResult->num_rows > 0) {
          $siteData = $siteResult->fetch_assoc();
          echo "<div class='site-information'>
            <img src=../" . $siteData['img_src'] . " alt='Site image'>
            <h2>" . $siteData['site_name'] . "</h2>
                  <p>{$siteData['site_location']}</p>
                  <br>
                  </div>";
        } else {
          echo "<p>No data found for the selected site.</p>";
        }
      } else {
        echo "Error in executing the query: " . $con->error;
      }

      $viewQuery = "SELECT *
                  FROM site_camping_swimming_view
                  WHERE site_id = $siteId
                  AND (pitch_date = '$selectedDate' OR slot_date = '$selectedDate')";

      $viewResult = $con->query($viewQuery);

      if ($viewResult) {
        echo "<div class='camping-and-swimming'>
              <h2>Available Camping Pitches and Swimming Slots</h2>
              <span>For {$selectedDate}" . "<br><br>";


        $campingFound = false;
        $swimmingFound = false;

        if ($viewResult->num_rows > 0) {
          while ($row = $viewResult->fetch_assoc()) {
            echo "<div class='avails'>";
            if ($row['pitch_date'] == $selectedDate && $row['pitch_availability'] > 0) {
              echo "<div class='av'>";
              echo "<p>Pitch Type: {$row['pitch_type_name']}</p>";
              echo "<p>Pitch Capacity: {$row['pitch_capacity']}</p>";
              echo "<p>Pitch Availability: {$row['pitch_availability']}</p><br>";
              echo "<input type='checkbox' name='selected_pitches[]' value='{$row['pitch_date']}' required>Select this pitch<br>";
              echo "</div>";
              $campingFound = true;
            }

            if ($row['slot_date'] == $selectedDate && $row['slot_availability'] > 0) {
              echo "<div class='av'>";
              echo "<p>Slot Capacity: {$row['slot_capacity']}</p>";
              echo "<p>Slot Availability: {$row['slot_availability']}</p><br>";
              echo "<input type='checkbox' name='selected_slots[]' value='{$row['slot_date']}' required>Select this slot<br>";
              echo "</div>";
              $swimmingFound = true;
            }
            echo "</div>";
          }
        }

        if (!$campingFound) {
          echo "<p>No camping pitches found for the selected site and date.</p>";
        }

        if (!$swimmingFound) {
          echo "<p>No swimming slots found for the selected site and date.</p>";
        }

        echo "</div>
      <br>
      <br>
      <div class='form-button'>
        <input type='submit' name='book_pitches_slots' value='Book Selected Pitches and Slots'>
      </div>
    </div></section>";
      }
    }

    if (isset($_POST['book_pitches_slots'])) {
      $selectedDate = $_POST['dates'];

      if (isset($_POST['selected_pitches']) && is_array($_POST['selected_pitches'])) {
        foreach ($_POST['selected_pitches'] as $pitch_date) {
          $insertQuery = "INSERT INTO bookings (site_id, pitch_date, booking_date)
                      VALUES ('$siteId', '$pitch_date', '$selectedDate')";
          $con->query($insertQuery);
        }
      }

      if (isset($_POST['selected_slots']) && is_array($_POST['selected_slots'])) {
        foreach ($_POST['selected_slots'] as $slot_date) {
          $insertQuery = "INSERT INTO bookings (site_id, slot_date, booking_date)
                      VALUES ('$siteId', '$slot_date', '$selectedDate')";
          $con->query($insertQuery);
        }
      }

      echo "Booking successful! Your selected pitches and slots for $selectedDate have been booked.";
    }
    ?>
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
          <p>You are here (<a href="pitch_types_and_availability.php">Pitch Types</a>)</p>
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