<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$db_username = "root";
$db_password = "root";
$dbname = "user_registration";
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review_id = $_POST['review_id'];

    $stmt = $conn->prepare("SELECT username FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $stmt->bind_result($review_username);
    $stmt->fetch();
    $stmt->close();

    if ($review_username === $_SESSION['username']) {
        $delete_stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
        $delete_stmt->bind_param("i", $review_id);
        $delete_stmt->execute();
        $delete_stmt->close();
    }

    header("Location: reviewsall.php");
    exit();
}

$result = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
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
            <button>ABOUT
            </button>
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
    <div class="container mt-5">
        <h2 class="text-center mb-4">User Reviews</h2>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="review-wrapper">
                <div class="review-user">
                    <?php echo htmlspecialchars($row['username']); ?><br>
                    <span class="review-location">
                        <?php echo htmlspecialchars($row['city'] . ", " . $row['state']); ?>
                    </span>
                </div>
                <div class="review-content">
                    <div class="review-game">
                        <?php echo htmlspecialchars($row['game_name']); ?>
                    </div>
                    <div class="review-comment">
                        <?php echo nl2br(htmlspecialchars($row['comment'])); ?>
                    </div>
                </div>
                <?php if ($_SESSION['username'] === $row['username']): ?>
                    <form method="POST" action="reviewsall.php" style="margin-top: 10px;">
                        <input type="hidden" name="review_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>