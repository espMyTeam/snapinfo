<?php
	//print_r($_SERVER);
	//$res=json_decode($_POST);
	//echo $_POST['place_id'] . "lol";
	//$data = json_decode()

	if(isset($_POST['geo'])){
		$nom = $_POST['geo']['display_name'];
	  	$city = $_POST['geo']['address']['city'];
		$state = $_POST['geo']['address']['state'];
		$road = $_POST['geo']['address']['road'];
	 	$building = $_POST['geo']['address']['building'];
		$nomQuartier = $_POST['geo']['address']['suburb'];
		$country = $_POST['geo']['address']['country'];

		/* insertion des infos reçus dans la base */
		$longitude = $_POST['recv']['longitude'];	
		$latitude = $_POST['recv']['latitude'];
		$commentaire = $_POST['recv']['commentaire'];
		$typeStructure = $_POST['recv']['typeStructure'];
		$telephone = $_POST['recv']['telephone'];
		$cellID = $_POST['recv']['CellID'];
		$MNC = $_POST['recv']['MNC'];
		$MCC = $_POST['recv']['MCC'];
		$LAC = $_POST['recv']['LAC'];
		$operateur = $_POST['recv']['operateur'];
		$photo = $_POST['recv']['photo'];
		$ladate = date("Y-m-d H:i:s");


		include_once("baseConf.php");
		include_once("requetes.php");	
		$base = new BaseDD(HOSTNAME,BASENAME,USERNAME,PASSWORD);

		$id_struct = $base->selectStruct($nomQuartier, $typeStructure)[0][0];
		$libelleStruct = $base->selectStruct($nomQuartier, $typeStructure)[0][1];
		$id_user = $base->selectUser($telephone);

		if($id_user == 0 || $id_user == -1){
			$id_user = $base->addParamUser($telephone, $cellID, $MNC, $MCC, $LAC, $operateur);
			$id_info = $base->addInfosRecus($photo, $latitude, $longitude, $commentaire, $ladate, $id_user , $id_struct);
			
		}
		else{
			$id_info = $base->addInfosRecus($photo, $latitude, $longitude, $altitude,  $lheure, $ladate, $id_user , $id_struct);

		}

		echo json_encode($_POST);
	}

	
	/**echo "
		<script type=text/javascript>
		    		$.ajax({
		    		   	url : philippe.php,
		    		   	type : POST,
				   		data : 'photo=' + $filePath + '&latitude=' + $latitude + '&longitude=' + $longitude + '&commentaire=' + $commentaire + '&libelle=' + $libelleStruct, 
		    		   	success : function(reponse){ 
	           
		    			},error : function(resultat, statut, erreur){
							alert('La requête n\'a pas abouti');
		    		   	}

		    		});
		</script>
	";*/
?>
