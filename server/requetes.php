<?php

	/* classe de base pour les requetes aux bases de données */
	Class BaseDD{
		private $base;
		public $running = False;
		private $baseName;
		private $userName;
		private $password;
		private $hostName;


		public function __construct($hostName, $baseName, $userName, $password){
			$this->baseName = $baseName;
			$this->userName = $userName;
			$this->hostName = $hostName;
			$this->password = $password;
			$this->connect();
		}

		/*
			connexion à la base
		*/
		private function connect(){

				$req1 = "mysql:host=" . $this->hostName . ";dbname=" . $this->baseName . "";
				$req2 = "SET NAMES UTF8";

				try{
					$this->base = new PDO($req1, $this->userName, $this->password);
					$req = $this->base->prepare($req2);
					$req->execute();
					$this->running = True;

				}catch(Exception $e){
					$this->running = False;
				}
		}

		function deconnect(){
			try{
				$this->close();
				$this->running = False;
			}catch(Exception $e){

			}

		}

		/* requete de selection */
		private function select($req, $array_params, $methode=PDO::FETCH_NUM){
			$req = $this->base->prepare($req);
			$req->execute($array_params);
			return $req->fetchall($methode);
		}

		/* requete d'insertion */
		private function insert($req, $array_params){
			$req = $this->base->prepare($req);
			$req->execute($array_params);
			return $this->base->lastInsertId();
		}

		private function update($req, $array_params){
			$req = $this->base->prepare($req);
			$req->execute($array_params);
		}

		private function delete($req, $array_params){
			$req = $this->base->prepare($req);
			$req->execute($array_params);
		}


		/*
			fonctions associées à la base de données
		*/
		/* ajouter les infos reçus*/
		function addInfosRecus($photo, $latitude, $longitude, $commentaire, $ladate, $utilisateur, $typeStructure){
			$req = "INSERT INTO info(photo,latitude,longitude,commentaire,ladate,utilisateur,typeStructure) VALUES(:photo, :latitude, :longitude, :altitude, :lheure, :ladate, :utilisateur, :typeStructure);";
			$array_params = array(
				":photo" => $photo,
				":latitude" => $latitude,
				":longitude" => $longitude,
				":altitude" => $altitude,
				":lheure" => $lheure,
				":ladate" => $ladate,
				":utilisateur" => $utilisateur,
				":typeStructure" => $typeStructure
			);
			return $this->insert($req, $array_params);
		}

		/*ajouter les paramétres du mobile de l'informateur(utilisateur)*/
		function addParamUser($telephone, $cellID, $MNC, $MCC, $LAC, $operateur){
			$req = "INSERT INTO utilisateur(telephone,CellID,MNC,MCC,LAC,operateur) VALUES(:telephone, :cellID, :MNC, :MCC, :LAC, :operateur);";
			$array_params = array(
				":telephone" => $telephone,
				":cellID" => $cellID,
				":MNC" => $MNC,
				":MCC" => $MCC,
				":LAC" => $LAC,
				":operateur" => $operateur
			);
			return $this->insert($req, $array_params);
		}

		/*ajouter une structure*/
		function addStructure($typeStructure, $libelle, $adresse, $contact1, $contact2, $mail, $latitude, $longitude, $zone){
            $result=$this->base->prepare("INSERT INTO `structure` (`typeStructure`, `libelle`, `adresse`, `contact1`, `contact2`, `mail`, `latitude`, `longitude`, `zone`) VALUES (:typeStruct, :libelle, :adresse, :contact1, :contact2, :mail, :latitude, :longitude,:laZone)");
            $result->execute(array(
                "typeStruct" => $typeStructure,
                "libelle" => $libelle,
                "adresse" => $adresse,
                "contact1" => $contact1,
                "contact2" => $contact2,
                "mail" => $mail,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "laZone" => $zone
            ));
		}

		/* selectionner la structure à contacter */
		function selectStruct($nomQuartier, $typeStructure){
			$req = "SELECT id,libelle FROM quartier,QS,structure WHERE quartier.id = QS.quartier quartier.nom =:nom_quartier structure.typeStructure = quartier.typeStructure QS.typeStructure =:type";
			$array_params = array(
				":nom_quartier" => $nomQuartier,
				":type" => $typeStructure
			);
			return $this->select($req, $array_params);
		}

		/*ajouter un nouveau type de structure*/
		function addTypeStructure($typeStruture){
			$result=$this->base->prepare("INSERT INTO `typeStructure` (`id`, `nomStructure`) VALUES (NULL, :typeStructure)");
			$result->execute(array("typeStructure" => $typeStruture));
			$result->closeCursor();
		}

		/*recuperer les types de structures*/
		function recupTypeStructure(){
			$result=$this->base->prepare("SELECT * FROM `typeStructure`");
			$result->execute(array());
			$types=$result->fetchAll();
		  $result->closeCursor();
		  return $types;
		}
		/*recuperer dernières structures*/
		function recupDernierTypeStructure(){
			$result=$this->base->prepare("SELECT * FROM `typeStructure` order by `id` desc limit 1");
			$result->execute(array());
			$type=$result->fetch();
		  $result->closeCursor();
		  return $type;
		}

		/* selectionner les images  */
		function selectUser($nomQuartier, $typeStructure){
			$req = "SELECT id,libelle FROM quartier,QS,structure WHERE quartier.id = QS.quartier quartier.nom =:nom_quartier structure.typeStructure = quartier.typeStructure QS.typeStructure =:type";
			$array_params = array(
				":nom_quartier" => $nomQuartier,
				":type" => $typeStructure
			);
			return $this->select($req, $array_params);
		}
}

?>
