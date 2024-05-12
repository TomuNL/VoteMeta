<?php 
    
    $username = $_POST["username"];
    $mdp1 = $_POST["mdp1"];
    $hash = password_hash($mdp1, PASSWORD_DEFAULT);
    $group = $_POST["group"];
    $newData = array(
        "uid" => $username,
        "password" => $hash,
        "group" => $group
    );

    $jsonString = file_get_contents("logs.json");
    $logs = json_decode($jsonString, true);
    $bool = true;
    foreach($logs as $idx => $val) 
    {
        if($username == $val["uid"])
        {
            $bool = false;
        }
    }
    if($bool)
    {
        if(!file_exists('logs.json'))
        {
            file_put_contents('logs.json', $data);
        }
        else 
        {

            $oldJson = file_get_contents('logs.json');
            $oldData = json_decode($oldJson, true);
            $oldData[] = $newData;
            $jsonData = json_encode($oldData, JSON_PRETTY_PRINT);
            file_put_contents('logs.json', $jsonData);
            echo "Données enregistrées avec succès ! <br/>";
            //echo "OLD DATA <br/><pre>".print_r($oldData,true)."</pre>";
        }
       
    }
    else
       // echo "<input type='button' class='btn btn-danger' value='Données non-valides'>";
?>