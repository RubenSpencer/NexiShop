<?php
require_once "includes/session.php";
require_once "views/layouts/header.php";
require_once "views/layouts/navbar.php";
require_once "config/database.php";



$pdo = Database::connect();

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

foreach ($_SESSION['cart'] as $productId => $qty) {
    $sql = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $sql->execute([$productId]);
    $product = $sql->fetch();

    // calcul du nouveau stock après la commande
    $newstock = $product['stock'] - $qty;

    // mise à jour du stock dans la base de données
    $update_sql = $pdo->prepare("UPDATE products SET stock = ? WHERE id = ?");
    $update_sql->execute([$newstock, $productId]);

    echo "Produit : " . $product['name'] . "<br>";

    
}

    // Vider le panier après la commande
    $_SESSION['cart'] = [];

    header("Location: cart.php");
    exit;


?>



<h1>Merci pour votre commande !</h1>


<button class="btn btn-primary"><a href="index.php" class="text-white text-decoration-none">Retour à l'accueil</a></button>