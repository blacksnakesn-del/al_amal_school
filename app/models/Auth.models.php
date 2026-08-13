<?php

class Auth
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function connecter(string $email, string $password)
    {
        $sql = "
            SELECT *
            FROM utilisateur
            WHERE email = :email
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }
}