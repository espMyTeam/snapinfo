<?php
/*
*fichier de configuration de requetes vers la base de données
*
*/
Class Requetes
{
    private $base;
    private $hostName;
    private $baseName;
    private $userName;
	  private $password;

	public function __construct($hostName, $baseName, $userName, $password){
  	$this->hostName = $hostName;
		$this->baseName = $baseName;
		$this->userName = $userName;
		$this->password = $password;
		$this->connect();
	}

    private function connect(){
				try{
					$this->base = new PDO('mysql:host='.$this->hostName.';dbname='.$this->baseName.';charset=utf8',$this->userName,$this->password);
				}catch(Exception $e){
					echo $e;
				}
		}

	public	function deconnect(){
			try{
				$this->close();
			}catch(Exception $e){
        echo $e;
			}

		}

    public function authentification($login,$password)
    {
        $result=$this->base->prepare("select * from users where loginUser= :login and passwordUser = :mdpass and supprimer=0");
        $result->execute(array("login"=>$login, "mdpass"=>$password));
        $users=$result->fetch();
        return $users;
    }
    public function getAllStructure($idStructure)
    {
        $result=$this->base->prepare("SELECT * FROM `structures`");
        $result->execute(array());
        $structure=$result->fetchAll();
        return $structure;
    }
    public function getStructurebyid($idStructure)
    {
        $result=$this->base->prepare("SELECT * FROM `structures` where idStructure= :idStructure");
        $result->execute(array("idStructure"=>$idStructure));
        $structure=$result->fetch();
        return $structure;
    }
    public function putStructure($nomStructure,$latitude,$longitude)
    {
        $result=$this->base->prepare("INSERT INTO `structures` (`idStructure`, `nomStructure`, `latitude`, `longitude`) VALUES (NULL, :nomStructure,:latitude,:longitude)");
        $result->execute(array("nomStructure"=>$nomStructure,
                               "latitude"=>$latitude,
                               "longitude"=>$longitude));
    }
    public function updateStructure($nomStructure,$latitude,$longitude,$id)
    {   
        $result=$this->base->prepare("UPDATE `structures` SET `nomStructure`=:nomStructure, `latitude`=:latitude, `longitude`=:longitude WHERE `idStructure` = :id");
        $result->execute(array("nomStructure"=>$nomStructure,
                               "latitude"=>$latitude,
                               "longitude"=>$longitude,
                               "id"=>$id));
    }
    public function deleteStructure($id)
    {
        $result=$this->base->prepare("DELETE FROM `structures` WHERE `structures`.`idStructure` = :id");
        $result->execute(array("id"=>$id));
    }
    public function putDonnees($donnees)
    {
        $result=$this->base->prepare("INSERT INTO `donnees` (`idDonnees`, `idStructure`, `photo`, `longitude`, `latitude`, `lieu`, `datePhoto`, `commentaire`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result->execute($donnees);
    }
    /*public function putDonnees($nomStructure)
    {
        $result=$this->base->prepare("INSERT INTO `donnees` (`idDonnees`, `idStructure`, `photo`, `longitude`, `latitude`, `lieu`, `datePhoto`, `commentaire`) VALUES (NULL, :idStructure, :photo, :longitude , :latitude, :lieu, :datePhoto, :commentaire)");
        $result->execute(array("idStructure"=>$nomStructure,
                               "photo"=>$nomStructure,
                               "longitude"=>$nomStructure,
                               "latitude"=>$nomStructure,
                               "lieu"=>$nomStructure,
                               "datePhoto"=>$nomStructure,
                               "commentaire"=>$nomStructure));
    }*/
    public function getXDerniereDonnees($idStructure,$limite)
    {
      $result=$this->base->prepare("SELECT * FROM `donnees` where idStructure = :idStructure order by idDonnees desc limit ".$limite."");
      $result->execute(array("idStructure"=>$idStructure));
      $donees=$result->fetchAll();
      return $donees;
    }
}
