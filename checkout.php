<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo json_encode(['status' => 'error', 'message' => 'Cart is empty.']);
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "product_catalog";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $orderData = json_encode($_SESSION['cart']);
    $stmt = $conn->prepare("INSERT INTO orders (order_data) VALUES (?)");
    $stmt->bind_param("s", $orderData);

    if ($stmt->execute()) {
        $_SESSION['cart'] = [];
        echo json_encode(['status' => 'success', 'message' => 'Checkout successful!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to process checkout.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);