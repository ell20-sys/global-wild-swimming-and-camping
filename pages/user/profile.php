<?php
include_once "../../php-processes/config.php";
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  $user = $_SESSION['userDetails'];

  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $first_Name = $_POST['first_Name'];
    $last_Name = $_POST['last_Name'];

    if ($con) {
      $checkQuery = "UPDATE users SET email = '$email', first_Name = '$first_Name', last_Name = '$last_Name', username = '$username' WHERE user_ID ='{$user['user_ID']}' ";
      $checkResult = mysqli_query($con, $checkQuery);
      if ($checkResult) {
        echo '<script>alert("Congrats your details have been updated :");</script>';

        $user['email'] = $email;
        $user['first_Name'] = $first_Name;
        $user['last_Name'] = $last_Name;
        $user['username'] = $username;
        $_SESSION['userDetails'] = $user;
      } else {
        echo '<script>alert("Oops, there is a problem here");</script>';
      }
    }
  }
} else {
  header("Location: login.php");
  exit;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Profile | GWSC</title>
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
        <a href="profile.php" class="user-current">Profile</a> |
        <a href="bookings.php">Bookings</a> | <a href="change.php">Change password</a>
      </div>
      <br>
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
        <div class="usernam-2">
          <span>
            <?php echo $user['username']; ?>
          </span>
          |
          <a href="../../php-processes/logout-process.php">Logout</a>
        </div>

        <?php

        if ($user !== null) {


          echo '<form method="post">';
          echo '<div class="form-field">';
          echo '<label for="join-date">Join date</label>';
          echo '<input type="text" id="join-date" name="join_date" value="' . $user['join_date'] . '" readonly>';
          echo '</div>';
          echo '<div class="form-field">';
          echo '<label for="email">Email address</label>';
          echo '<input type="email" id="email" name="email" value="' . $user['email'] . '">';
          echo '</div>';
          echo '<div class="form-field">';
          echo '<label for="first_Name">First name</label>';
          echo '<input type="text" id="first_Name" name="first_Name" value="' . $user['first_Name'] . '">';
          echo '</div>';
          echo '<div class="form-field">';
          echo '<label for="last_Name">last name</label>';
          echo '<input type="text" id="last_Name" name="last_Name" value="' . $user['last_Name'] . '">';
          echo '</div>';
          echo '<div class="form-field">';
          echo '<label for="username">Username</label>';
          echo '<input type="text" id="username" name="username" value="' . $user['username'] . '">';
          echo '</div>';

          echo '<div class="form-button">';
          echo '<input type="submit" name="submit" value="Update">';
          echo '</div>';
          echo '</form>';
        } else {
          echo 'User details not found.';
        }
        ?>
      </div>
    </section>
  </main>
  <script src="../../js/script.js"></script>
</body>

</html>