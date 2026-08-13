<?php

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "gestion_notes";
        $user = "postgres";
        $password = "password";

        try {
            $this->pdo = new PDO(
                "pgsql:host=$host;dbname=$dbname",
                $user,
                $password
            );

            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getConnexion(): PDO
    {
        return $this->pdo;
    }
}