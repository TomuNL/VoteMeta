<?php
    session_start();

    $jsonString = file_get_contents("scrutin.json");
    $scrutins = json_decode($jsonString, true);

    $idScrutin = $_POST["id"];

    foreach($scrutins as $prop => $val){
        if ($val["id"] == $idScrutin){
            if($val["methodeVote"] == "false")
            {
                 foreach($val["votants"] as $idx => $votant){
                $nbrVoteRestant = $votant["nombre de vote au total"] - $votant["nombre de vote fait"];

                if ($votant["nom"] == $_SESSION["uid"]){
                    echo "<p> Il vous reste ".$nbrVoteRestant." vote(s) </p>";

                    if ($nbrVoteRestant > 0) {

                        echo "<table id=\"tableDetailChoix\">";
    
    
                        foreach($val["Choix"] as $propC => $valC){
                            echo "<tr> <td> - ".$valC." </td>
                            <td> <input type=\"button\" class=\"btn btn-light\" value=\"vote\" onclick=\" vote(".$idScrutin.", '".$valC."') \"> </td>
                            </tr>";
                            
                        }
    
                        echo "</table>";
    
                    } else {
                        echo "<p> Vous ne pouvez plus voter </p>";
    
                        }
                    }
                }
                break;
            }

            else 
            {
                
                if(isset($_POST["idxChoix"]))
                {
                    
                    $idxCh = $_POST["idxChoix"]+1;
                    //
                    if($idxCh-1 == count($val["Choix"]))
                    {
                        echo " <h3> Voulez vous enregistrer vos choix ?</h1> </br> Rappel :";
                        foreach($_POST["choiceDone"] as $idx => $choix)
                        {
                            echo "<ol>Choix ".$idx." - ".$choix."</ol>";
                        }
                        echo "<input type=\"button\" class=\"btn btn-success\" value=\"Confirmer\" onclick=\"submitVotePref(".$idScrutin.")\">";
                        echo "<input type=\"button\" class=\"btn btn-danger\" value=\"Annuler\" onclick=\"affichageVote(".$idScrutin.")\">";
                        return;
                    }
                }
                else 
                {
                  $idxCh = 1;
                }
                foreach($val["votants"] as $idx => $votant){
                    $nbrVoteRestant = $votant["nombre de vote au total"] - $votant["nombre de vote fait"];
    
                    if ($votant["nom"] == $_SESSION["uid"]){
                        
                    
                        if ($nbrVoteRestant > 0) {
                            echo "<p> Il vous reste ".$nbrVoteRestant." vote(s) </p>";
                            echo "<div> Choississez votre choix n°".$idxCh."</br>";
                            
                            foreach($val["Choix"] as $idx => $choix)
                            {
                                if(isset($_POST["choiceDone"]) and in_array($choix,$_POST["choiceDone"]))
                                {
                                    //echo "<input type=\"button\" class=\"btn btn-danger\" value=\"".$choix."\" onclick=\"votePreferentiel(".$idScrutin.",".$idx.")\">";
                                    echo "<input type='button'  disabled style='opacity: 0.8; cursor: not-allowed;' value=\"".$choix."\">";
                                }
                                else 
                                {
                                    echo "<input type=\"button\" class=\"btn btn-light\" value=\"".$choix."\" onclick=\"votePreferentiel(".$idScrutin.",'".$choix."')\"> ";
                                }

                            }echo "</div>";
                        }
                        else 
                        {
                            echo "<p> Vous ne pouvez plus voter </p>";
                        }
                        
                //echo "<input type=\"button\" class=\"btn btn-success\" value=\"Voter\" onclick=\"votePreferentiel(".$idScrutin.")\">";
                    }
                }
            }
        }
    }

?>