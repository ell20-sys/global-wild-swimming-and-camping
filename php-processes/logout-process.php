<?php
session_start();
unset($_SESSION['loggedin']);
session_destroy();
?>
<script>
  window.location.href = '../index.php';
</script>