<?php 

    // Chemin vers le fichier JSON
    $cheminFichier = 'scrutin.json';

    // Lire le contenu du fichier JSON
    $contenu = file_get_contents($cheminFichier);

    // Convertir le contenu en tableau associatif PHP
    $scrutins = json_decode($contenu, true);

    // Id du scrutin à modifier 
    $idScrutin = $_POST["id"];

    // Parcourir les scrutins pour trouver celui avec le bon ID
    foreach ($scrutins as $idx => $scrutin) {
        if ($scrutin["id"] == $idScrutin) {

            // Supprime le scrutin du fichier json
            unset($scrutins[$idx]);
        }
    }

    // Convertir le tableau associatif modifié en JSON
    $nouveauContenu = json_encode($scrutins, JSON_PRETTY_PRINT);

    // Écrire les modifications dans le fichier
    file_put_contents($cheminFichier, $nouveauContenu);
?>