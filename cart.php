<?php
require_once "includes/session.php";
require_once __DIR__ . '/views/layouts/header.php';
require_once __DIR__ . '/views/layouts/navbar.php';
require_once __DIR__ . '/config/database.php';

$pdo = Database::connect();

$cart = $_SESSION['cart'];
$total = 0;
?>
<div class="container py-5">

    <h1 class="mb-4">Mon panier</h1>

    <?php if (empty($cart)): ?>
        <p>Votre panier est vide</p>
    <?php else: ?>

        <ul class="list-group mb-4">

            <?php foreach ($cart as $productId => $qty): ?>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                $stmt->execute([$productId]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>

                <li class="list-group-item d-flex justify-content-between align-items-center">

                    <div>
                        <strong><?= $product['name'] ?></strong><br>
                        Quantité : <?= $qty ?><br>
                        Prix unitaire : <?= $product['price'] ?> €
                    </div>

                    <div>
                        Sous-total : <?= $product['price'] * $qty ?> €
                    </div>

                </li>

                <?php $total += $product['price'] * $qty; ?>
            <?php endforeach; ?>

        </ul>

        <h3 class="mb-3">Total : <?= $total ?> €</h3>

        <a href="thanks.php" class="btn btn-success">
            Payer
        </a>

    <?php endif; ?>

</div>