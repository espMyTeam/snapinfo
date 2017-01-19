<?php
	$file_path = "uploads/";
    if(isset($_FILES) && $_POST['latitude'] != "" && $_POST['longitude'] != "" && $_POST['typeStructure'] != "" $_POST['telephone'] != "" && file_exists("baseConf.php") && file_exists("requetes.php")){

	include_once("baseConf.php");
	include_once("requetes.php");	

	$base = new BaseDD(HOSTNAME,BASENAME,USERNAME,PASSWORD);

	/* enregistrement de la photo dans un répertoire nommé uploads*/
    	$fileName = basename( $_FILES['photo']['name']);
    	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
    	$taille = filesize($_FILES['photo']['tmp_name']);
    	
        $filePath = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $filePath = preg_replace('/([^.a-z0-9]+)/i', '-', $filePath);
        $filePath = "uploads/$filePath";

	    if(move_uploaded_file($_FILES['photo']['tmp_name'], $filePath) ){
	    	
	        echo "success";
	    } else{
	        echo "fail" . $_FILES['photo']['name'];
	    }
	/* insertion des infos reçus dans la base */
	$longitude = $_POST['longitude'];	
	$latitude = $_POST['latitude'];
	$commentaire = $_POST['commentaire'];
	$typeStructure = $_POST['typeStructure'];
	$telephone = $_POST['telephone'];
	$cellID = $_POST['CellID'];
	$MNC = $_POST['MNC'];
	$MCC = $_POST['MCC'];
	$LAC = $_POST['LAC'];
	$operateur = $_POST['operateur'];
	$ladate = date("Y-m-d H:i:s");
	
	$nomQuartier=" ";
	<script type=text/javascript>
		/*
		* trouver l'emplacement correspondant à l'adresse latitude/longitude
		*/	
		$zoom=18;
		if(zoom != undefined && zoom > 0 && zoom <22){
			$.ajax({
       			 url: "http://nominatim.openstreetmap.org/reverse",
        		 method: "GET",
			 data: { format:"json", lat:$latitude, lon:$longitude, zoom:$zoom , addressdetails:1 },
		         contentType: "application/json; charset=utf-8",
			 dataType: "json"
    			}).then(function(data) {
       			console.log(data);
       			$nom = data.display_name;
     		  	$city = data.address.city;
       			$state = data.address.state;
       			$road = data.address.road;
      		 	$building = data.address.building;
       			$nomQuartier = data.address.suburb;
       			$country = data.address.country;
			});
		}
	</script>
	$id_struct = $base->selectStruct($nomQuartier, $typeStructure)[0][0];
	$libelleStruct = $base->selectStruct($nomQuartier, $typeStructure)[0][1];
	$id_user = $base->selectUser($telephone);
	if($id_user == 0){
		$id_user = $base->addParamUser($telephone, $cellID, $MNC, $MCC, $LAC, $operateur);
		$id_info = $base->addInfosRecus($photo, $latitude, $longitude, $altitude,  $lheure, $ladate, $id_user , $id_struct);
	}
	else{
		$id_info = $base->addInfosRecus($photo, $latitude, $longitude, $altitude,  $lheure, $ladate, $id_user , $id_struct);
	}
?>
	/*Envoi des données à la structure concernée*/
		<form id="my_form" method="post" action="philippe.php" enctype="multipart/form-data">
			<input type="file" name="photo" accept="<?php $filePath ?>">    			
			<input type="text" name="latitude" value ="<?php $latitude ?>">
			<input type="text" name="longitude" value ="<?php $longitude ?>">
			<input type="text" name="commentaire" value ="<?php $commentaire ?>">
		</form>
<?php
	<script type=text/javascript>
		$(function () {
       		 var $form = $('#my_form');
       		 var formdata = (window.FormData) ? new FormData($form[0]) : null;
       		 var data = (formdata !== null) ? formdata : $form.serialize();
	    		$.ajax({
	    		   url : $form.attr('action'),
	    		   type : $form.attr('method'),
			   contentType: false, // obligatoire pour de l'upload
            		   processData: false, // obligatoire pour de l'upload
	    		   dataType : 'html',
			   data : data, // On fait passer nos variables
	    		   success : function(reponse){ // success est toujours en place, bien sûr !
           
	    		   },

	    		   error : function(resultat, statut, erreur){
				alert('La requête n\'a pas abouti');
	    		   }

	    		});
		});
	</script>
    } 
    else{
    	echo "mdrrr";
    }
    

?>
