<?php
/*
*contolleur de client
*/


  define("CHEMINLARGE","images/large/");
  define("CHEMINPETIT","images/thumbs/");
  include_once("../web/database/Requetes.class.php");
  include_once("../web/database/baseConf.php");
  include_once("../web/commun/fonctions.php");
  $requete = new Requetes(CLIENTHOSTNAME,CLIENTBASENAME,CLIENTUSERNAME,CLIENTPASSWORD);
  //recuperation des 5 dernières données
  $donnees = $requete->getXDerniereDonnees($_SESSION["user"]["idStructure"],6);
  //recuperation de toutes les données
  $toutesDonnees = $requete->getAllDonnees();
  //recuperation de la structure en fonction de l'indentifiant
  $structure = $requete->getStructurebyid($_SESSION["user"]["idStructure"]);
  define("NOMSTRUCTURE",$structure["nomStructure"]);
  //decomposition en date et heure
  $date=explode(" ",$donnees["0"]["datePhoto"]);
  //formatage de la date en style français
  $laDate=formatDate($date["0"]);
  $_SESSION['donnees']=$donnees; 
  //miniaturiser les images du dossier tempo vers thumbs
  miniaturisateur("../web/images/tempo/","../web/images/thumbs/","../web/images/large/");
?>

<script type="text/javascript">
    var donnees = <?php print_r(json_encode($_SESSION['donnees'])); ?>;
    var structure = <?php print_r(json_encode($structure)); ?>;
    //mise des données dans une variable javascrit afin de mapping
</script>
