<?php
    session_start();

    $jsonString = file_get_contents("scrutin.json");
    $scrutins = json_decode($jsonString, true);

    $idScrutin = $_POST["id"];

    

    foreach($scrutins as $prop => $val){
        if ($val["id"] == $idScrutin){
            if($val["methodeVote"] == "false")
            {
                if (count($val["resultat"]) > 0)
                {
                    $somme = count($val["resultat"]);
                    echo "<p>Nombre de vote effectués : ".$somme."</p>";

                    echo "<table id=\"tableDetailChoix\">";
                    $bulletins = array_count_values($_POST["bulletins"]);
                    foreach($bulletins as $value => $occurence)
                    {
                        echo " <tr> 
                        <td> <label for=\"file\">".($value)." :</label> </td>

                        <td> <progress id=\"file\" max=\"100\" value=\"".(($occurence/$somme)*100)."\"> </progress> </td>

                        <td> ".round(($occurence/$somme)*100, 2)." % </td>

                        </tr>
                        ";

                    }

                    echo "</table>";

                    break;
                } else {
                    echo "<p margin-bottom=10em >Aucun vote comtabilisé, le vote est nul</p>";
                    break;
                }
            }

            else 
            {
                function gardePremier($t) {
                    return $t[0];
                }
                $bulletins = $_POST["bulletins"];
                $nouveauxBulletins = array_map('gardePremier', $bulletins);

                if (count($nouveauxBulletins) > 0)
                {
                    $somme = count($bulletins);
                    echo "<p>Nombre de vote effectués : ".$somme."</p>";

                    echo "<table id=\"tableDetailChoix\">";
                    $bulletins = array_count_values($nouveauxBulletins);
                    foreach($bulletins as $value => $occurence)
                    {
                        echo " <tr> 
                        <td> <label for=\"file\">".($value)." :</label> </td>

                        <td> <progress id=\"file\" max=\"100\" value=\"".(($occurence/$somme)*100)."\"> </progress> </td>

                        <td> ".round(($occurence/$somme)*100, 2)." % </td>

                        </tr>
                        ";

                    }

                    echo "</table>";

                    break;
                } else {
                    echo "<p margin-bottom=10em >Aucun vote comtabilisé, le vote est nul</p>";
                    break;
                }
            }
            
        }

    }

?>