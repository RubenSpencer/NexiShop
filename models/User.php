<?php

class User {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // créer utilisateur
    public function create($username, $email, $password) {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, email, password)
                VALUES (?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $username,
            $email,
            $hashedPassword
        ]);
    }

    // récupérer user par email
    public function findByEmail($email) { //sert à connecter une utilisateur en cherchant son email dans la base de données

        $sql = "SELECT * FROM users WHERE email = ?"; //cherche un utilisateur par email 

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // le résultat 
    }
}