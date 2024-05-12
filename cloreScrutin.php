<?php 
    // Chemin vers le fichier JSON
    $cheminFichier = 'scrutin.json';
    
    // Lire le contenu du fichier JSON
    $contenu = file_get_contents($cheminFichier);
    
    // Convertir le contenu en tableau associatif PHP
    $scrutins = json_decode($contenu, true);

    // Id du scrutin à modifier 
    $idScrutin = $_POST["id"];
    
    // Parcourir les scrutins pour trouver celui avec l'ID 1
    foreach ($scrutins as &$scrutin) {
        if ($scrutin['id'] == $idScrutin) {
            // Modifier la date de fin pour le scrutin avec l'ID 1
            $scrutin['dateFin'] = date('Y-m-d'); // Nouvelle date de fin
            break; // Sortir de la boucle une fois la modification effectuée
        }
    }
    
    // Convertir le tableau associatif modifié en JSON
    $nouveauContenu = json_encode($scrutins, JSON_PRETTY_PRINT);
    
    // Écrire les modifications dans le fichier
    file_put_contents($cheminFichier, $nouveauContenu)
?>