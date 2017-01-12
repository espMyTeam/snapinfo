<?php
function traiteImage($chemin)
{
    $image = fopen($chemin,"r+");
    echo "<img src='".$chemin."'>";
    print_r($chemin);
    /*
    if (!empty($_POST['InsererNews']))
    {
            $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg');
            $ListeExtensionIE = array('jpg' => 'image/pjpeg', 'jpeg'=>'image/pjpeg');
            if (!empty($_POST['TitreNews']) && (!empty($_FILES['ImageNews'])) && (!empty($_POST['ContenuNews'])))
            {
                    $TitreNews = $_POST['TitreNews'];
                    $ContenuNews = $_POST['ContenuNews'];

                    if ($_FILES['ImageNews']['error'] <= 0)
                    {
                            if ($_FILES['ImageNews']['size'] <= 2097152)
                            {
                                $ImageNews = $_FILES['ImageNews']['name'];

                                $ExtensionPresumee = explode('.', $ImageNews);
                                $ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
                                if ($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg')
                                {
                                  $ImageNews = getimagesize($_FILES['ImageNews']['tmp_name']);
                                  if($ImageNews['mime'] == $ListeExtension[$ExtensionPresumee]  || $ImageNews['mime'] == $ListeExtensionIE[$ExtensionPresumee])
    {

                                                  $ImageChoisie = imagecreatefromjpeg($_FILES['ImageNews']['tmp_name']);
                                                  $TailleImageChoisie = getimagesize($_FILES['ImageNews']['tmp_name']);
                                                  $NouvelleLargeur = 350; //Largeur choisie à 350 px mais modifiable

                                                  $NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );

                                                  $NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");

                                                  imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
                                                  imagedestroy($ImageChoisie);
                                                  $NomImageChoisie = explode('.', $ImageNews);
                                                  $NomImageExploitable = time();

                                                  imagejpeg($NouvelleImage , 'imagesnews/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);
                                                  $LienImageNews = 'imagesnews/'.$NomImageExploitable.'.'.$ExtensionPresumee;

                                                  $sql= 'INSERT INTO votre_table VALUES ("", "'.$TitreNews.'", "'.$ContenuNews.'", "'.$LienImageNews.'", "'.time().'")';
                                                  $res = mysql_query($sql) or die(mysql_error());
                                                  if ($res)
                                                  {
                                                          echo 'La news a bien été insérée';
                                                  }
                                            }
                                            else
                                            {
                                                    echo 'Le type MIME de l\'image n\'est pas bon';
                                            }
                                    }
                                    else
                                    {
                                            echo 'L\'extension choisie pour l\'image est incorrecte';
                                    }
                            }
                            else
                            {
                                    echo 'L\'image est trop lourde';
                            }
                    }
                    else
                    {
                            echo 'Erreur lors de l\'upload image';
                    }
            }
            else
            {
                    echo 'Au moins un des champs est vide';
            }*/
    }
traiteImage("../images/12.jpg");
?>
