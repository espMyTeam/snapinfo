<?php
	//controleur frontal
	try {

		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				if(isset($_GET['ressource'])) {
			    	if ($_GET['ressource'] == 'info') { 
			      		if(isset($_GET['id'])){ //selectionne l'info d'identifiant id

			      		}
			      		else{ //tous les infos ajoutées

			      		}
			    	}
			    	else if ($_GET['ressource'] == 'structure') {
			      
			    	}
			    	else
			      		throw new Exception("Action non valide");
			  	}
			  	else {
			    	// action par défaut
			  	}
				break;

			case 'POST':
				
				break;

			case 'PUT':
				
				break;

			case 'DELETE':
				
				break; 

			default:
				
				break;
		}
	}
	catch (Exception $e) {
	    erreur($e->getMessage());
	}
?>