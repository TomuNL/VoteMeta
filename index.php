<?php 
    session_start();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title> VoteMeta</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.1.0/jsencrypt.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
        <script src = "script.js"></script>
    </head>
        
            <?php 
            $uid = isset($_SESSION["uid"]) ;
            echo "<body onload=\"loadIndexPage(".$uid.")\">";
                echo '<div id = "connexionToken">';
            if($uid)
                {echo "Connecté en tant que : ".$_SESSION["uid"];}

            ?>
     </div>

     <!-- <input type="button" onclick ="createKeys()" value = "create keys">     -->
        <div id="contents">
        </div>
    </body>
</html>