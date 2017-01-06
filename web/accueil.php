<?php
  session_start();
  ob_start();
  if(!isset($_SESSION["user"]) || $_SESSION["user"]["idStructure"]<2)
  {
      header("Location:../web/index.php");
       exit();
  }
  define("NOMPAGE", "Accueil");
  define("ENTETEPAGE", "Entete");
  include_once("commun/controlleurClient.php");
  include_once("menu.php");
?>

<!-- une autre row -->

<!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive"  <?php echo'src="'.$donnees["0"]["photo"].'"';?> alt="photo à la une">
            </div>

            <div class="col-md-4">
                <h3>Infos sur la photo</h3>
                <ul>
                    <li><?php echo $donnees["0"]["lieu"];?></li>
                    <li><?php echo $laDate;?></li>
                    <li><?php echo $date["1"];?></li>
                    <li><?php echo $donnees["0"]["distance"];?></li>
                </ul>
                <h3>Commentaire de l'auteur</h3>
                <p class="text-justify"> <?php echo $donnees["0"]["commentaire"];?> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
            </div>

        </div>
        <!-- /.row -->
        <br/>
        <!-- row-->
        <div class="row">
          <div class="col-lg-8 col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                  Lieu de prise carte
              </div>
              <div class="panel-body-map">
                <img src=""/>
              </div>
            </div>
         </div>
       </div>


        <!-- /. row -->


        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Photos précédentes</h3>
            </div>
            <!-- slide bas -->
            <div class="container">
                <div class="main">
                        <div >
                            <iframe height="700" scrolling="yes" src="demo_htmlmarkup.php" width="100%"></iframe>
                        </div>
                </div>
            </div>
            <!-- /container -->

        </div>
        <!-- /.row -->
<!-- fin de l'autre row-->

<?php
  include_once("menuBas.php");
?>
