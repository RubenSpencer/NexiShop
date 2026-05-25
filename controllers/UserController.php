<?php

require_once __DIR__ . "/../models/User.php";

class UserController {

    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // INSCRIPTION
    public function register($username, $email, $password) {

    $check = $this->validatePassword($password);

    if ($check !== true) {
        return $check; // retourne le message d'erreur
    }

    return $this->userModel->create($username, $email, $password);
    }

    private function validatePassword($password) {

    if (strlen($password) < 12 || strlen($password) > 30) {
        return "Le mot de passe doit contenir entre 12 et 30 caractères.";
    }

    if (!preg_match('/[a-z]/', $password)) {
        return "Au moins une minuscule est requise.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return "Au moins une majuscule est requise.";
    }

    if (!preg_match('/[0-9]/', $password)) {
        return "Au moins un chiffre est requis.";
    }

    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return "Au moins un caractère spécial est requis.";
    }

    return true;
}

    // LOGIN
    public function login($email, $password) {

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];

            return true;
        }

        return false;
    }

    // LOGOUT
    public function logout() {
        unset($_SESSION['user']);
    }
}