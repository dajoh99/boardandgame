<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $name = $_POST['name'] ?? '';
        $image = $_POST['image'] ?? '';
        $description = $_POST['description'] ?? '';

        if (!isset($_SESSION['cart'][$name])) {
            $_SESSION['cart'][$name] = [
                'image' => $image,
                'description' => $description
            ];
        }
    } elseif ($action === 'remove') {
        $name = $_POST['name'] ?? '';
        if (isset($_SESSION['cart'][$name])) {
            unset($_SESSION['cart'][$name]);
        }
    } elseif ($action === 'clear') {
        $_SESSION['cart'] = [];
    } elseif ($action === 'fetch') {
        // Return the current cart data
        echo json_encode($_SESSION['cart']);
        exit;
    }

    echo json_encode($_SESSION['cart']);
}