<?php

require_once "config/database.php";
require_once "controllers/ProductController.php";

// connexion DB
$pdo = Database::connect();

// controller
$controller = new ProductController($pdo);
$products = $controller->index();

// envoyer à la vue
require "views/products/list.php";


// ce fichier sert à afficher les produits dans product.php, il est appelé dans index.php et dans products.php
// il est aussi appelé dans cart.php pour afficher les produits du panier et dans thanks.php pour afficher les produits commandés