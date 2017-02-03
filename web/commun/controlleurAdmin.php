<?php
/*
*contolleur de client
*/
  define("CHEMINLARGE","images/large/");
  //----- Vers serveur ------
  include_once("../server/baseConf.php");//connexion base serveur
  include_once("../server/requetes.php");//lien requetes base serveur
  //----- Vers client -------
  include_once("../web/database/baseConf.php");//connexion base client
  include_once("../web/database/Requetes.class.php");//lien requetes base client
  //----- Vers les fonctions utiles ------
  include_once("../web/commun/fonctions.php");
  //----- Instanciation des objets de base de données
  $requete = new Requetes(CLIENTHOSTNAME,CLIENTBASENAME,CLIENTUSERNAME,CLIENTPASSWORD);
  $reqServeur = new BaseDD(HOSTNAME,BASENAME,USERNAME,PASSWORD);
  //recuperation de la structure en fonction de l'indentifiant
  $structure = $requete->getStructurebyid($_SESSION["user"]["idStructure"]);
  //recuperation de la liste de toutes les structures
  $structures = $requete->getAllStructure();
  //recuperation de la liste de tous les types de structure
  $types = $reqServeur->recupTypeStructure();
  $types2=$types;
  define("NOMSTRUCTURE",$structure["nomStructure"]);

  if($_REQUEST["action"]=="ajouter"){
      if(isset($_REQUEST["type"]) and isset($_REQUEST["nomStruct"]) and isset($_REQUEST["adresse"]) and isset($_REQUEST["contact1"]) and isset($_REQUEST["contact2"]) and isset($_REQUEST["mail"]) and isset($_REQUEST["latStruct"]) and isset($_REQUEST["longStruct"]) and isset($_REQUEST["zone"])){
        //ajout de la structure sur le serveur
        $reqServeur->addStructure($_REQUEST["type"],$_REQUEST["nomStruct"],$_REQUEST["adresse"],$_REQUEST["contact1"],$_REQUEST["contact2"],$_REQUEST["mail"],$_REQUEST["latStruct"],$_REQUEST["longStruct"]);
        //ajout de la stucture chez le client
        $requete->putStructure($_REQUEST["nomStruct"],$_REQUEST["latStruct"],$_REQUEST["longStruct"]);
      }else{
        echo'<script>alert("toutes les valeurs ne sont pas insérées");</script>';
      }
  }
  else if($_REQUEST["action"]=="modifier"){
    $requete->updateStructure($_REQUEST["nomStruct"],$_REQUEST["latStruct"],$_REQUEST["longStruct"],$_REQUEST["idStruct"]);
  }
  else if($_REQUEST["action"]=="supprimer"){
    $requete->deleteStructure($_REQUEST["idStruct"]);
  }
  else if($_REQUEST["action"]=="ajouterUser"){
    $requete->putUser($_REQUEST["nomUser"],$_REQUEST["prenomUser"],$_REQUEST["loginUser"],$_REQUEST["passwdUser"],$_REQUEST["telUser"],$_REQUEST["mailUser"],"photo indefinie",$_REQUEST["StructUser"]);
  }
  else if($_REQUEST["action"]=="ajouterType"){
    $reqServeur->addTypeStructure($_REQUEST["typeStructure"]);
  }
  else if($_REQUEST["action"]=="ajouterQuartier"){
    //ajout du quartier
    $reqServeur->addNewQuartier($_REQUEST["nomQuartier"]);
    //recuperation de l'id du dernier quartier
    $idQuartier=$reqServeur->getLastidQuartier();
    //associer le quartier à la structure
    $reqServeur->addNewStructutreQuartier($idQuartier["id"],$_REQUEST["structure"],$_REQUEST["typeStructure"]);
    
    
  }
  
?>
