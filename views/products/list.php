<?php
ob_start();
require_once __DIR__ . "/../../config/database.php";

$pdo = Database::connect();

$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $stmt = $pdo->prepare("
        SELECT * FROM products
        WHERE name LIKE ? OR description LIKE ?
    ");
    $stmt->execute(["%$search%", "%$search%"]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $products = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h1 class="mb-4">Liste des produits</h1>

<div class="row">

<form class="d-flex mb-3" method="GET">
    <input class="form-control me-2"
           type="search"
           name="search"
           placeholder="Rechercher un produit"
           value="<?= htmlspecialchars($search) ?>">

    <button class="btn btn-outline-success" type="submit">
        Search
    </button>
</form>

<?php foreach ($products as $product): ?>

    <div class="col-md-4">

        <div class="card mb-4 shadow-sm">

            <div class="card-body">

                <h5 class="card-title">
                    <?= htmlspecialchars($product['name']) ?>
                </h5>

                <p class="card-text">
                    <?= htmlspecialchars($product['description']) ?>
                </p>

                <strong>
                    <?= $product['price'] ?> €
                </strong>

                <a href="/NexiShop/views/cart/add.php?id=<?= $product['id'] ?>"
                   class="btn btn-primary mt-2">
                    Ajouter au panier
                </a>

            </div>

        </div>

    </div>

<?php endforeach; ?>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>