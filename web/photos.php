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
<div class="carouselGallery-grid hidden-xs">
  <div class="row">
    <div class="carouselGallery-col-60">
      <?php foreach($toutesDonnees as $key => $value) {?>
        <?php $infos="photo prise à ".$value["lieu"]." le ".$value['datePhoto']."<br/>".$value['commentaire']; ?>
        <div class="carouselGallery-col-1 carouselGallery-carousel" data-index="<?php echo $value['idDonnees']; ?>" data-username="SNAPinfo" data-imagetext="<?php echo $infos; ?>" data-location="" data-likes="" <?php echo'data-imagepath="'.CHEMINLARGE.$value["photo"].'"';?> data-posturl="https://instagram.com/p/9_dViYwVWJ/" style="background-image:url(<?php echo CHEMINLARGE.$value["photo"];?>);">
          <div class="carouselGallery-item">
              <div class="carouselGallery-item-meta">
                  <span class="carouselGallery-item-meta-user">
                      Le titre ici
                  </span>
              </div>
          </div>
        </div>
      <?php }?>
    </div>
    <div class="carouselGallery-col-40">
      <?php $infos2="photo prise à ".$donnees["0"]["lieu"]." le ".$laDate." à ".$date["1"]."<br/>".$donnees["0"]["distance"]; ?>
    <div class="carouselGallery-col-2 carouselGallery-carousel" data-index="6" data-username="SNAPinfo" data-imagetext="<?php echo $infos2; ?>" data-location="" data-likes="" <?php echo'data-imagepath="'.CHEMINLARGE.$donnees["0"]["photo"].'"';?> data-posturl="https://instagram.com/p/9slFueQVQz/" style="background-image:url(<?php echo CHEMINPETIT.$donnees["0"]["photo"];?>);">
    <div class="carouselGallery-item">
        <div class="carouselGallery-item-meta">
            <span class="carouselGallery-item-meta-user">
                Ici le titre
            </span>
        </div>
    </div>
    </div>
    </div>
  </div>
</div>

<?php
  include_once("menuBas.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="assets/js/main.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
