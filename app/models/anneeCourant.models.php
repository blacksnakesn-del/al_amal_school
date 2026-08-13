

<?php

require_once dirname(__DIR__) . '/core/database.php';

function getAnneeCourant() {
    $connexion = connexionDB();
    $sql = "SELECT * FROM anneeScolaires
        WHERE actif = 1 LIMIT 1";
    $query = query($connexion, $sql, true);
    $connexion = null;
    return $query;
}

?>