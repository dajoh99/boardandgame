<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "product_catalog";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $game_name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $added_by = $_SESSION['username'];
    $additional_description = "This is an additional description for the game."; // Default value

    
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'images/';
        $image_path = $upload_dir . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            die("Error: Failed to upload the image.");
        }
    } else {
        die("Error: Image upload failed. Error code: " . $_FILES['image']['error']);
    }

    
    $stmt = $conn->prepare("INSERT INTO all_games (name, description, image_path, additional_description, category, added_by) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error: " . $conn->error);
    }
    $stmt->bind_param("ssssss", $game_name, $description, $image_path, $additional_description, $category, $added_by);
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();

    
    header("Location: games.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Game</title>
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
        <h2 class="text-center mb-4">Add a New Game</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Game Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Location</label>
                <textarea class="form-control" id="description" name="description" rows="1" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="Family">Family</option>
                    <option value="Strategy">Strategy</option>
                    <option value="Role Playing">Role Playing</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Tabletop">Tabletop</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Game Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Game</button>
        </form>
    </div>
</body>

</html>