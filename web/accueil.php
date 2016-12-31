<?php
  define("NOMPAGE", "Accueil");
  define("ENTETEPAGE", "Entete");
  include_once("menu.php");
?>

            <div class="row">
        		    <div class="col-lg-9 col-md-12">
        					<div class="panel panel-default">
        						<div class="panel-heading">
                        Info à la une
        						</div>
        						<div class="panel-body-map">
        							<img src=""/>
        						</div>

        					</div>
        				</div>
                <div class="col-md-3">
                      <!-- List starts -->
          				<ul class="today-datas">
                          <!-- List #1 -->
          				<li>
                            <!-- Graph -->
                            <div><span id="todayspark1" class="spark"></span></div>
                            <!-- Text -->
                            <div class="datas-text">infos sur la photo</div>
                          </li>
                          <li>
                            <div><span id="todayspark2" class="spark"></span></div>
                            <div class="datas-text">infos sur le lieu de prise</div>
                          </li>
                          <li>
                            <div><span id="todayspark3" class="spark"></span></div>
                            <div class="datas-text">heure de prise</div>
                          </li>
                          <li>
                            <div><span id="todayspark3" class="spark"></span></div>
                            <div class="datas-text">Voir les autres photos</div>
                          </li>
                        </ul>
                    </div>
           </div>

		  <!-- Fin de la row -->

      <div class="row">
          <div class="col-lg-9 col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                  Lieu de prise carte
              </div>
              <div class="panel-body-map">
                <img src=""/>
              </div>

            </div>
          </div>
          <div class="col-md-3">
                <!-- List starts -->
              </div>
     </div>

     <!-- Fin de la row-->












<?php
  include_once("menuBas.php");
?>
