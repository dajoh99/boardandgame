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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['username'];


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_profile'])) {
    $updated_email = trim($_POST['email']);
    $updated_address = trim($_POST['street_address']);
    $updated_city = trim($_POST['city']);
    $updated_state = trim($_POST['state']);

    $update_sql = "UPDATE users SET email = ?, street_address = ?, city = ?, state = ? WHERE username = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssss", $updated_email, $updated_address, $updated_city, $updated_state, $user);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        $error = "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}


$sql = "SELECT email, street_address, city, state FROM users WHERE username = ?";
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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container" style="max-width: 600px; margin: 50px auto;">
        <h2>Edit Profile</h2>

        <?php if (isset($error))
            echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST" action="edit.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email"
                    value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="street_address" class="form-label">Street Address</label>
                <input type="text" class="form-control" name="street_address"
                    value="<?php echo htmlspecialchars($user_data['street_address']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city"
                    value="<?php echo htmlspecialchars($user_data['city']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" name="state"
                    value="<?php echo htmlspecialchars($user_data['state']); ?>" required>
            </div>

            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>

        </form>
    </div>
</body>

</html>