<?php
session_start();
include_once('../php-processes/config.php');
$msg = '';

if (isset($_POST['submit'])) {
  $time = time() - 600;
  $ip_address = getIpAddr();

  $query = mysqli_query($con, "SELECT COUNT(*) AS total_count, MAX(attemptTime) AS last_attempt FROM logs WHERE attemptTime > $time AND IP='$ip_address'");
  $check_login_row = mysqli_fetch_assoc($query);
  $total_count = $check_login_row['total_count'];
  $last_attempt = $check_login_row['last_attempt'];

  if ($total_count >= 3) {
    $remaining_time = $last_attempt + 600 - time();
    $minutes_remaining = ceil($remaining_time / 60);

    $msg = "Too many failed login attempts. Please try again after $minutes_remaining minutes";
  } else {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $res = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($res) > 0) {
      $userDetails = mysqli_fetch_assoc($res);

      $_SESSION['loggedin'] = true;
      $_SESSION['userDetails'] = $userDetails;

      mysqli_query($con, "DELETE FROM logs WHERE IP='$ip_address'");

      if (isset($_GET['redirect'])) {
        $redirectURL = $_GET['redirect'];
        header("Location: $redirectURL");
        exit;
      } else {
        header("Location: ../index.php");
        exit;
      }
    } else {
      $total_count++;
      $rem_attm = 3 - $total_count;

      if ($rem_attm == 0) {
        $remaining_time = $last_attempt + 600 - time();
        $minutes_remaining = ceil($remaining_time / 60);
        $msg = "Too many failed login attempts. Please try again after " . $minutes_remaining . " minutes";
      } else {
        $msg = "Please enter valid login details.<br/>$rem_attm attempts remaining.";
      }

      $try_time = time();
      mysqli_query($con, "INSERT INTO logs(IP,attemptTime) VALUES ('$ip_address','$try_time')");
    }
  }
}

function getIpAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ipAddr = $_SERVER['REMOTE_ADDR'];
  }

  return $ipAddr;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login | GWSC</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <section class="general-section">
    <form class="general-card normal-form" method="post">
      <h2>Login</h2>
      <div class="input_field">
        <input type="text" placeholder="Username" name="username">
      </div>
      <div class="input_field">
        <input type="password" placeholder="Password" name="password">
      </div>
      <div class="input_field re">
        <div class="g-recaptcha" data-sitekey="6LeD3pslAAAAADjLBinm29_ziPOTRVgbsnJ6iAdu"></div>
      </div>
      <div class="buttons">
        <input type="submit" name="submit" value="Login" class="log_button">
        <a href="reset_pass.php">Forgot password?</a>
      </div>
      <div class="buttons">
        <p>Don't have an account?</p>
        <a href="sign_up.php" class="sign_up">Register</a>
      </div>
      <div id="result">
        <?php echo $msg ?>
      </div>
    </form>
  </section>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="../js/script.js"></script>
</body>