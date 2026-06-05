<?php
require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../config/database.php";

$pdo = Database::connect();

// Vérification de l'authentification et du rôle d'administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /NexiShop/index.php");
    exit;
}

// fonction de suppression du produit

if (isset($_GET['id'])) {

    $sql = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $result = $sql->execute([$_GET['id']]);

    if ($result === true) {
        header("Location: gestion-product.php?delete=success");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la suppression</div>";
    }
}



?>



