<?php
require_once "../../includes/session.php";
require_once "../../config/database.php";
require_once "../../controllers/UserController.php";

$pdo = Database::connect();

$auth = new UserController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $success = $auth->login(
        $_POST['email'],
        $_POST['password']
    );

    if ($success) {

        echo "Connexion réussie !";

    } else {

        echo "Email ou mot de passe incorrect";

    }
}
?>

<button><a href="/NexiShop/index.php">retour à la page d'accueil</a></button>

<h1>Connexion</h1>
<form method="POST">

    <input type="email" name="email">

    <input type="password" name="password">

    <button type="submit">
        Connexion
    </button>

</form>