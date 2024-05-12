<?php 
session_start();
$jsonString = file_get_contents('logs.json');
$filedata = json_decode($jsonString, true);
//echo "<pre>".print_r($filedata)."</pre>";

$uid = $_POST["log"];
$pword =$_POST["pw"]; //password_hash($_POST["pw"],PASSWORD_DEFAULT);
foreach ($filedata as $idx => $value) 
{
    # lorsque l'on trouve le bon utilisateur unique, on vérifie qu'il s'agit du bon mot de passe
    if($value["uid"] == $uid )
    {
        if(password_verify($pword,$value["password"]))
        {
            $data = array(
                'found' => "true",
                'uid' => $uid,
                'password' => $value["password"]
            );
            $_SESSION["uid"] = $uid;
            $_SESSION["lastConnect"] = time(); 
            // Conversion des données PHP en JSON
            $jsonData = json_encode($data);
            break;
        }
        else 
        {
            $data = array(
            'found' => "false",
            'uid' => $uid,
            'password' => $pword,
            'password from database' => $value["password"] 
            );
            $jsonData = json_encode($data);
            break; // break possible car les uid doivent être uniques
        }
    }
   
    
}; 


// Renvoyer les données JSON
echo $jsonData;




?>