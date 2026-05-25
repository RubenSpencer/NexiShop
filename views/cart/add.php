<?php

require_once __DIR__ . "/../../includes/session.php";

$productId = $_GET['id'] ?? null;

if ($productId) {

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
}

header("Location: /NexiShop/cart.php");
exit;