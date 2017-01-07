<?php
// Générateur de miniatures
function make_thumb($src,$dest,$desired_width) {

  // Ouverture de l'image
  $source_image = imagecreatefromjpeg($src);
  $width = imagesx($source_image);
  $height = imagesy($source_image);

  // Trouver la hauteur désiré pour la miniature, en fonction de sa largeur
  $desired_height = floor($height*($desired_width/$width));

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

// Récupère l'extension du fichier
function get_file_extension($file_name) {
  return substr(strrchr($file_name,'.'),1);
}
?>
