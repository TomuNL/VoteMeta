<?php

    echo 
    '<h1 id = "connect">Inscrivez-vous :</h1>

        <div id = "erreurConnection">
        </div>

        <br>
        <div class="form-group">
            <label for="exampleInputEmail1">Nom d\'utilisateur :</label>
            <input type="email" class="form-control" id="usernameSign" aria-describedby="emailHelp" placeholder="Entrez votre nom d\'utilisateur">
        </div>
        <div class="form-group">
            <label  for="exampleInputPassword1">Mot de Passe :</label>
            <input  type="password" class="form-control" id="passwordSign" placeholder="Entrez votre mot de passe">
        </div>
        <div class="form-group">
            <label  for="exampleInputPassword1">Confirmez votre Mot de Passe :</label>
            <input  type="password" class="form-control" id="passwordSign2" placeholder="...">
        </div>
        <div class="form-group">
        <label for="Enseignant">Choisissez votre groupe d\'études : </label>
        
            <input class="form-check-input" type="radio" name="choixGroup" id="Enseignant">
            <label class="form-check-label" for="Enseignant">
               Enseignant
            </label>
            <input class="form-check-input" type="radio" name="choixGroup" id="Info">
            <label class="form-check-label" for="Info">
                L3 - Info
            </label>
            <input class="form-check-input" type="radio" name="choixGroup" id="MIAGE">
            <label class="form-check-label" for="MIAGE">
                L3 - MIAGE
            </label>
            <input class="form-check-input" type="radio" name="choixGroup" id="Etudiants">
            <label class="form-check-label" for="Etudiants">
                Etudiants (autres que info et miage)
            </label>
            <input class="form-check-input" type="radio" name="choixGroup" id="Autres" checked>
            <label class="form-check-label" for="Autres">
                Autres
            </label>
        </div>

        <div  class="form-group">
        <button type="button" class="btn btn-success" onclick="newSubscriber()">Success</button>
        <button type="button" class="btn btn-danger" onclick="loadIndexPage()">Annuler</button>
        </div>
        ';

?>