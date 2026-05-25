<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// initialiser le panier
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}