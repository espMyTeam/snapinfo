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

<!-- une autre row -->

<!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-12">
              <div class="row">

                 <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-one" data-toggle="modal" data-target="#ajouter">
                        <i  class="fa fa-plus dashboard-div-icon" ></i>

                         <h5>Ajouter une structure </h5>
                    </div>
                    <div class="modal fade" id="ajouter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Ajouter une structure</h4>
                                </div>
                                <div class="modal-body">

                                  <form>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nom structure</label>
                                      <input type="text" class="form-control" id="addNomStructure" placeholder="Saisir le nom de la structure" />
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Longitude</label>
                                      <input type="text" class="form-control" id="addLongStructure" placeholder="Saisir sa longitude" />
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Latitude</label>
                                      <input type="text" class="form-control" id="addLatStructure" placeholder="Saisir sa latitude" />
                                    </div>
                                  </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="envoieEnregStructure();">Valider</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- debut autre panel-->
                 <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-two" data-toggle="modal" data-target="#myModal">
                        <i  class="fa fa-edit dashboard-div-icon" ></i>

                         <h5>Modifier une structure </h5>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Liste des structures</h4>
                                </div>
                                <div class="modal-body">
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
                                                  <td><?php echo $value["nomStructure"];?></td>
                                                  <td><?php echo $value["longitude"];?></td>
                                                  <td><?php echo $value["latitude"];?></td>
                                                  <td><?php echo '<button type="button" class="btn btn-default btn-circle"><i class="fa fa-pencil"></i>';?></td>
                                              </tr>
                                            <?php }}?>
                                          </tbody>
                                      </table>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- debut autre panel-->
                 <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper bk-clr-three" data-toggle="modal" data-target="#myModal">
                        <i  class="fa fa-minus dashboard-div-icon" ></i>

                         <h5>Supprimer une structure </h5>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Modal title Here</h4>
                                </div>
                                <div class="modal-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- debut autre panel-->
                <div class="col-md-3 col-sm-3 col-xs-6">
                   <div class="dashboard-div-wrapper bk-clr-four" data-toggle="modal" data-target="#myModal">
                       <i  class="fa fa-cogs dashboard-div-icon" ></i>

                        <h5>Simple Text Here </h5>
                   </div>
                   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                   <h4 class="modal-title" id="myModalLabel">Modal title Here</h4>
                               </div>
                               <div class="modal-body">
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   <button type="button" class="btn btn-primary">Save changes</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

                </div>

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
<script type="text/javascript" src="js/envoie.js"></script>
