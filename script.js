var encrypt = new JSEncrypt();
var decrypt = new JSEncrypt();


function validateLogs()
{
  //appel ajax pour vérifier la connexion

    var var1 = $("#exampleInputEmail1").val();
    $.ajax( {
        type : "POST",
        url: "validateLogs.php",
        data:{"log": var1 , "pw" :$("#exampleInputPassword1").val()}
      })
    .done(function(data) {
        var jsonData = JSON.parse(data);
        $("#contents").html(data);
        if(jsonData.found == "true")
        {
          console.log("validé");
          $("#connexionToken").html(
            "Connecté en tant que : "+ var1
          );
           $("#logs").html("<br>"+var1);
           loadIndexPage(true);
        }
        else 
        {console.log("non validé");
          $("#connexionToken").html(
            "Non Connecté"
          );
        }
       
      })
    .fail(function() {
        alert( "error" );
      });
}

function loadSignPage()
{
    $.ajax( {
        url: "signUp.php",
      })
      .done(function(msg) {
        $("#contents").html(msg);
      })
      .fail(function() {
        alert( "error" );
      });
}

function loadConnectPage()
{
    $.ajax( {
        url: "connect.php",
      })
      .done(function(msg) {
        $("#contents").html(msg);
      })
      .fail(function() {
        alert( "error" );
      });   
}

function loadIndexPage(connected = false)
{
  if(connected)
  {
    $.ajax( {
    url: "page1.php",
  })
  .done(function(msg) {
    $("#contents").html(msg);
  })
  .fail(function() {
    alert( "error" );
  });  

  }
  else {
    $.ajax( {
      type : "POST",
      url: "IndexPage.php",
      data : {disconnected : true}
    })
    .done(function(msg) {
      $("#contents").html(msg);
      $("#connexionToken").html("Non connecté ");
    })
    .fail(function() {
      alert( "error" );
    });  
  } 
}

function newSubscriber()
{
    var var1 = $("#usernameSign").val();
    if(var1 == "")
    {
      $("#erreurConnection").html("Erreur : Veuillez rentrer un non d'utilisateur correct");
      return;
    }
    

    const password = $("#passwordSign").val();

    if(password == "")
    {
      $("#erreurConnection").html("Erreur : Veuillez rentrer un mot de passe correct");
      return;
    }

    const password2 = $("#passwordSign2").val();
  

    if(password == password2){
      $.ajax( {
          url: "newSubscriber.php",
          type : "POST",
          data : {username : var1 ,
             mdp1 : password,
             group : $('input[name="choixGroup"]:checked').attr('id')
            }
        })
        .done(function(msg) {
          $("#contents").html(msg);
            $.ajax( {
              url: "connect.php",
              type : "POST",
              data : {username : var1 , mdp1 :password, mdp2 :password}
            })
            .done(function(msg) {
              $("#contents").html(msg);
            })
            .fail(function() {
              alert( "error" );
            });   
        })
        .fail(function() {
          alert( "error" );
        }); 
      }
    else 
    {
      $("#erreurConnection").html("Veuillez vérifier correctement votre mot de passe");
    }
}

function logBout()
{
  //console.log("salut");

  loadIndexPage(false);
  $("#connexionToken").html("Viens d'être déconnecté "); 
}

function loadPeopleResearch()
{
  $.ajax( {
    url: "peopleResearch.php",
    type : "POST",
    data:{
      stringSearched: $("#searchUsers").val(),
      users : selectedUsers
  }
  })
  .done(function(msg) {
    $("#contents").html(msg);
  })
  .fail(function() {
    alert( "error" );
  }); 
}

// Fonction qui supprime un Scrutin selon son id
function supprimerScrutin(id){
  $.ajax( {
    method: "POST",
    url: "supprimerScrutin.php",
    data:{"id":id}
  })
  .done(function(msg) {
    loadIndexPage(true);
    detailScrutin(id);
  })
  .fail(function(){
      alert( "erreur sur l'affichage des details d'un scrutin" );
  });

}

function assignUserToVote(scrutId)
{
  // TODO

  res = true;
  var mapVotant = [];
  selectedUsers.forEach((element) => {
    if (!(parseInt($("#procuration"+element).val()) >= 0)) { 
      res=false
    }
    //Ici on construit un tableau de tuple (nbr vote effectué, nbr vote total), chaque tuple correspond à un votant sélectionné
    mapVotant.push([0, 1 + parseInt($("#procuration"+element).val())]);
  });


  $("#messageErreur").html("");

  //Verifie qu'il y a au moins 2 votants dans le scrutin
  if (selectedUsers.length > 1) {
    if (res){
      $.ajax( {
        type : "POST",
        url: "peopleResearch.php",
        
      })
      .done(function(msg){
        $("#contents").html("Données enregistré ");
        validateUsers(mapVotant, scrutId);
        selectedUsers = [];
      })
      .fail(function(){
        console.log("Erreur sur l'ajout des votant");
      })
        //console.log(msg);
    } else {
      $("#messageErreur").html("Tous les votants doivent avoir une procuration à zéro au minimum.");
    }

  } else  {
    $("#messageErreur").html("Pas assez de votant sélectionné.");
  }
  
  
}

function detailScrutin(id){

  $.ajax( {
      method: "POST",
      url: "detailScrutin.php",
      data:{"id":id}
  })
  .done(function(msg) {
      $("#contents2").html(msg);
  })
  .fail(function(){
      alert( "erreur sur l'affichage des details d'un scrutin" );
  });
}

function getResultat(id){
  let bulletins = decodeVotesFromJSON(id);
  //console.log(bulletins);

  $.ajax( {
    method: "POST",
    url: "affichageResultat.php",
    data:{ "id":id,
      "bulletins":bulletins
    }
  })
  .done(function(msg) {
      $("#detailScrutinInfo").html(msg);
  })
  .fail(function(){
      alert( "erreur sur l'affichage des details de resultat d'un scrutin" );
  });
}

function decodeVotesFromJSON(id) {
  let xhr = new XMLHttpRequest();
  // Ouverture de la requête GET synchrone vers le fichier JSON spécifié
  xhr.open('GET', "scrutin.json", false); // false pour une requête synchrone
  xhr.send(null); // Envoi de la requête sans données supplémentaires

  // Vérification si la réponse a un code de statut 200 (OK)
  if (xhr.status === 200) {
      let scrutins = JSON.parse(xhr.responseText);

      let decodedResultats = [];

      for (let i = 0; i < scrutins.length; i++) {
          if (scrutins[i].id == id){
              if(scrutins[i].methodeVote=="false"){

              let scrutin = scrutins[i];

              let decrypt = new JSEncrypt();
              decrypt.setPublicKey(scrutin.public_key);
              decrypt.setPrivateKey(localStorage.getItem("PrivateKeyScrutin"+id))

              // Parcours des résultats de chaque scrutin
              for (let j = 0; j < scrutin.resultat.length; j++) {
                  let resultatEncrypted = scrutin.resultat[j];
                  // Décodage du résultat crypté
                  let resultatDecoded = decrypt.decrypt(resultatEncrypted);
              
                  // Ajout du résultat décodé au tableau des résultats décodés
                  decodedResultats.push(resultatDecoded);
              }
            }
            else
            {
              let scrutin = scrutins[i];

              let decrypt = new JSEncrypt();
              decrypt.setPublicKey(scrutin.public_key);
              decrypt.setPrivateKey(localStorage.getItem("PrivateKeyScrutin"+id))

              // Parcours des résultats de chaque scrutin
              for(let i = 0 ; i < scrutin.resultat.length ; i++)
              {
                tempo = []
                for (let j = 0; j < scrutin.Choix.length; j++) {
                    let resultatEncrypted = scrutin.resultat[i][j];
                    // Décodage du résultat crypté
                    let resultatDecoded = decrypt.decrypt(resultatEncrypted);
                
                    // Ajout du résultat décodé au tableau des résultats décodés
                    tempo.push(resultatDecoded);
                    console.log(resultatDecoded)
                    
                }console.log("tempo : "+tempo);
                decodedResultats.push(tempo);
              }
            }
          }
      }
      // Retourne le tableau des scrutins décodés
      console.log("return :" +decodedResultats);
      return decodedResultats;
  } else {
      // Si la requête a échoué (code de statut différent de 200), lance une erreur
      throw new Error("Erreur lors de la récupération des données JSON : " + xhr.status);
  }
}



function affichageVote(id){
  $("#detailScrutinInfo").html("");
  $("#messageErreur").html("");
  resetChoice();
  $.ajax( {
    method: "POST",
    url: "affichageVote.php",
    data:{"id":id}
  })
  .done(function(msg) {
      $("#detailScrutinInfo").html(msg);
  })
  .fail(function(){
      alert( "erreur sur l'affichage des details de vote d'un scrutin" );
  });
}

function vote(id, choix){
  choix = getEncryptedChoice(id,choix);
  console.log(choix + " est le choix encrypté");
  $.ajax( {
    method: "POST",
    url: "vote.php",
    data:{"id":id, 
          "choix": choix
         }
  })
  .done(function(msg) {
    console.log(msg);
    detailScrutin(id);
    affichageVote(id);
  })
  .fail(function(){
      alert( "erreur sur l'affichage des details de vote d'un scrutin" );
  });
}

var choiceDone =[];

function resetChoice()
{
  choiceDone = [];
}

function votePreferentiel(scrutId,choiceId)
{
  //console.log("super tu as voté !");
  choiceDone.push(choiceId);
  console.log(scrutId);
  console.log(choiceDone);
  console.log(choiceDone.length);
  $.ajax( {
    method: "POST",
    url: "affichageVote.php",
    data:{"id":scrutId , "choiceDone" : choiceDone , "idxChoix" : choiceDone.length}
  })
  .done(function(msg) {
      $("#detailScrutinInfo").html(msg);
  })
  .fail(function(){
      alert( "erreur surle vote preferentiel d'un scrutin" );
  });
}

function submitVotePref(scrutId)
{
  let res = []
  choiceDone.forEach(element => {
    res.push(getEncryptedChoice(scrutId,element));
  });
  $.ajax( {
    method: "POST",
    url: "vote.php",
    data:{"id":scrutId , "choix" : res }
  })
  .done(function(msg) {
      $("#detailScrutinInfo").html(msg);
  })
  .fail(function(){
      alert( "erreur sur l'affichage des details de vote d'un scrutin" );
  });
}

function test()
{
  console.log("oui");
}

function getEncryptedChoice(id, choix) {
  let xhr = new XMLHttpRequest();
  xhr.open('GET', 'scrutin.json', false); // false pour une requête synchrone
  xhr.send(null);

  if (xhr.status === 200) {
      let data = JSON.parse(xhr.responseText);
      let encryptedChoice = null;
      // Parcourir chaque scrutin
      data.forEach(scrutin => {
          if (id == scrutin.id) {
              if (scrutin.hasOwnProperty('public_key')) {
                  let key = new JSEncrypt();
                  key.setPublicKey(scrutin.public_key);
                  //console.log('Clé publique trouvée :', scrutin.public_key);
                  encryptedChoice = key.encrypt(choix);
              } else {
                  throw new Error("Erreur : Aucune clé publique trouvée pour le scrutin");
              }
          }
      });
      if (encryptedChoice !== null) {
          return encryptedChoice;
      } else {
          throw new Error("Erreur : Aucun scrutin trouvé avec l'identifiant fourni");
      }
  } else {
      throw new Error("Erreur lors de la récupération des données JSON : " + xhr.status);
  }
 
}



function cloreScrutin(id){
  $("#detailScrutinInfo").html("");
    $.ajax( {
      method: "POST",
      url: "cloreScrutin.php",
      data:{"id":id}
    })
    .done(function(msg) {
        detailScrutin(id);
    })
    .fail(function(){
        alert( "erreur sur la cloture d'un scrutin" );
    }); 
}

function creationScrutin(){
  nbrChoix = 0;
  Choix = [];
  $.ajax({
      method: "POST", 
      url: "formulaireScrutin1.php"
  })
  .done(function(msg) {
      $("#contents2").html(msg);
  })
  .fail(function() {
      alert("erreur sur la création d'un nouveau scrutin")
  })
}

function etape1NewForm(){

  var1 = $("#input-nom-formulaire").val();
  var2 = $("#input-question-formulaire").val();
  var3 = $("#input-date-formulaire").val();
  var4 = $("#input-methode-vote-formulaire").prop("checked");

  if (verifieInformation(var1, var2, var3)){
  
    $.ajax({
        method: "POST", 
        url: "etape1NewForm.php", 
        data: {
              "nom":var1,
              "question": var2,
              "nbrProp": nbrChoix, 
              "tableauProp": Choix,
              "dateFin" :var3,
              "methodeVote":var4
              }
    })
    .done(function(msg){
      clearSelectedUsers();
      loadPeopleResearch();
    })
    .fail(function() {
        alert("erreur sur l épate 1 de la création d'un formulaire");
    })
  } 
}

function verifieInformation(nom, question, date){

  $("#messageErreur").html("<ul>");

  //Vérifie que le nomn'est pas null et n'est pas composé que d'espaces 
  const bool1 = (nom.replace(/\s/g, '') != "") && (nom != null);
  if ( !bool1 ){
    $("#messageErreur").append("<li> Nom du scrutin invalide </li>");
  } 

  //Vérifie que la question n'est pas null et n'est pas composée que d'espaces 
  const bool2 = (question.replace(/\s/g, '') != "") && (question != null);
  if ( !bool2 ){
    $("#messageErreur").append("<li> Question du scrutin invalide </li>");
  }

  //Vérifie que la date n'est pas null et que la date donnée soit bien ultérieure à celle d'aujourd'hui
  const bool3 = new Date < new Date(date);
  if ( !bool3 ){
    $("#messageErreur").append("<li> Date du scrutin invalide </li>");
  }

  //Vérifie qu'il y est bien 2 choix différents pour le scrutin
  const bool4 = Choix.length > 1;
  if (!bool4){
    $("#messageErreur").append("<li> Il manque des choix (2 minimum) </li>");
  }

  $("#messageErreur").append("</ul>");



  return bool1 && bool2 && bool3 && bool4;

}


var nbrChoix = 0;
let Choix = [];
function ajoutChoix(){

  if ($("#input-ajoute-choix").val() != "" && !(Choix.includes($("#input-ajoute-choix").val())) ){

      nbrChoix += 1;

      Choix.push($("#input-ajoute-choix").val());


      if (nbrChoix < 5) {
          $.ajax({
              method: "POST", 
              url: "choixFormulaire.php", 
              data: {"choix": Choix, "tableauVide" : false}
          })
          .done(function(msg){
              $("#nouveauChoix").html(msg);
          })
          .fail(function() {
              alert("erreur sur l'ajout d'un choix dans le formulaire");
          })
      } else {
          $("#messageErreur").html("<br> <p>Impossible d'ajouter d'autre choix</p>");
      }
  }

  $("#input-ajoute-choix").val("");
}

function supprimerChoix(id){
  Choix.splice(id);
  nbrChoix -= 1;

  $.ajax({
    method: "POST", 
    url: "choixFormulaire.php", 
    data: {"choix": Choix, "tableauVide": (nbrChoix == 0)} //bug si le tableau est vide dans choixFormulaire
  })
  .done(function(msg){
      $("#nouveauChoix").html(msg);
  })
  .fail(function() {
      alert("erreur sur la suppression d'un choix dans le formulaire");
  })
}

var selectedUsers = []; // Tableau pour stocker les utilisateurs sélectionnés

function clearSelectedUsers()
{
  selectedUsers = [];
}

function addUserToSelection(userId) {
    //console.log("fonction");
    if(!selectedUsers.includes(userId)){
      //console.log("pas déja dans la liste");
     // Ajouter l'ID de l'utilisateur sélectionné au tableau
      selectedUsers.push(userId)
      console.log("ajout de : " + userId);
    }
    else 
    {
      //console.log("déja dans la liste");
      selectedUsers = selectedUsers.filter((word) => word != userId);
      console.log("retrait de : " + userId);
    }
}

function addUserGroup(group){
  let xhr = new XMLHttpRequest();
  xhr.open('GET', 'logs.json', false); // false pour une requête synchrone
  xhr.send(null);

  if (xhr.status === 200) {
      let data = JSON.parse(xhr.responseText);

      if ($("#input-checkbox-group-"+group).prop("checked")){

        if (group == "Tous"){ // Ajoute tous les votants
          // Parcourir chaque utilisateur
          data.forEach(user => {
                if (!selectedUsers.includes(user.uid)){
                  addUserToSelection(user.uid);
                  $("#input-checkbox-people-"+user.uid).prop('checked', true);
                }
          });
        } else {
          // Parcourir chaque utilisateur
          data.forEach(user => {
              if (group == user.group) {
                if (!selectedUsers.includes(user.uid)){
                  addUserToSelection(user.uid);
                  $("#input-checkbox-people-"+user.uid).prop('checked', true);
                }
              }
          });
        }
      } else {
        clearSelectedUsers();
        data.forEach(user => {
          $("#input-checkbox-people-"+user.uid).prop('checked', false);
        });
      }
  } else {
      throw new Error("Erreur lors de la récupération des données JSON : " + xhr.status);
  }
//console.log(selectedUsers);
}

function validateUsers(mapVotant) {

  //selectedUsers.forEach((element) => console.log(element));

  $.ajax({
    method: "POST", 
    url: "savePeople.php", 
    data: {
          "t":selectedUsers, 
          "nbrVotant":selectedUsers.length,
          "mapVotant":mapVotant,
          "nbrChoix":nbrChoix
          }
  })
  .done(function(msg){
    /* TODO
        gérer la création des clés d'encryption
    */
    var newData = JSON.parse(msg);
    console.log(newData.id);
    createKeys(newData.id);
    loadIndexPage(true);
  })
  .fail(function() {
      alert("erreur sur l épate 1 de la création d un formulaire");
  }) 
}

function createKeys(scrutId)
{
  var crypt = new JSEncrypt();

  // longueur de clé par défaut : 2048 bits
  crypt.getKey();
  var publicKey = crypt.getPublicKey();
  let privateKey = crypt.getPrivateKey();

  // Afficher les clés dans la console
  //console.log("Clé publique : ", publicKey);
  //console.log("Clé privée : ", privateKey);
  
  // sauvegarder la clé privée
  localStorage.setItem("PrivateKeyScrutin"+scrutId, privateKey);

  $.ajax({
    method: "POST", 
    url: "savePubKey.php", 
    data: {
          "public_key" : crypt.getPublicKey()
          }
  })
  .done(function(msg){
    console.log(msg);
  })
  .fail(function() {
      alert("erreur lors de l'ecriture de la public key dans le scrutin");
  }) 
}