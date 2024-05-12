<?php 

    session_start();

    echo "<div class ='block'>";
    echo 'Rechercher : <input type="text" id = "searchUsers" placeholder ="..."> 
    <input class ="btn btn-light" type="button" value ="Search" onclick ="loadPeopleResearch()">
    <input class ="btn btn-light" type="button" value ="Annuler" onclick ="loadIndexPage(true)">
            </div>
        ';
    $jsonString = file_get_contents('logs.json');
    $filedata = json_decode($jsonString, true);
    
    if(isset($_POST["users"]))
    {
     foreach ($_POST["users"] as $user) 
                 {
                     echo '<input type="hidden" onload="addUserToSelection("'.$user.'")">';
 
                 }
    }
    

    $html = "";
    $html .= "<table><thead>Quel groupe souhaitez vous ajouter au sondage : </thead><tbody  id ='tableFullPageGroup'>
        <tr>
            <td> L3-Info <input id=\"input-checkbox-group-Info\" type=\"checkbox\" onclick=\"addUserGroup('Info')\"> </td>
            <td> L3-MIAGE <input id=\"input-checkbox-group-MIAGE\" type=\"checkbox\" onclick=\"addUserGroup('MIAGE')\"> </td>
            <td> Enseignant <input id=\"input-checkbox-group-Enseignant\" type=\"checkbox\" onclick=\"addUserGroup('Enseignant')\"> </td>
            <td> Etudiants <input id=\"input-checkbox-group-Etudiants\" type=\"checkbox\" onclick=\"addUserGroup('Etudiants')\"> </td>
            <td> Autres <input id=\"input-checkbox-group-Autres\" type=\"checkbox\" onclick=\"addUserGroup('Autres')\"> </td>
            <td> Tous <input id=\"input-checkbox-group-Tous\" type=\"checkbox\" onclick=\"addUserGroup('Tous')\"> </td>
            </tr>
    </tbody> </table>
    ";
    





    $html .= "<table><thead>Quels utilisateurs souhaitez vous ajouter a sondage : </thead><tbody  id ='tableFullPage'>";
    if(isset($_POST["stringSearched"]))
    {
        $string = $_POST["stringSearched"];
        foreach ($filedata as $idx => $value) 
        {
            if(str_contains(strtolower($value["uid"]),strtolower( $string) ))
            {
                $userFound = false;
                if(isset($_POST["users"]))
                foreach ($_POST["users"] as $user) 
                {
                            
                    if ($user === $value["uid"]) 
                    {
                        $html .= "<tr><td>Login : "
                        .$value["uid"]."</td>  
                        <td class =\"aligner\"><input id=\"input-checkbox-people-".$value["uid"]."\" class=\"aligner\" type=\"checkbox\" onclick=\"addUserToSelection('".$value["uid"]."')\" id=\"user\" checked></td>
                        <td class =\"aligner\"> Nombre de procuration(s) : <input class=\"aligner\" type=\"number\" value=0 min=0 max=2 id=\"procuration".$value["uid"]."\"</td>
                        </tr>";
                        $userFound = true;
                        break;
                    }
                }
                if (!$userFound) {
                    $html .= "<tr><td>Login : "
                        .$value["uid"]."</td>  <td class =\"aligner\"><input id=\"input-checkbox-people-".$value["uid"]."\" class=\"aligner\" type=\"checkbox\" onclick=\"addUserToSelection('".$value["uid"]."')\" id=\"user\"></td>
                        <td class =\"aligner\"> Nombre de procuration(s) : <input class=\"aligner\" type=\"number\" value=0 min=0 max=2 id=\"procuration".$value["uid"]."\"</td>
                        </tr>";
                }
            }
        }
    }
    else{
        foreach ($filedata as $idx => $value) 
        {
            $html .= "<tr><td>Login :"
            .$value["uid"]."</td>  <td class =\"aligner\"><input id=\"input-checkbox-people-".$value["uid"]."\" class=\"aligner\" type=\"checkbox\" onclick=\"addUserToSelection('".$value["uid"]."')\" id=\"user\"</td>
            <td class =\"aligner\"> Nombre de procuration(s) : <input class=\"aligner\" type=\"number\" min=0 max=2 id=\"procuration".$value["uid"]."\" value=0 ></td>
            </tr>";
        }
    }
    $html .= "</tbody></table>";
    $html .= '<input class ="btn btn-primary" type=\"button\" id=\"validerUsers\" onclick ="assignUserToVote('.$_SESSION["newId"].')" value="Valider">
        <div id="messageErreur"> </div>
    ';
    echo $html;

?>