<?php 

if(isset($_POST["username"])){
    $uid = $_POST["username"];
    $pword = $_POST["mdp1"];
    echo'
    <h1 id = "connect">Connectez vous :</h1>

    <div id = "logs">
            salut
    <div class="form-group">
    
        <label for="exampleInputEmail1">Nom d\'utilisateur :</label>
        <input type="email" value = "'.$uid.'" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre nom d\'utilisateur">
    </div>
    <div class="form-group">
        <label  for="exampleInputPassword1">Mot de Passe :</label>
        <input  type="password" value="'.$pword.'" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe">
    </div>
    <div id="form-group-validate">
        <button onclick = "validateLogs()" class="btn btn-primary">Valider</button>
        <button onclick = "loadSignPage()" class="btn btn-primary">S\'inscrire</button>
        <br><br>
    <button type="button" class="btn btn-danger" onclick="loadIndexPage()">Annuler</button>
    </div>
    </div>
    </div>';
}
else 
{
    echo'
    <h1 id = "connect">Connectez vous :</h1>

    <div id = "logs">
            salut
    <div class="form-group">
        <label for="exampleInputEmail1">Nom d\'utilisateur :</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre nom d\'utilisateur">
    </div>
    <div class="form-group">
        <label  for="exampleInputPassword1">Mot de Passe :</label>
        <input  type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe">
    </div>
    <div id="form-group-validate">
        <button onclick = "validateLogs()" class="btn btn-primary">Valider</button>
        <button onclick = "loadSignPage()" class="btn btn-primary">S\'inscrire</button>
        <br><br>
    <button type="button" class="btn btn-danger" onclick="loadIndexPage()">Annuler</button>
    </div>
    </div>
    </div>';
}



?>