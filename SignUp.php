<?php
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
  $firstname = htmlspecialchars(trim($_POST['firstname']));
  $lastname = htmlspecialchars(trim($_POST['lastname']));
  $age = intval($_POST['age']);
  $gender = htmlspecialchars(trim($_POST['gender']));
  $email = htmlspecialchars(trim($_POST['email']));
  $username = htmlspecialchars(trim($_POST['username']));
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate passwords
  if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit;
  }

  // Check if email or username already exists
  $check = $conn->prepare("SELECT id FROM user_auth WHERE email = ? OR username = ?");
  $check->bind_param("ss", $email, $username);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    echo "<script>alert('Email or Username already exists!'); window.history.back();</script>";
    exit;
  }

  // Securely hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert user data
  $stmt = $conn->prepare("INSERT INTO user_auth (firstname, lastname, age, gender, email, username, password)
                          VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssissss", $firstname, $lastname, $age, $gender, $email, $username, $hashed_password);

  if ($stmt->execute()) {
    echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.html';</script>";
  } else {
    echo "<script>alert('Error: Could not complete registration.'); window.history.back();</script>";
  }

  $stmt->close();
  $check->close();
  $conn->close();
} else {
  // Show the registration form
?>
  <form action="SignUp.php" method="POST">
    <input type="text" name="firstname" required placeholder="First Name">
    <input type="text" name="lastname" required placeholder="Last Name">
    <input type="number" name="age" required placeholder="Age">
    <select name="gender" required>
      <option value="">Select Gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select>
    <input type="email" name="email" required placeholder="Email">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <input type="password" name="confirm_password" required placeholder="Confirm Password">
    <button type="submit">Sign Up</button>
  </form>
<?php
}
?>
