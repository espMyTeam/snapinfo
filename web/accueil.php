<?php
  session_start();
  ob_start();
  if(!isset($_SESSION["user"]) || $_SESSION["user"]["idStructure"]<2)
  {
      header("Location:../web/index.php?errolog=folie");
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
                <img class="img-responsive"  <?php echo'src="'.CHEMINLARGE.$donnees["0"]["photo"].'"';?> alt="photo à la une">
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
          <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                  Lieu de prise carte
              </div>
              <div class="panel-body-map">
                <!--<iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2710.207049454749!2d-1.5729033!3d47.2125309!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805ec0fcda6c4cb%3A0xd620ca38dafa1e9a!2s2+Rue+La+Motte+Picquet%2C+44100+Nantes!5e0!3m2!1sfr!2sfr!4v1423244007186" width="600" height="450" frameborder="0"></iframe>-->
                <!--la carte--> <div id="map" frameborder="0"></div> <!--la carte-->
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
                            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="backgroud-color:rgba(255,255,255,0)" height="700" scrolling="yes" src="htmlmarkup.php" width="100%"></iframe>
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
<!-- MAPPING SCRIPTS  -->
<script  type="text/javascript" src="jquery/jquery.js"></script>
<script  type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="leaflet/leaflet-src.js"></script>
<script type="text/javascript" src="leaflet/leaflet-realtime.js"></script>
<script type="text/javascript" src="js/mapping.js"></script><!--le script qui ajoute des donnees à la carte-->
