<?php
/*
*contolleur de client
*/
  define("CHEMINLARGE","images/large/");
  include_once("../web/database/Requetes.class.php");
  include_once("../web/database/baseConf.php");
  include_once("../web/commun/fonctions.php");
  $requete = new Requetes(HOSTNAME, BASENAME, USERNAME, PASSWORD);
  //recuperation des 5 dernières données
  $donnees = $requete->getXDerniereDonnees($_SESSION["user"]["idStructure"],6);
  //recuperation de la structure en fonction de l'indentifiant
  $structure = $requete->getStructurebyid($_SESSION["user"]["idStructure"]);
  define("NOMSTRUCTURE",$structure["nomStructure"]);
  //decomposition en date et heure
  $date=explode(" ",$donnees["0"]["datePhoto"]);
  //formatage de la date en style français
  $laDate=formatDate($date["0"]);
  $_SESSION['donnees']=$donnees;
  miniaturisateur("../web/images/tempo/","../web/images/thumbs/");
?>
