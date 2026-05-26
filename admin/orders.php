<?php
require_once __DIR__ . "/../includes/session.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /NexiShop/index.php");
    exit;
}

?>


<h1>Gestion Commandes</h1>
