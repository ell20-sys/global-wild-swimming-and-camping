<?PHP
include_once "../../php-processes/config.php";
session_start();

if ($_SESSION['userDetails'] !== null) {
  $user = $_SESSION['userDetails'];
}
?>
<!DOCTYPE html>
<html lang="en">
<title>Bookings | GWSC</title>
<link rel="stylesheet" href="../../css/styles.css">
</head>

<body>
  <header>
    <div class="logo">
      <a href="../../index.php">
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
        <li><a href="../../index.php">Home</a></li>
        <li><a href="../information.php">Information</a></li>
        <li><a href="../pitch_types_and_availability.php">Pitch Types</a></li>
        <li><a href="../reviews.php">Reviews</a></li>
        <li><a href="../features.php">Features</a></li>
        <li><a href="../contact.php">Contact</a></li>
        <li><a href="../local_attractions.php">Local Attractions</a></li>
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
          xhttp.open("GET", "../../search.php?term=" + searchTerm, true);
          xhttp.send();
        }

        // Set search input value on click of result item
        function selectResult(result) {
          document.getElementsByName("search")[0].value = result;
          document.getElementById("searchResults").innerHTML = "";
        }
      </script>
    </nav>
    <div class="aside-right">
      <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
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
            <li><a class="logout" href="profile.php">Profile</a></li>
            <li><a class="logout" href="bookings.php">Bookings</a></li>
            <li>
              <a class="logout" href="../../php-processes/logout-process.php">
                Logout
              </a>
            </li>
          </ul>
        </div>
    ';
      }
      ?>
      <button onclick="hamburgerMenu()" class="hamburger">
        <span class="menu-open">&#9776;</span>
      </button>
    </div>
  </header>
  <main>
    <section class="profile-section">
      <div class="navigation">
        <a href="profile.php">Profile</a> |
        <a href="bookings.php" class="user-current">Bookings</a> | <a href="change.php">Change password</a>
      </div>

      <div class="dash">
        <div class="circle">
          <span>
            <?php echo strtoupper(substr($user['username'], 0, 1)) ?>
          </span>
        </div>
        <div class="usernam">
          <?php echo $user['username'] ?>
        </div>
        <div>
          <span>join date:</span>
          <span>
            <?php echo $user['join_date'] ?>
          </span>
        </div>
        <div>
          <a href="../../php-processes/logout-process.php">
            Logout</a>
        </div>
      </div>
      <div class="form">
        <?php
        $user = $_SESSION['userDetails'];
        // Query the bookings associated with the user
        $userBookingsQuery = "SELECT b.booking_id, s.site_name, pt.pitch_type_name, ss.slot_date, b.booking_date
                      FROM bookings b
                      LEFT JOIN sites s ON b.site_id = s.site_id
                      LEFT JOIN camping_pitches cp ON b.pitch_id = cp.pitch_id
                      LEFT JOIN swimming_slots ss ON b.slot_id = ss.slot_id
                      LEFT JOIN pitch_types pt ON cp.pitch_type_id = pt.pitch_type_id
                      WHERE b.user_id = '" . $user['user_ID'] . "'";
        $userBookingsResult = $con->query($userBookingsQuery);



        if (!$userBookingsResult) {
          // Query execution failed, display the error message
          echo "Error in executing the query: " . $con->error;
        } else {
          // The query executed successfully
          if ($userBookingsResult->num_rows > 0) {
            echo '<table>
                <tr>
                    <th>Booking ID</th>
                    <th>Site Name</th>
                    <th>Pitch Type</th>
                    <th>Swimming Slot Date</th>
                    <th>Booking Date</th>
                </tr>';
            // Display the user's bookings in the table
            while ($bookingRow = $userBookingsResult->fetch_assoc()) {
              echo '<tr>
                    <td>' . $bookingRow['booking_id'] . '</td>
                    <td>' . $bookingRow['site_name'] . '</td>
                    <td>' . $bookingRow['pitch_type_name'] . '</td>
                    <td>' . $bookingRow['slot_date'] . '</td>
                    <td>' . $bookingRow['booking_date'] . '</td>
                  </tr>';
            }
            echo '</table>';
          } else {
            // No bookings found for the user
            echo '<p>No bookings found for the user.</p>';
          }
        }
        ?>


      </div>

    </section>
  </main>
  <script src="../../js/script.js"></script>
</body>

</html>