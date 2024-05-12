<?php

    $html = "<h5> Nouveau Scrutin </h5>";

    $html .= "
                    <p>
                    Entrez le nom du Sondage : 
                    <input type=\"text\" id=\"input-nom-formulaire\"placeholder=\"Le nom...\" autocomplete=\"off\" >
                    </p>

                    <p>
                    Entrez la question du Sondage :
                    <input type=\"text\" id=\"input-question-formulaire\"placeholder=\"La question...\" autocomplete=\"off\" >
                    </p>

                    <p>
                    Entrez la date de fin du scrutin :
                    <input type =\"date\" id=\"input-date-formulaire\">
                    </p>

                    <p>
                    Choisir la méthode de vote préférentiel (vote classique par défaut)
                    <input class=\"form-check-input\" type=\"checkbox\" id=\"input-methode-vote-formulaire\">
                    </p>


                    <br>
                    <div id=\"nouveauChoix\">
                        <h6>Les Propositions</h6>
                        Ajoutez une proposition : 
                        <input type=\"text\" id=\"input-ajoute-choix\"  autocomplete=\"off\" > 
                        <input type=\"button\" value=\"ajout\" onclick=\"ajoutChoix()\">
                    </div>

                    <br>
                    <input type=\"button\" onclick='etape1NewForm()' value=\"Valider\" />

                    <div id=\"messageErreur\">
                    </div>

                
                ";

    echo $html;


?>