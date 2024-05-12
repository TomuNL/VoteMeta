<?php
session_start();
// Lire le contenu du fichier JSON
$jsonString = file_get_contents('scrutin.json');
$scrutins = json_decode($jsonString, true);

foreach ($scrutins as &$scrutin) {  
    if($scrutin["id"] == $_SESSION["scrutinID"])
    {
        $scrutin['public_key'] = $_POST["public_key"];
    }
}

// Convertir les données modifiées en JSON
$modifiedJson = json_encode($scrutins, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Écrire le JSON modifié dans le fichier
file_put_contents('scrutin.json', $modifiedJson);

echo 'Clés publiques ajoutées avec succès aux scrutins.'. $_SESSION["newId"];
?>
