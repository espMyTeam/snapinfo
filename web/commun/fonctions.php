<?php
/*
*Author:Philippe Kolama GUILAVOGUI
**/
  //fonction de calcul d'age
	function age($date){
		$now=date("Y-m-d");
    $diffjour=floor((strtotime($now)-strtotime($date))/86400);
    if ($diffjour<30){
        $jour=$diffjour." jours";
    }
    else if($diffjour<30*24){
        $moiss=floor($diffjour/30)." mois";
				$jour=floor($diffjour%30)." jours";

    }
    else{
		  $an=floor($diffjour/(365))." ans";
		  $jourrestant=floor($diffjour%(365));
		  $moiss=floor($jourrestant/30)." mois";
		  $jour=floor($jourrestant%30)." jours";
    }
        return $an." ".$moiss;
	}
	//fonction de formatage de date
	function formatDate($date){
		$ladate=explode("-",$date);
		return $ladate[2]."/".$ladate[1]."/".$ladate[0];
	}
	//fonction de formatage de dateHeure
	function formatDateHeure($date){
		$donnees=explode(" ",$date);
		$ladate=explode("-",$donnees[0]);
		return $ladate[2]."/".$ladate[1]."/".$ladate[0]." ".$donnees[1];
	}
	// Générateur de miniatures
	function make_thumb($src,$dest,$desired_height) {
  // Ouverture de l'image
  $source_image = imagecreatefromjpeg($src);
  $width = imagesx($source_image);
  $height = imagesy($source_image);

  // Trouver la hauteur désirée pour la miniature, en fonction de sa largeur
  	//$desired_height = floor($height*($desired_width/$width));
	$desired_width = floor($width*($desired_height/$height));

  // Créer une nouvelle image (virtuelle)
  $virtual_image = imagecreatetruecolor($desired_width,$desired_height);

  // Copie de l'image source à la taille désirée
  imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);

  // Créer physiquement l'image dans le répertoire de destination
  imagejpeg($virtual_image,$dest);
}

// On récupère les fichiers depuis le répertoire source
function get_files($images_dir,$exts = array('jpg')) {
  $files = array();
  if($handle = opendir($images_dir)) {
    while(false !== ($file = readdir($handle))) {
      $extension = strtolower(get_file_extension($file));
      if($extension && in_array($extension,$exts)) {
        $files[] = $file;
      }
    }
    closedir($handle);
  }
  return $files;
}
// Récupère l'extension du fichierf
function get_file_extension($file_name) {
  return substr(strrchr($file_name,'.'),1);
}
//creer miniature
function miniaturisateur($images_dir,$thumbs_dir){//dossier source et dossier de destination

		// Largeur des miniatures
		$thumbs_width = 100;

		// Récupération de la liste des images
		$image_files = get_files($images_dir);

		// S'il y a au moins 1 image on rentre dans le script
		if(count($image_files)) {
		  $index = 0;

		  // Traitement des images
		  foreach($image_files as $index=>$file) {
		    $index++;
		    $thumbnail_image = $thumbs_dir.$file;

		    if(!file_exists($thumbnail_image)) {
		      $extension = get_file_extension($thumbnail_image);//recupération de l'extension du fichier

		      // Si l'extension est reconnue alors on génère la miniature
		      if($extension) {
		        make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
		      }
		    }
		  }
		}
}
?>
