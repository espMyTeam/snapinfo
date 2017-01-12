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
		function addInfosRecus($id_infos, $photo, $latitude, $longitude, $altitude,  $lheure, $ladate){
			$req = "INSERT INTO info(id,photo,latitude,longitude,altitude,ladate,heure) VALUES(:id_bus, :photo, :latitude, :longitude, :altitude, :lheure, :ladate);";
			$array_params = array(
				":photo" => $photo,
				":latitude" => $latitude,
				":longitude" => $longitude,
				":altitude" => $altitude,
				":lheure" => $lheure,
				":ladate" => $ladate,
				":id" => $id_infos
			);
			return $this->insert($req, $array_params);
		}

		/*ajouter les paramétres du mobile de l'informateur(utilisateur)*/
		function addParamUser($id_user, $telephone, $cellID, $MNC, $MCC, $LAC, $operateur){
			$req = "INSERT INTO utilisateur(id,telephone,CellID,MNC,MCC,LAC,operateur) VALUES(:id, :telephone, :cellID, :MNC, :MCC, :LAC, :operateur);";
			$array_params = array(
				":telephone" => $telephone,
				":cellID" => $cellID,
				":MNC" => $MNC,
				":MCC" => $MCC,
				":LAC" => $LAC,
				":operateur" => $operateur,
				":id" => $id_user
			);
			return $this->insert($req, $array_params); 
		}
		
		/*ajouter une structure*/
		function addStructure($id_struct, $typeStruture, $libelle, $adresse, $contact1, $contact2, $mail, $latitude, $longitude, $zone){
			$req = "INSERT INTO structure(id,typeStruture,libelle,adresse,contact1,contact2,mail,latitude,longitude,zone) VALUES(:id_struct, :typeStruture, :libelle, :adresse, :contact1, :contact2, :mail, :latitude, :longitude, :zone);";
			$array_params = array(
				":typeStructure" => $typeStructure,
				":libelle" => $libelle,
				":adresse" => $adresse,
				":contact1" => $contact1,
				":contact2" => $contact2,
				":mail" => $mail,
				":latitude" => $latitude,
				":longitude" => $longitude,
				":zone" => $zone,
				":id" => $id_struct 
			);
			return $this->insert($req, $array_params);
		}

		/* selectionner la structure à contacter */
		function selectStruct($nomQuartier, $typeStructure){
			$req = "SELECT id FROM quartier,QS,structure WHERE quartier.id = QS.quartier quartier.nom =:nom_quartier structure.typeStructure = quartier.typeStructure QS.typeStructure =:type";
			$array_params = array(
				":nom_quartier" => $nomQuartier,
				":type" => $typeStructure
			);
			return $this->select($req, $array_params);
		}

	}

?>
