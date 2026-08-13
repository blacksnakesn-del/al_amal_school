
<?php

require_once dirname(__DIR__) . '/models/note.models.php';
require_once dirname(__DIR__) . '/models/anneeCourant.models.php';

function accueil() {


    $classes = getAllListe('classes');
    $periodes = getAllListe('periodes');
    $matieres = getAllListe('matieres');

    $anneeCourant = getAnneeCourant();

    $eleves = [];
    $selectClasse = 1;
    $message = null;
    if($selectClasse !== '') {
        $eleves = getAllElevesByClasse((int)$selectClasse);

        if(empty($eleves)) {
            $message = "Ce classe ne contient aucun apprenant!";
        }
    }

    $selectedClasse = $_POST['classe'] ?? '';
    $selectedMatiere = $_POST['matiere'] ?? '';
    $selectedPeriode = $_POST['periode'] ?? '';
    $moyeneClasse = null;

    if ($selectedClasse !== '' && $selectedMatiere !== '' && $selectedPeriode !== '') {
        $moyeneClasse = getMoyenneClasse((int)$selectedClasse, (int)$selectedMatiere, (int)$selectedPeriode);
    }

    

    require_once dirname(__DIR__) . '/views/accueil.html.php';
}


?>
