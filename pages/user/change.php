<?php
include_once "../../php-processes/config.php";
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  $user = $_SESSION['userDetails'];

  if (isset($_POST['change'])) {
    $opwd = $_POST['opwd'];
    $npwd = $_POST['npwd'];
    $cpwd = $_POST['cpwd'];

    $checkQuery = "SELECT password FROM users WHERE user_ID = '{$user['user_ID']}'";
    $checkResult = mysqli_query($con, $checkQuery);
    $det = mysqli_fetch_assoc($checkResult);

    if ($det) {
      $retrievedPwd = $det['password'];
      if ($retrievedPwd === $opwd) {
        if ($npwd === $cpwd) {
          $updateQuery = "UPDATE users SET password = '$npwd' WHERE user_ID = '{$user['user_ID']}'";
          $updateResult = mysqli_query($con, $updateQuery);

          if ($updateResult) {
            echo '<script>alert("Congrats! passwords have been changed :) ");</script>';
          } else {
            echo '<script>alert("Could not update password :( ");</script>';
          }
        } else {
          echo '<script>alert("Sorry, your passwords do not match :\\ ");</script>';
        }
      } else {
        echo '<script>alert("Invalid old password :[");</script>';
      }
    }
  }
} else {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<title>Change Password | GWSC</title>
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
        <a href="bookings.php">Bookings</a> | <a href="change.php" class="user-current">Change password</a>
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
        <form method="POST">
          <?php
          if ($user !== null) {
            echo '<div class="password-change" id="pass-change">';
            echo '<div class="form-field">';
            echo '<label for="opwd">Old Password</label>';
            echo '<input type="password" name="opwd">';
            echo '</div>';
            echo '<div class="form-field">';
            echo '<label for="npwd">New Password</label>';
            echo '<input type="password" name="npwd">';
            echo '</div>';
            echo '<div class="form-field">';
            echo '<label for="cpwd">Confirm Password</label>';
            echo '<input type="password" name="cpwd">';
            echo '</div>';
            echo '</div>';
            echo '<div class="form-button">';
            echo '<input type="submit" name="change" value="Change">';
            echo '</div>';
          } else {
            echo "User not logged in";
          }
          ?>
        </form>
      </div>
    </section>
  </main>
  <script src="../../js/script.js"></script>
</body>

</html>