<?php

require_once "../../includes/session.php";
require_once "../../config/database.php";
require_once "../../controllers/UserController.php";

$pdo = Database::connect();

$userController = new UserController($pdo);

$message = null;
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $userController->register(
        $_POST['username'],
        $_POST['email'],
        $_POST['password']
    );

    if ($result === true) {
        $message = "Compte créé avec succès !";
        $success = true;
    } else {
        $message = $result; // message d'erreur retourné par validatePassword ou emailExists
    }
}

?>

<h1>Inscription</h1>

<?php if ($message): ?>
    <div style="color: <?= $success ? 'green' : 'red' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="POST">

    <input type="text" name="username" placeholder="Username" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Mot de passe" required>

    <button type="submit">S'inscrire</button>

</form>