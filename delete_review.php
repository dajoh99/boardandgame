<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review_id = $_POST['review_id'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";
    $dbname = "user_registration";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the review belongs to the logged-in user
    $stmt = $conn->prepare("SELECT username FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $stmt->bind_result($review_username);
    $stmt->fetch();
    $stmt->close();

    if ($review_username === $_SESSION['username']) {
        // Delete the review
        $delete_stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
        $delete_stmt->bind_param("i", $review_id);
        $delete_stmt->execute();
        $delete_stmt->close();

        echo "<script>alert('Review deleted successfully.'); window.location.href = 'reviewsall.php';</script>";
    } else {
        echo "<script>alert('You are not authorized to delete this review.'); window.location.href = 'reviewsall.php';</script>";
    }

    $conn->close();
}
?>