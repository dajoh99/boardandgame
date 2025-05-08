<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $name = $_POST['name'] ?? '';
    $image = $_POST['image'] ?? '';
    $description = $_POST['description'] ?? '';

    if ($action === 'add') {
        if (!isset($_SESSION['cart'][$name])) {
            $_SESSION['cart'][$name] = [
                'image' => $image,
                'description' => $description
            ];
        }
        // no qty tracking
    } elseif ($action === 'remove') {
        if (isset($_SESSION['cart'][$name])) {
            unset($_SESSION['cart'][$name]);
        }
    } elseif ($action === 'clear') {
        $_SESSION['cart'] = [];
    }
}

echo json_encode($_SESSION['cart']);