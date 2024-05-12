<?php
    // Chemin du fichier JSON
    session_start();
    // Lire le contenu actuel du fichier JSON
    $currentData = file_get_contents('scrutin.json');
    if ($currentData === false) {
        die('Impossible de lire le fichier JSON.');
    }
    $currentDataArray = json_decode($currentData, true);
    if ($currentDataArray === null) {
        die('Impossible de décoder le JSON.');
    }

    // incrémenter l'id
    $maxId = 0;
    foreach ($currentDataArray as $k => $data) {
        if ($data['id'] > $maxId) {
            $maxId = $data['id'];
        }
    }

    $_SESSION["newId"] = $maxId + 1;
    $_SESSION["nomQuest"] =$_POST["nom"];
    $_SESSION["question"]  = $_POST["question"];
    $_SESSION["choix"] =  $_POST["tableauProp"];
    $_SESSION["dateFin"] = $_POST["dateFin"];
    $_SESSION["methodeVote"] = $_POST["methodeVote"];
?>