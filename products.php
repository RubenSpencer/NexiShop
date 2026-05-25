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