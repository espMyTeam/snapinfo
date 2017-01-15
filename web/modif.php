<?php
  session_start();
  ob_start();
  if(!isset($_SESSION["user"]) || $_SESSION["user"]["idStructure"]>1)
  {
      header("Location:../web/index.php?errolog=folie");
       exit();
  }
  define("NOMPAGE", "Accueil");
  include_once("commun/controlleurAdmin.php");
  include_once("menu.php");
?>
    <!-- row-->
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($structures as $key => $value) {if($key!=0){?>
                        <tr>
                            <td><?php echo $key;?></td>
                            <td><?php echo $value["nomStructure"]; ?></td>
                            <td><?php echo $value["longitude"]; ?></td>
                            <td><?php echo $value["latitude"]; ?></td>
                            <td><?php echo '<button type="button" class="btn btn-default btn-circle" onclick="envoieDeleteStructure('.$key.');"><i class="fa fa-trash"></i>';?></td>
                        </tr>
                      <?php }}?>
                    </tbody>
                </table>
            </div>
          </div>
          <div class="panel-body-map">
            <img src=""/>
          </div>
        </div>
     </div>
   </div>


        <!-- /. row -->

        <!-- /.row -->
<!-- fin de l'autre row-->

<?php
  include_once("menuBas.php");
?>
<script type="text/javascript" src="js/envoie.js"></script>
