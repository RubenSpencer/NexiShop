<?php
require_once "views/layouts/header.php";
require_once "views/layouts/navbar.php";
require_once "includes/session.php";
require_once "config/database.php";

$pdo = Database::connect();

$cart = $_SESSION['cart'];
$total = 0;
?>

<h1>Mon panier</h1>

<?php if (empty($cart)): ?>
    <p>Votre panier est vide</p>
<?php else: ?>

    <ul class="list-group">

    <?php foreach ($cart as $productId => $qty): ?>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <li class="list-group-item">
            <strong><?= $product['name'] ?></strong><br>
            Quantité : <?= $qty ?><br>
            Prix unitaire : <?= $product['price'] ?> €<br>
            Sous-total : <?= $product['price'] * $qty ?> €
        </li>

        <?php $total += $product['price'] * $qty; ?>

    <?php endforeach; ?>

    </ul>

    <h3 class="mt-3">Total : <?= $total ?> €</h3>

<?php endif; ?>