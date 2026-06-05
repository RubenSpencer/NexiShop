<?php
ob_start();
?>

<div class="container py-5">

    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container-fluid py-4">
            <h1 class="display-5 fw-bold">Bienvenue sur NexiShop</h1>

            <p class="col-md-8 fs-5">
                NexiShop est une boutique en ligne dédiée aux produits informatiques.
                Vous pouvez consulter nos produits, gérer votre panier et passer commande facilement.
            </p>

            <a href="/NexiShop/products.php" class="btn btn-primary btn-lg mt-3">
                Voir les produits
            </a>
        </div>
    </div>

    <div class="row text-center">

        <div class="col-md-4 mb-3">
            <div class="p-4 border rounded shadow-sm bg-white h-100">
                <h4>Produits informatiques</h4>
                <p>Une sélection de PC, composants et accessoires.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="p-4 border rounded shadow-sm bg-white h-100">
                <h4>Interface d’administration</h4>
                <p>Gestion des produits, du stock et des contenus.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="p-4 border rounded shadow-sm bg-white h-100">
                <h4>Gestion du panier</h4>
                <p>Ajout et validation des commandes en quelques étapes.</p>
            </div>
        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>