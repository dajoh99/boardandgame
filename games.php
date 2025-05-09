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

// Fetch categories for the dropdown
$categories = [];
$categoryResult = $conn->query("SELECT DISTINCT category FROM all_games");
while ($row = $categoryResult->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Fetch games based on selected category
$selectedCategory = $_GET['category'] ?? 'All';
if ($selectedCategory === 'All') {
    $result = $conn->query("SELECT name, description, image_path, additional_description, category FROM all_games");
} else {
    $stmt = $conn->prepare("SELECT name, description, image_path, additional_description, category FROM all_games WHERE category = ?");
    $stmt->bind_param("s", $selectedCategory);
    $stmt->execute();
    $result = $stmt->get_result();
}

$games = [];
while ($row = $result->fetch_assoc()) {
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
        <form method="GET" class="mb-4 text-center">
            <label for="category" class="form-label">Sort by Category:</label>
            <select name="category" id="category" class="form-select w-auto d-inline-block">
                <option value="All" <?php echo $selectedCategory === 'All' ? 'selected' : ''; ?>>All</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category); ?>" <?php echo $selectedCategory === $category ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <div class="text-center mb-4">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="add_game.php" class="btn btn-success">Add a New Game</a>
            <?php endif; ?>
        </div>

        <div class="games-grid">
            <?php foreach ($games as $game): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($game['image_path']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($game['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($game['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($game['description']); ?></p>
                        <button class="btn btn-primary"
                            onclick="showDetails('<?php echo htmlspecialchars($game['name']); ?>', '<?php echo htmlspecialchars($game['description']); ?>', '<?php echo htmlspecialchars($game['additional_description']); ?>', '<?php echo htmlspecialchars($game['image_path']); ?>')">
                            View Details
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="cart" class="cart-sidebar">
        <h4>Your Cart</h4>
        <ul id="cart-items"></ul>
        <hr>
        <button onclick="checkout()" class="btn btn-sm btn-outline-success w-100 mb-2">
            Checkout
        </button>
        <button onclick="clearCart()" class="btn btn-sm btn-outline-danger w-100">
            Clear Cart
        </button>
    </div>

    <div class="modal fade" id="gameDetailsModal" tabindex="-1" aria-labelledby="gameDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gameDetailsModalLabel">Game Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalGameImage" src="" alt="Game Image" class="img-fluid mb-3"
                        style="max-height: 200px; object-fit: cover;">
                    <h5 id="modalGameName"></h5>
                    <p id="modalGameDescription"></p>
                    <p id="modalAdditionalDescription" class="text-muted"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addToCartButton">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetails(name, description, additionalDescription, imagePath) {
            document.getElementById('modalGameName').innerText = name;
            document.getElementById('modalGameDescription').innerText = description;
            document.getElementById('modalAdditionalDescription').innerText = additionalDescription;
            document.getElementById('modalGameImage').src = imagePath;

            // Set the "Add to Cart" button behavior
            const addToCartButton = document.getElementById('addToCartButton');
            addToCartButton.onclick = () => {
                updateCart('add', name, imagePath, description);
            };

            const modal = new bootstrap.Modal(document.getElementById('gameDetailsModal'));
            modal.show();
        }

        function updateCart(action, name, image, description) {
            const formData = new FormData();
            formData.append('action', action);
            formData.append('name', name);
            formData.append('image', image);
            formData.append('description', description);

            fetch('cart.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    renderCart(data);
                });
        }

        function renderCart(cart) {
            const cartList = document.getElementById('cart-items');
            cartList.innerHTML = '';
            for (const name in cart) {
                const item = cart[name];
                const li = document.createElement('li');
                li.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="${item.image}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; flex-shrink: 0;">
                        <div>
                            <strong>${name}</strong><br>
                            <small>${item.description}</small>
                        </div>
                    </div>
                `;
                cartList.appendChild(li);
            }
        }

        function clearCart() {
            const formData = new FormData();
            formData.append('action', 'clear');

            fetch('cart.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    renderCart(data);
                });
        }

        function checkout() {
            fetch('checkout.php', {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        renderCart({});
                    } else {
                        alert(data.message);
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetch('cart.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'fetch' })
            })
                .then(response => response.json())
                .then(data => {
                    renderCart(data);
                });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>