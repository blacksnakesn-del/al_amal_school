
<?php

require_once dirname(__DIR__) . '/core/database.php';

function getMoyenneClasse(int $classeId, int $matiereId, int $periodeId) {
    $connexion = connexionDB();
    $sql = "SELECT ROUND(AVG((COALESCE(devoir1,0) + COALESCE(devoir2,0) + 2 * COALESCE(composition,0)) / 4), 2) AS moyenne_classe
            FROM evaluations ev
            INNER JOIN inscriptions i ON i.id = ev.inscription_id
            WHERE i.classe_id = :classe_id
              AND ev.matiere_id = :matiere_id
              AND ev.periode_id = :periode_id";
    $result = executeQuery(
        $connexion,
        $sql,
        ['classe_id' => $classeId, 'matiere_id' => $matiereId, 'periode_id' => $periodeId],
        true
    );

    return $result['moyenne_classe'] ?? null;
}

?>