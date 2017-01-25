<?php
	//$file_path = "uploads/";
	//print_r($_FILES);
	//echo "\n";
    if(isset($_FILES) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['typeStructure']) &&  isset($_POST['telephone'])){

		

		/* enregistrement de la photo dans un répertoire nommé uploads*/
	    	$fileName = basename( $_FILES['photo']['name']);
	    	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
	    	$taille = filesize($_FILES['photo']['tmp_name']);
	    	
	        $filePath = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	        $filePath = preg_replace('/([^.a-z0-9]+)/i', '-', $filePath);
	        $filePath = "../uploads/$filePath";

		    if(move_uploaded_file($_FILES['photo']['tmp_name'], $filePath) ){
		    	
		        //echo "success";
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
				$_POST['photo'] = $filePath;
				//$ladate = date("Y-m-d H:i:s");
				
				$nomQuartier=" ";
				?>
				<script type='text/javascript' src='../web/jquery/jquery.js'></script>
				<script type=text/javascript>
					/*
					* trouver l'emplacement correspondant à l'adresse latitude et longitude
					*/	
					var zoom=18;
					var datas;
					if(zoom != undefined && zoom > 0 && zoom <22){
						$.ajax({
			       			url: 'http://nominatim.openstreetmap.org/reverse',
			        		method: 'GET',
						 	data: { format:'json', lat: <?php echo "$latitude" ?>, lon: <?php echo "$longitude" ?>, zoom: zoom , addressdetails:1 },
					        contentType: 'application/json; charset=utf-8',
						 	dataType: 'json'
			    		}).then(function(data) {
			       			//console.log(data);
			       			/*$nom = data.display_name;
			     		  	$city = data.address.city;
			       			$state = data.address.state;
			       			$road = data.address.road;
			      		 	$building = data.address.building;
			       			$nomQuartier = data.address.suburb;
			       			$country = data.address.country;*/
			       			//console.log(data);
			       			/*<?php
			       				//echo json_decode(data);
			       			?>*/
			       			$.ajax({
				       			url: './traitement_insert.php',
				        		method: 'POST',
							 	data: {geo: data, recv: <?php echo json_encode($_POST); ?> },
						        //contentType: 'application/json; charset=utf-8',
							 	//dataType: 'json'
				    		}).then(function(dat){
				    			console.log(dat);
				    		});

						});
					}
				</script>

				<?php

				

		    } else{
		        echo "fail";
		    }
		
    } 
    else{
    	echo "Service inconnu.Merci de revoir votre demande.";
    }
    

?>
