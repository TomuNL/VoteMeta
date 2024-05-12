<?php 
session_start();

echo "<button type=\"button\" class=\"btn btn-danger\" onclick=\"logBout()\">Se déconnecter</button>
      <div class=  \"centrer\">
          <h1> Bienvenue sur VoteMeta </h1>
          
      </div>
      <br>

      <div class=\"enLigne\">

        <div id=\"contents1\" class=\"border border-5\">
          <h5> Liste de mes scrutins </h4>
          <br>
        ";
          

            $jsonString = file_get_contents("scrutin.json");
            $data = json_decode($jsonString, true);

            echo "<ol>";
            foreach($data as $prop => $val)
            {
              if ($val["CID"] == $_SESSION["uid"]){
                echo " <li id =\"listeScrutins\"> Nom : ".
                  $val["nom"].
                  " <input type=\"button\" class=\"buttonDetail btn btn-light\" onclick = \"detailScrutin(".
                  $val["id"].
                  ")\" value=\"Detail\"> </li>";
              } else {
                foreach($val["votants"] as $idx => $vot){
                  if ($_SESSION["uid"] == $vot["nom"]){
                    echo " <li id =\"listeScrutins\"> Nom : ".
                    $val["nom"].
                    " <input type=\"button\" class=\"buttonDetail btn btn-light\" onclick = \"detailScrutin(".
                    $val["id"].
                    ")\" value=\"Detail\"> </li>";
                  }
                }
              }
            }
         
         echo   "  </ol>
          <br>

          <div id=\"NewScrutin\">
            <h5> Création d'un nouveau Scrutin</h5>
            <input type=\"button\" onclick=\"creationScrutin()\" value=\"Créer\">
          </div>

            </div>

            <div id=\"contents2\" class=\"border border-5\">
                
            </div>

              <div id=\"testaffiche\">
              
              </div>

            </div>
          </div>
      "

  ?>