<?php
/*
*contolleur frontal
*/
    if(isset($_REQUEST["login"]))
    {
      session_start();
      include_once("../web/database/baseConf.php");
      include_once("../web/database/Requetes.class.php");
      $requete = new Requetes(CLIENTHOSTNAME,CLIENTBASENAME,CLIENTUSERNAME,CLIENTPASSWORD);
      //on teste que cet utilisateur existe dans la base de données, si oui valeur vaudra 1
      $user=$requete->authentification($_REQUEST["login"],SHA1($_REQUEST["password"]));
      //si l'utilisateur existe, création d'un objet utilisateur qui representera l'utilisateur
      if($user)
      {
        //creation de la session de l'utilisateur
        $_SESSION["user"] = array('prenom' => $user["prenomUser"],
                                  'nom' => $user["nomUser"],
                                  'idStructure' => $user["structureUser"]);
        //redirection au bon endroit en fonction de la stucture
        if ($user["structureUser"]=='1'){
              //C'est un admin
              echo '<meta http-equiv="Refresh" content="0;url=admin.php">';
              exit();
          }
          else{
              //C'est une structue quelconque
              echo '<meta http-equiv="Refresh" content="0;url=accueil.php">';
              exit();
          }
      }
      else{
          //les donneés sont fausses donc on le redirige vers la page de connexion
          echo '<meta http-equiv="Refresh" content="0;url=index.php?errolog=erreur">';
          exit();
      }

    }  
?>