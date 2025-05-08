<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <section class="section">
        <h2 class="section-title">Local Games</h2>
        <div class="product-container">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "product_catalog";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            include 'db.php';


            $stmt = $conn->prepare("SELECT name, description, image_path FROM products");
            $stmt->execute();


            $stmt->bind_result($name, $description, $image_path);

            $hasResults = false;
            while ($stmt->fetch()):
                $hasResults = true;
                ?>

                <div class="product">
                    <div class="hover-controls">
                        <button class="add-btn" onclick="updateCart('add',
      '<?php echo htmlspecialchars($name); ?>',
      '<?php echo htmlspecialchars($image_path); ?>',
      `<?php echo htmlspecialchars($description); ?>`)">+</button>
                        <button class="remove-btn"
                            onclick="updateCart('remove', '<?php echo htmlspecialchars($name); ?>', '<?php echo htmlspecialchars($image_path); ?>')">−</button>
                    </div>
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($name); ?>">
                    <div class="product-info">
                        <h2><?php echo htmlspecialchars($name); ?></h2>
                        <p><?php echo htmlspecialchars($description); ?></p>
                    </div>
                </div>
                <?php
            endwhile;

            if (!$hasResults) {
                echo "<p>No products found.</p>";
            }

            $stmt->close();
            $conn->close();
            ?>

        </div>
    </section>
    <section class="section">
        <h2 class="section-title">Most Popular</h2>
        <div class="product-container">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "product_catalog";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            include 'db.php';


            $stmt = $conn->prepare("SELECT name, description, image_path FROM products2");
            $stmt->execute();


            $stmt->bind_result($name, $description, $image_path);

            $hasResults = false;
            while ($stmt->fetch()):
                $hasResults = true;
                ?>

                <div class="product">
                    <div class="hover-controls">
                        <button class="add-btn" onclick="updateCart('add',
      '<?php echo htmlspecialchars($name); ?>',
      '<?php echo htmlspecialchars($image_path); ?>',
      `<?php echo htmlspecialchars($description); ?>`)">+</button>
                        <button class="remove-btn"
                            onclick="updateCart('remove', '<?php echo htmlspecialchars($name); ?>', '<?php echo htmlspecialchars($image_path); ?>')">−</button>
                    </div>
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($name); ?>">
                    <div class="product-info">
                        <h2><?php echo htmlspecialchars($name); ?></h2>
                        <p><?php echo htmlspecialchars($description); ?></p>
                    </div>
                </div>
                <?php
            endwhile;

            if (!$hasResults) {
                echo "<p>No products found.</p>";
            }

            $stmt->close();
            $conn->close();
            ?>
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

</html>
<script>
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
                    renderCart({}); // Clear the cart UI
                } else {
                    alert(data.message);
                }
            });
    }
</script>