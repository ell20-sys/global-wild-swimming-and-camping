<?php
session_start();
include_once '../php-processes/config.php';

// Check if the form was submitted
if (isset($_POST['change_password'])) {
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];
  $username_or_email = $_POST['username_or_email'];

  // Check if the passwords match
  if ($new_password === $confirm_password) {
    $sql = "UPDATE users SET password = '$new_password' WHERE username = '$username_or_email' OR email = '$username_or_email'";
    if ($con->query($sql) === true) {
      $success_message = "Password updated successfully";
    } else {
      $error = "Error updating password: " . $con->error;
    }
  } else {
    $error = "Passwords do not match";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>GWSC</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <section class="general-section">
    <form class="general-card normal-form" action="" method="post">
      <h2>Change Password</h2>
      <?php if (isset($success_message)) { ?>
        <p class="success-message">
          <?php echo $success_message; ?>
        </p>
        <a href="login.php">Proceed to Login</a>
      <?php } else { ?>
        <?php if (isset($error)) { ?>
          <p class="error-message">
            <?php echo $error; ?>
          </p>
        <?php } ?>
        <div class="input_field">
          <input type="password" placeholder="New Password" name="new_password">
        </div>
        <div class="input_field">
          <input type="password" placeholder="Confirm Password" name="confirm_password">
        </div>
        <div class="buttons">
          <input type="submit" value="Change Password" class="log_button" name="change_password">
        </div>
      <?php } ?>
    </form>
  </section>
  <footer>
    <p>&copy;2023 GWSC, Inc. All rights reserved.</p>
  </footer>
  <script src="../js/script.js"></script>
</body>

</html>