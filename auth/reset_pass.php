<?php
session_start();
include_once "../php-processes/config.php";
if (isset($_POST['reset'])) {
  $usernameOrEmail = $_POST['username_or_email'];

  $query = "SELECT * FROM users WHERE username = '$usernameOrEmail' OR email = '$usernameOrEmail'";

  $result = mysqli_query($con, $query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    $temporaryPassword = generateTemporaryPassword();
    $userId = $user['user_ID'];
    $updateQuery = "UPDATE users SET password = '$temporaryPassword' WHERE user_ID = '$userId'";
    mysqli_query($con, $updateQuery);
    echo "<script>alert('Account found!');</script>";
  } else {
    echo "<script>alert('Username or email does not exist');</script>";
  }
}
function generateTemporaryPassword($length = 10)
{
  // Generate a random string of characters
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $temporaryPassword = '';
  for ($i = 0; $i < $length; $i++) {
    $index = mt_rand(0, strlen($characters) - 1);
    $temporaryPassword .= $characters[$index];
  }
  return $temporaryPassword;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Reset Password | GWSC</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <section class="general-section">
    <form class="general-card normal-form" method="post">
      <h2>Reset Password</h2>
      <div class="input_field">
        <input type="text" placeholder="Username/Email" name="username_or_email">
      </div>
      <div class="input_field re">
        <div class="g-recaptcha" data-sitekey="6LeD3pslAAAAADjLBinm29_ziPOTRVgbsnJ6iAdu"></div>
      </div>
      <div class="input_field temp">
        <?php
        if (isset($temporaryPassword)) {
          echo "<p>Temporary Password: <span id='temporary_password'>$temporaryPassword</span></p>";
          echo '<button onclick="copyTemporaryPassword()">Copy Password</button>';
        }
        ?>
      </div>
      <div class="buttons">
        <input type="submit" value="Find account" class="log_button" name="reset">
      </div>
    </form>
  </section>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="../js/script.js"></script>
</body>

</html>