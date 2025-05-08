<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "product_catalog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch games from both tables
$games = [];
$result1 = $conn->query("SELECT name, description, image_path FROM products");
$result2 = $conn->query("SELECT name, description, image_path FROM products2");

while ($row = $result1->fetch_assoc()) {
    $games[] = $row;
}
while ($row = $result2->fetch_assoc()) {
    $games[] = $row;
}

$conn->close();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Games</title>
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

    <div class="container mt-5">
        <h2 class="text-center mb-4">All Games</h2>
        <div class="row">
            <?php foreach ($games as $game): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($game['image_path']); ?>" class="card-img-top"
                            alt="<?php echo htmlspecialchars($game['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($game['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($game['description']); ?></p>
                            <button class="btn btn-primary" onclick="showDetails('<?php echo htmlspecialchars($game['name']); ?>', '<?php echo htmlspecialchars($game['description']); ?>', 'This is an additional description for <?php echo htmlspecialchars($game['name']); ?>.')">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal for Game Details -->
    <div class="modal fade" id="gameDetailsModal" tabindex="-1" aria-labelledby="gameDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gameDetailsModalLabel">Game Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="modalGameName"></h5>
                    <p id="modalGameDescription"></p>
                    <p id="modalAdditionalDescription" class="text-muted"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetails(name, description, additionalDescription) {
            document.getElementById('modalGameName').innerText = name;
            document.getElementById('modalGameDescription').innerText = description;
            document.getElementById('modalAdditionalDescription').innerText = additionalDescription;
            const modal = new bootstrap.Modal(document.getElementById('gameDetailsModal'));
            modal.show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>