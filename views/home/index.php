<?php
ob_start();
?>

<h1>Accueil NexiShop</h1>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>