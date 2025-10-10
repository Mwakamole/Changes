<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // change if needed
$password = ""; // change if you have a DB password
$dbname = "user_auth"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if passwords match
  if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit;
  }

  // Securely hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Prepare and bind
  $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, age, gender, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssissss", $firstname, $lastname, $age, $gender, $email, $username, $hashed_password);

  if ($stmt->execute()) {
    echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.html';</script>";
  } else {
    echo "<script>alert('Error: Could not complete registration.'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
