<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$db_username = "root";
$db_password = "root";
$dbname = "product_catalog";


$games = [];
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
$result = $conn->query("SELECT name FROM all_games");

while ($row = $result->fetch_assoc()) {
    $games[] = $row['name'];
}
$conn->close();

// Fetch user details
$conn = new mysqli($servername, $db_username, $db_password, "user_registration");
$user = $_SESSION['username'];
$user_sql = "SELECT city, state FROM users WHERE username = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($city, $state);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game = $_POST['game'];
    $comment = $_POST['comment'];

    $review_conn = new mysqli($servername, $db_username, $db_password, "user_registration");
    $insert = $review_conn->prepare("INSERT INTO reviews (username, city, state, game_name, comment) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("sssss", $user, $city, $state, $game, $comment);
    $insert->execute();
    $insert->close();
    $review_conn->close();

    header("Location: reviewsall.php");
    exit();
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reviews</title>
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
            <button>ABOUT</button>
            <button><a href="profile.php">PROFILE</a></button>
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
    <div class="container" style="max-width: 600px; margin: 40px auto;">
        <h2>Review a Game</h2>
        <form method="POST" action="reviews.php">
            <div class="mb-3">
                <label for="game">Select a Game:</label>
                <select name="game" class="form-select" required>
                    <option value="" disabled selected>Select a game</option>
                    <?php foreach ($games as $g): ?>
                        <option value="<?php echo htmlspecialchars($g); ?>"><?php echo htmlspecialchars($g); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="comment">Your Review:</label>
                <textarea name="comment" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
        <a href="reviewsall.php" class="btn btn-success mt-3">View All Reviews</a>
    </div>
</body>

</html>