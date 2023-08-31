<?php
include_once '../php-processes/config.php';
if (isset($_POST['registrate'])) {
  $newFirstName = $_POST['first_Name'];
  $newLastName = $_POST['last_Name'];
  $newUsername = $_POST['uname'];
  $newPassword = $_POST['pwd'];
  $newEmail = $_POST['email'];
  $newDate = date("Y-m-d");

  $checkQuery = "SELECT * FROM users WHERE username = '$newUsername' OR email = '$newEmail'";
  $checkResult = mysqli_query($con, $checkQuery);

  if ($checkResult->num_rows > 0) {
    echo "<script>alert('Either your email or username already exists in our systems. Consider changing them.');</script>";
  } else {
    $add = "INSERT INTO users (first_Name, last_Name, username, password, email, join_date) VALUES ('$newFirstName', '$newLastName', '$newUsername', '$newPassword', '$newEmail', '$newDate')";

    if (mysqli_query($con, $add)) {
      echo "<script>alert('Registration Successful!');</script>";
      mysqli_close($con);
      header("Location: Login.php");
      exit();
    } else {
      echo "<script>alert('There\'s a problem');</script>";
    }
  }

  mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sign Up | GWSC</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
  <section class="general-section">
    <form class="general-card normal-form" method="post">
      <h2>Sign Up</h2>
      <div class="input_field">
        <input type="text" placeholder="First Name" name="first_Name" required>
      </div>
      <div class="input_field">
        <input type="text" placeholder="Last Name" name="last_Name" required>
      </div>
      <div class="input_field">
        <input type="text" placeholder="Username" name="uname" required>
      </div>
      <div class="input_field">
        <input type="email" placeholder="Email" name="email" required>
      </div>
      <div class="input_field">
        <input type="password" placeholder="Password" name="pwd" required>
      </div>
      <div class="input_field re">
        <div class="g-recaptcha" data-sitekey="6LeD3pslAAAAADjLBinm29_ziPOTRVgbsnJ6iAdu"></div>
      </div>
      <div class="buttons">
        <span>
          By creating an account, you are indicating your
          acceptance and agreement to abide by our <a href="terms.php">Terms
            of Service</a> and <a href="terms.php#privacy-section">Privacy Policy.</a></span>
        <input type="submit" name="registrate" value="Register" class="sign_up">
      </div>
      <div class="buttons">
        <p>Already have an account?</p>
        <a href="login.php" class="log_button">Login</a>
      </div>
    </form>
  </section>
</body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</html>