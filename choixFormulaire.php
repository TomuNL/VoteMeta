<?php

    echo "<h6>Les Propositions</h6>
        Ajoutez une proposition : 
        <input type=\"text\" id=\"input-ajoute-choix\"  autocomplete=\"off\" > 
        <input type=\"button\" value=\"ajout\" onclick=\"ajoutChoix()\"> 
    ";

    if (json_decode($_POST["tableauVide"]) != true){
        $listeChoix = $_POST["choix"];

        foreach($listeChoix as $idx => $choix){
            echo "<br> <p class=\"choixFormulaire\" id=\"choix".$idx."\"> Choix ".$idx." : ".$choix."</p>
        
            <input type=\"button\" class=\"btn btn-light\" value=\"Supprimer\" onclick=\"supprimerChoix(".$idx.")\">
            ";

        }
    }


?>