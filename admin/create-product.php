<?php
require_once __DIR__ . "/../includes/session.php";

// permet de vérifier que l'utilisateur est connecté et qu'il a le rôle d'admin avant d'accéder à la page, si c'est pas le cas, il est redirigé vers la page d'accueil
// cela permet de proteger l'admin
require_once "../includes/session.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /NexiShop/index.php");
    exit;
}

?>

<h1>Dashboard Admin</h1>
