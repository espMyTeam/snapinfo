<?php
  define("NOMPAGE", "Accueil");
  define("ENTETEPAGE", "Entete");
  include_once("../database/baseConf.php");
  include_once("../database/Requetes.class.php");
  include_once("menu.php");
?>

<!-- une autre row -->

<!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="" alt="">
            </div>

            <div class="col-md-4">
                <h3>Infos sur la photo</h3>
                <ul>
                    <li>Lieu de prise</li>
                    <li>date de prise</li>
                    <li>heure de prise</li>
                    <li>Distance en km</li>
                </ul>
                <h3>Commentaire de l'auteur</h3>
                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
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

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->
<!-- fin de l'autre row-->

<?php
  include_once("menuBas.php");
?>
