<?php 
ob_start(); 
$products = $products ?? [];
?>

<h1 class="mb-4">Liste des produits</h1>

<div class="row">
<!-- bare de recherche -->
<div class="container-fluid bg-light p-3 mb-4">
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>

<?php foreach ($products as $product): ?>

    <div class="col-md-4">

        <div class="card mb-4 shadow-sm">

            <div class="card-body">

                <h5 class="card-title">
                    <?= $product['name'] ?>
                </h5>

                <p class="card-text">
                    <?= $product['description'] ?>
                </p>
                <a href="/NexiShop/views/cart/add.php?id=<?= $product['id'] ?>" class="btn btn-primary">
                    Ajouter au panier
                </a>

                <strong>
                    <?= $product['price'] ?> €
                </strong>

            </div>

        </div>

    </div>

<?php endforeach; ?>

</div>

<?php
$content = ob_get_clean();
include "views/layouts/app.php";
?>