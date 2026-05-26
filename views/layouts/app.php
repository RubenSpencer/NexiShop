<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/navbar.php'; ?>

<main class="container mt-4">
    <?= $content ?? '' ?>
</main>

<?php include 'footer.php'; ?>

<!-- // ce dossier permet de ressembler les éléments contenu dans footer.php header.php et navbar.php  -->