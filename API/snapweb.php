<?php
//les données reçues --- photo-latitude-longitude-commentaire-libelle-idStructure
    //Connexion à la base de données  
        //include_once("../server/baseConf.php");//connexion base serveur
        //include_once("../server/requetes.php");//lien requetes base serveur
        //----- Vers client -------
        include_once("../web/database/baseConf.php");//connexion base client
        include_once("../web/database/Requetes.class.php");//lien requetes base client
        //----- Vers les fonctions utiles ------
        include_once("../web/commun/fonctions.php");
        //----- Instanciation des objets de base de données
        $requete = new Requetes(CLIENTHOSTNAME,CLIENTBASENAME,CLIENTUSERNAME,CLIENTPASSWORD);
        $reqServeur = new BaseDD(HOSTNAME,BASENAME,USERNAME,PASSWORD);
    //Fin connexion à la base de données
    //recuperation et insertion de la requete dans la base de données
        
try {

	switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':        
                $requete->putDonnees($_REQUEST("idStructure"),$_REQUEST("photo"),$_REQUEST("longitude"),$_REQUEST("longitude"),$_REQUEST("latitude"),$_REQUEST("lieu"),$_REQUEST("datePhoto"),$_REQUEST("commentaire"));
                break;
            default:
                echo "rien!!!";
                break;

        }
    }
catch (Exception $e) {
		erreur($e->getMessage());
}