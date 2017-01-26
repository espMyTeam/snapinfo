<?php
	//$file_path = "uploads/";
	//print_r($_FILES);
	//echo "\n";
    if(isset($_FILES) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['typeStructure']) &&  isset($_POST['telephone'])){
		
 			$_POST['photo'] = $filePath;

		/* enregistrement de la photo dans un répertoire nommé uploads*/
	    	$fileName = basename( $_FILES['photo']['name']);
	    	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
	    	$taille = filesize($_FILES['photo']['tmp_name']);
	    	
	        $filePath = strtr($fileName, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	        $filePath = preg_replace('/([^.a-z0-9]+)/i', '-', $filePath);
	        $filePath = "../uploads/$filePath";

		    if(move_uploaded_file($_FILES['photo']['tmp_name'], $filePath) ){
		    	
		        //echo "success";
				
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
						 	data: { format:'json', lat: <?php echo $_POST['latitude']; ?>, lon: <?php echo $_POST['longitude']; ?>, zoom: zoom , addressdetails:1 },
					        contentType: 'application/json; charset=utf-8',
						 	dataType: 'json'
			    		}).then(function(data) {
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
