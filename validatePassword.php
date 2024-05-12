<?php 
    session_start();

   
    
    if(isset($_POST["bool"]))
    {  
         $gbool =  $_POST["bool"];
        $uid = $_POST["uid"];
        $_SESSION["uid"] = $uid;
        $_SESSION["lastConnect"] = time(); 
        echo "Connecté " .  $_SESSION["uid"]." !";
        echo '</br> Denière Connexion il y a'.time();
    echo '</br>
    <button type="button" class="btn btn-primary" onclick ="loadIndexPage(true)">Vers l\'accueil </button>';
    
    }

    else 
    {
              echo '
        Echec de la connexion
        </br>
            <button type="button" class="btn btn-primary" onclick ="loadIndexPage(true)">Retour</button>
            <button type="button" class="btn btn-primary" onclick ="loadConnectPage()">Se reconnecter</button>';
    
    }

?>