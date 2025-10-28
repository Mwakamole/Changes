<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome - Changes</title>
</head>
<body style="text-align:center; font-family:'Segoe UI',sans-serif;">
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h1>
  <p>You’re now logged in to Changes.</p>
  <a href="logout.php">Log Out</a>
</body>
</html>
