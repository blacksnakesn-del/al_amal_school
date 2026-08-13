<?php

class Note
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getNotesParEleve(int $eleveId): array
    {
        $sql = "
            SELECT *
            FROM note
            WHERE eleve_id = :eleve_id
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':eleve_id' => $eleveId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}