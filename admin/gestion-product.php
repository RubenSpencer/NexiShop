<?php

require_once __DIR__ . "/../views/layouts/header.php";
require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../config/database.php";

$pdo = Database::connect();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /NexiShop/index.php");
    exit;
}

?>

<?php

// récupération des produits
try{
    $sql = $pdo->query("SELECT * FROM products");
    $products = $sql->fetchAll(PDO::FETCH_ASSOC); // fetchAll pour récupérer tous les produits dans un tableau associatif
} catch (PDOException $e) {                      // PDO::FETCH_aSSOC  veut dire je ne veux que les informations des titres avec des différents colonnes 
    echo "Erreur de connexion : " . $e->getMessage();
}

// var_dump($products); // Affiche les produits récupérés de la base de données pour vérification

?> 

<button class="btn btn-primary m-2"><a href="../index.php" class="text-white text-decoration-none">retour à la page d'accueil</a></button>
<h1 class="mb-5 mt-5">Liste des produits disponibles</h1>

<button class="btn btn-success m-2"><a href="add-product.php" class="text-white text-decoration-none">Ajouter un produit</a></button>

<main class="container">
    <div class="row">
        <section class="col-12">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Nombre</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['price'] ?> €</td>
                            <td><?= $product['stock'] ?></td>
                            <td>
                                <a href="edit-product.php?id=<?= $product['id'] ?>" class="btn btn-primary">Modifier</a>
                                <a href="delete-product.php?id=<?= $product['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>




