
<?php

require_once dirname(__DIR__) . '/core/database.php';

function getAllElevesByClasse(int $classeId) : array {
    $connexion = connexionDB();
    $sql = "SELECT e.id, e.matricule, e.nom, e.prenom
        FROM eleves e
        INNER JOIN inscriptions i ON
        i.inscription_id = e.id
        WHERE i.classe_id = :classe_id
        ";
    $result = executeQuery($connexion, $sql, [
        ['classe_id' => $classeId],
        false
    ]);
    $connexion = null;
    return $result;
}

?>