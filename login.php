<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
  <div class="top-bar"></div>

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

  <img src="images/monopoly-man-logo.png" alt="Monopoly Man Image">
  <div class="login-form">
    <h2>SIGN IN</h2>
    <p>Enter your details below</p>
    <form action="login.php" method="POST">
      <label>Username</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </div>

</body>

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
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $sql = "SELECT id, username, password FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      $_SESSION['username'] = $username;
      header("Location: index.php");
      exit();
    } else {
      echo "Invalid credentials.";
    }
  } else {
    echo "No account found with that email.";
  }
  $stmt->close();
}
$conn->close();
?>