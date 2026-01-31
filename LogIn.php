<?php
session_start();

// Redirect if accessed directly (not POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: LogInPage.html');
    exit;
}

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "changes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize input
  $email = htmlspecialchars(trim($_POST['email']));
  $password = $_POST['password'];

  // Fetch user by email
  $stmt = $conn->prepare("SELECT id, username, email, password FROM user_auth WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify hashed password
    if (password_verify($password, $user['password'])) {
      // Store user info in session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];

      // Redirect to dashboard or welcome page
      echo "<script>alert('Login successful!'); window.location.href='welcome.php';</script>";
      exit();
    } else {
      echo "<script>alert('Incorrect password. Please try again.'); window.history.back();</script>";
    }
  } else {
    echo "<script>alert('No user found with that email.'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
