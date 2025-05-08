<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SignUp</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
  <div class="top-bar"></div>
</body>

<body>
  <div class="nav-bar">
    <div class="logo"><a href="index.php">BOARD AND BORROW</a></div>
    <div class="nav-buttons">
      <button><a href="games.php">GAMES</a></button>
      <button><a href="reviews.php">REVIEWS</a></button>
      <button>ABOUT
      </button>
      <button>PROFILE</button>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
</body>
<img src="images/monopoly-man-logo.png" alt="Monopoly Man Image">
<div class="container">
  <div class="signup-form">
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST">
      <label>Username:</label>
      <input type="text" name="username" required><br>
      <label>Email:</label>
      <input type="email" name="email" required><br>
      <label>Password:</label>
      <input type="password" name="password" required><br>
      <label>Street Address:</label>
      <input type="text" name="street_address" required><br>
      <label>City:</label>
      <input type="text" name="city" required><br>
      <label>State:</label>
      <input type="text" name="state" required><br>
      <button type="submit">Sign Up</button>

    </form>
  </div>
</div>

</html>
<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Default MAMP MySQL password
$dbname = "user_registration";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
  $street_address = trim($_POST['street_address']);
  $city = trim($_POST['city']);
  $state = trim($_POST['state']);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
  }
  $sql = "INSERT INTO users (username, email, password, street_address, city, state) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssss", $username, $email, $password, $street_address, $city, $state);

  if ($stmt->execute()) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
?>