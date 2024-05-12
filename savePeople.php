<?php 
    session_start();

    $_SESSION["nbrVotant"] = intval($_POST["nbrVotant"]);
    $_SESSION["scrutinID"] = $_SESSION["newId"];

    $jsonString = file_get_contents('scrutin.json');
    $filedata = json_decode($jsonString, true);

    $array = $_POST["t"];
    $mapVotant = $_POST["mapVotant"];

    $votant = array();

    foreach ($array as $idx => $value){
        array_push($votant, array(
            "nom" => $value, 
            "nombre de vote fait" => intval($mapVotant[$idx][0]), 
            "nombre de vote au total" => intval($mapVotant[$idx][1])
        ));
    }


    $newData = array(
        "id" => $_SESSION["newId"],
        "nom" => $_SESSION["nomQuest"],
        "CID" =>  $_SESSION["uid"],
        "question" => $_SESSION["question"],
        "nbrVotant" => $_SESSION["nbrVotant"],
        "dateFin" => $_SESSION["dateFin"],
        "methodeVote" => $_SESSION["methodeVote"],
        "Choix" =>  $_SESSION["choix"],
        "votants" => $votant,
        "public_key" => "",
        "resultat" => array()
        
    );

$currentData = file_get_contents('scrutin.json');
if ($currentData === false) {
    die('Impossible de lire le fichier JSON.');
}
$currentDataArray = json_decode($currentData, true);
$newDataArray = array($newData);
// Fusionner les nouveaux tableaux de données avec les données existantes
$newDataArray = array_merge($currentDataArray, $newDataArray);

// Convertir le tableau en format JSON
$jsonData = json_encode($newDataArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Écrire les données JSON dans le fichier
if (file_put_contents('scrutin.json', $jsonData) === false) {
    die('Impossible d\'écrire dans le fichier JSON.');
}
echo json_encode($newData);
?>