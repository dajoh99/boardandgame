<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
$servername = "localhost";
$db_username = "root";
$db_password = "root"; // your MySQL password
$dbname = "user_registration";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['username'];

$sql = "SELECT username, email, street_address, city, state FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

$user_data = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
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
        <div class="auth-links">
            <?php if (isset($_SESSION['username'])): ?>
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <?php else: ?>
                <a href="signup.php">SIGN UP</a> /
                <a href="login.php">LOGIN</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="container" style="max-width: 600px; margin: 50px auto;">
        <h2><?php echo htmlspecialchars($user_data['username']); ?></h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?>
            </li>
            <li class="list-group-item"><strong>Street Address:</strong>
                <?php echo htmlspecialchars($user_data['street_address']); ?></li>
            <li class="list-group-item"><strong>City:</strong> <?php echo htmlspecialchars($user_data['city']); ?></li>
            <li class="list-group-item"><strong>State:</strong> <?php echo htmlspecialchars($user_data['state']); ?>
            </li>
        </ul>
    </div>
    <div style="text-align:center; margin-top: 30px;">
        <a href="edit.php" class="btn btn-warning">Edit Profile</a>
    </div>
    <div style="text-align:center; margin-top: 20px;">
        <form action="delete.php" method="POST" onsubmit="return confirmDelete();">
            <button type="submit" class="btn btn-outline-danger">Delete Account</button>
        </form>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete your account? This action cannot be undone.");
        }
    </script>
    <div style="text-align:center; margin-top: 40px;">
        <form action="logout.php" method="POST">
            <button type="submit" class="btn btn-danger">Log Out</button>
        </form>
    </div>

</body>

</html>