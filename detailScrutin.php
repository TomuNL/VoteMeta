<?php 
    session_start();

    $jsonString = file_get_contents("scrutin.json");
    $scrutins = json_decode($jsonString, true);

    $idScrutin = $_POST["id"];

    foreach($scrutins as $prop => $val){
        if ($val["id"] == $idScrutin){

            $estVotant = false;
            $nbrVoteEnregistres = 0;
            $nbrVoteTotal = 0;

            foreach($val["votants"] as $idx => $votant){
                if ($votant["nom"] == $_SESSION["uid"]){
                    $estVotant = true;
                }

                $nbrVoteEnregistres += $votant["nombre de vote fait"];
                $nbrVoteTotal += $votant["nombre de vote au total"];
            }

            if ($_SESSION["uid"] === $val["CID"]){
                echo "<p> <font color=\"red\">Vous êtes le créateur de ce scrutin !!!! </font></p>";
            }

            echo "<h5>".$val["nom"]."</h5>";

            echo "<p>Date de Fin du scrution : ".$val["dateFin"]."</p>";

            if($_SESSION["uid"] == $val["CID"]){
                echo " <p id=\"infoCreateurScrutin\">".$nbrVoteEnregistres." vote(s) enregistré(s) / ".$nbrVoteTotal." vote(s) au total </p>
                        <p id=\"infoCreateurScrutin\"> Nombre de votant au total : ".$val["nbrVotant"]."</p>
                ";
            }

            echo "<h5>".$val["question"]."</h5>";


            //Affichage différent si la date du scrutin est dépassé ou non
            if (new DateTime() > new DateTime($val["dateFin"])){
                echo "<p>Date de scrutin depassée, le scrutin est finit</p>
                <input class =\"btn btn-danger clore-button\" type=\"button\" value=\"Supprimer\" onclick=\"supprimerScrutin(".$idScrutin.")\" > 
                <input class =\"btn btn-light\" type=\"button\" value=\"Resultat\" onclick=\"getResultat(".$idScrutin.")\" >
                ";
            } else {

                if ($_SESSION["uid"] === $val["CID"] ){ //Verifie si l'utilisateur est le créateur du scrutin 
                    echo "<input class =\"btn btn-danger clore-button\" type=\"button\" value=\"Supprimer\" onclick=\"supprimerScrutin(".$idScrutin.")\" >"; 
                    echo "<input class =\"btn btn-light clore-button\" type=\"button\" value=\"Clore le Scrutin\" onclick=\"cloreScrutin(".$idScrutin.")\" >";
                } 

                if ($estVotant){
                    echo "<input class =\"btn btn-success vote-button\" type=\"button\" value=\"Voter\" onclick=\"affichageVote(".$idScrutin.")\">";
                }
            }


            echo "<div id=\"detailScrutinInfo\"> </div>
            <div id=\"messageErreur\" > </div>
            ";

            break;
        }
    }

?>