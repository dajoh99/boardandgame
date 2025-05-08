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

// Delete the user account
$sql = "DELETE FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);

if ($stmt->execute()) {
    // Log out the user
    session_destroy();
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting account: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>