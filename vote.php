<?php 
    session_start();

    // Chemin vers le fichier JSON
    $cheminFichier = 'scrutin.json';
    
    // Lire le contenu du fichier JSON
    $contenu = file_get_contents($cheminFichier);
    
    // Convertir le contenu en tableau associatif PHP
    $scrutins = json_decode($contenu, true);

    // Id du scrutin à modifier 
    $idScrutin = $_POST["id"];
    
    // Parcourir les scrutins pour trouver celui avec le bon ID
    foreach ($scrutins as &$scrutin) {
        if ($scrutin["id"] == $idScrutin) {
            foreach($scrutin["votants"] as &$votant){
                if ($votant["nom"] == $_SESSION["uid"]){
                    $votant["nombre de vote fait"] += 1;
                    break;
                }
            }

            array_push($scrutin["resultat"],$_POST["choix"]);
            break;
        }
    }
    
    // Convertir le tableau associatif modifié en JSON
    $nouveauContenu = json_encode($scrutins, JSON_PRETTY_PRINT);
    
    // Écrire les modifications dans le fichier
    file_put_contents($cheminFichier, $nouveauContenu)
?>