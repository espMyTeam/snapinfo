<?php
/*
*contolleur de client
*/
  define("CHEMINLARGE","images/large/");
  include_once("../web/database/Requetes.class.php");
  include_once("../web/database/baseConf.php");
  include_once("../web/commun/fonctions.php");
  $requete = new Requetes(HOSTNAME, BASENAME, USERNAME, PASSWORD);
  //recuperation de la structure en fonction de l'indentifiant
  $structure = $requete->getStructurebyid($_SESSION["user"]["idStructure"]);
  //recuperation de la liste de toutes les structuresgetAllStructure($idStructure)
  $structures = $requete->getAllStructure();
  define("NOMSTRUCTURE",$structure["nomStructure"]);
  if($_REQUEST["action"]=="ajouter"){
    $requete->putStructure($_REQUEST["nomStruct"],$_REQUEST["latStruct"],$_REQUEST["longStruct"]);
  }else if($_REQUEST["action"]=="modifier"){
    $requete->updateStructure($_REQUEST["nomStruct"],$_REQUEST["latStruct"],$_REQUEST["longStruct"],$_REQUEST["idStruct"]);
  }
?>
