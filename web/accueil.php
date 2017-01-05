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

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" <?php echo'src="'.$donnees["1"]["photo"].'"';?> alt="photo 2">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" <?php echo'src="'.$donnees["2"]["photo"].'"';?> alt="photo 3">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" <?php echo'src="'.$donnees["3"]["photo"].'"';?> alt="photo 4">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" <?php echo'src="'.$donnees["4"]["photo"].'"';?> alt="photo 5">
                </a>
            </div>

        </div>
        <!-- /.row -->
<!-- fin de l'autre row-->


<div class="col-md-12 title-box hidden-xs">
    <h1 class="text-center">jQuery imageCarousel Example</h1>
    <div class="jquery-script-ads" style="margin:30px auto;" align="center"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
</div>
<div class="carouselGallery-grid hidden-xs">
    <div class="row">
        <div class="carouselGallery-col-60">
            <div class="carouselGallery-col-1 carouselGallery-carousel" data-index="0" data-username="visitsweden" data-imagetext="Photographer: @conny_lundstrom
            If you want to visit Sweden to watch and/or photograph the northern lights, Abisko is a great place to go. Although it's pretty common to see them anywhere in northern Sweden.

            Tag your photos with #visitsweden and #swedishmoments to get featured. //@deskriptiv" data-location="" data-likes="3144" data-imagepath="https://scontent.cdninstagram.com/hphotos-xtf1/t51.2885-15/s640x640/sh0.08/e35/12105099_1702415459987632_609795510_n.jpg" data-posturl="https://instagram.com/p/9_dViYwVWJ/" style="background-image:url(https://scontent.cdninstagram.com/hphotos-xtf1/t51.2885-15/s640x640/sh0.08/e35/12105099_1702415459987632_609795510_n.jpg);">
            <div class="carouselGallery-item">
                <div class="carouselGallery-item-meta">
                    <span class="carouselGallery-item-meta-user">
                        @visitsweden
                    </span>
                    <span class="carouselGallery-item-meta-likes">
                        <span class="icons icon-heart"></span>3144
                    </span>
                </div>
            </div>
        </div>
        <div class="carouselGallery-col-1 carouselGallery-carousel" data-index="1" data-username="visitsweden" data-imagetext="Photographer: @s_gustavsson
        Location: Gaperud, Värmland
        Tag your photos with #visitsweden and #swedishmoments to get featured. //@deskriptiv" data-location="" data-likes="5094" data-imagepath="https://scontent.cdninstagram.com/hphotos-xtp1/t51.2885-15/s640x640/sh0.08/e35/12063148_865400153574109_1616517572_n.jpg" data-posturl="https://instagram.com/p/96UTFPwVaN/" style="background-image:url(https://scontent.cdninstagram.com/hphotos-xtp1/t51.2885-15/s640x640/sh0.08/e35/12063148_865400153574109_1616517572_n.jpg);">
        <div class="carouselGallery-item">
            <div class="carouselGallery-item-meta">
                <span class="carouselGallery-item-meta-user">
                    @visitsweden
                </span>
                <span class="carouselGallery-item-meta-likes">
                    <span class="icons icon-heart"></span>5094
                </span>
            </div>
        </div>
    </div>
    <div class="carouselGallery-col-1 carouselGallery-carousel" data-index="2" data-username="visitsweden" data-imagetext="Photographer: @tannerstedtphotography
    Location: Resmo

    A perfect place for stargazing.
    Tag #visitsweden and #swedishmoments for a chance to get featured. //@deskriptiv" data-location="" data-likes="3939" data-imagepath="https://scontent.cdninstagram.com/hphotos-xtf1/t51.2885-15/s640x640/sh0.08/e35/11430374_1056756017709570_2070956869_n.jpg" data-posturl="https://instagram.com/p/92tWKsQVUN/" style="background-image:url(https://scontent.cdninstagram.com/hphotos-xtf1/t51.2885-15/s640x640/sh0.08/e35/11430374_1056756017709570_2070956869_n.jpg);">
    <div class="carouselGallery-item">
        <div class="carouselGallery-item-meta">
            <span class="carouselGallery-item-meta-user">
                @visitsweden
            </span>
            <span class="carouselGallery-item-meta-likes">
                <span class="icons icon-heart"></span>3939
            </span>
        </div>
    </div>
</div>
<div class="carouselGallery-col-1 carouselGallery-carousel" data-index="3" data-username="visitsweden" data-imagetext="Photographer: @plilja
Location: Kalvträsk

There are plenty of remote places to rest your soul in northern Sweden.

Tag your photos with #visitsweden and #swedishmoments to get featured. //@deskriptiv" data-location="" data-likes="4626" data-imagepath="https://scontent.cdninstagram.com/hphotos-xtp1/t51.2885-15/s640x640/sh0.08/e35/12071129_1629374350650201_324519876_n.jpg" data-posturl="https://instagram.com/p/91p1nGwVVP/" style="background-image:url(https://scontent.cdninstagram.com/hphotos-xtp1/t51.2885-15/s640x640/sh0.08/e35/12071129_1629374350650201_324519876_n.jpg);">
<div class="carouselGallery-item">
    <div class="carouselGallery-item-meta">
        <span class="carouselGallery-item-meta-user">
            @visitsweden
        </span>
        <span class="carouselGallery-item-meta-likes">
            <span class="icons icon-heart"></span>4626
        </span>
    </div>
</div>
</div>
<div class="carouselGallery-col-1 carouselGallery-carousel" data-index="4" data-username="visitsweden" data-imagetext="Photographer: @jeppe.gustafsson
Location: Motala
It won't be long until Sweden turns into a winter wonderland.
Tag your photos with #visitsweden and #swedishmoments to get featured. //@deskriptiv" data-location="" data-likes="3652" data-imagepath="https://scontent.cdninstagram.com/hphotos-xap1/t51.2885-15/s640x640/sh0.08/e35/12139747_1014383458614485_66385837_n.jpg" data-posturl="https://instagram.com/p/9y6I2YwVb1/" style="background-image:url(https://scontent.cdninstagram.com/hphotos-xap1/t51.2885-15/s640x640/sh0.08/e35/12139747_1014383458614485_66385837_n.jpg);">
<div class="carouselGallery-item">
<div class="carouselGallery-item-meta">
    <span class="carouselGallery-item-meta-user">
        @visitsweden
    </span>
    <span class="carouselGallery-item-meta-likes">
        <span class="icons icon-heart"></span>3652
    </span>
</div>
</div>
</div>
<div class="carouselGallery-col-1 carouselGallery-carousel" data-index="5" data-username="visitsweden" data-imagetext="Photographer: @photobyqase
Location: Farsta
There's just something beautifully serene about Swedish autumn.

Remember to tag #visitsweden and #swedishmoments to get featured. //@deskriptiv" data-location="" data-likes="5358" data-imagepath="https://scontent.cdninstagram.com/hphotos-xfp1/t51.2885-15/e35/p480x480/12063244_688230837980464_1380297987_n.jpg" data-posturl="https://instagram.com/p/9tuxNaQVUj/" style="background-image:url(https://scontent.cdninstagram.com/hphotos-xfp1/t51.2885-15/e35/p480x480/12063244_688230837980464_1380297987_n.jpg);">
<div class="carouselGallery-item">
<div class="carouselGallery-item-meta">
    <span class="carouselGallery-item-meta-user">
        @visitsweden
    </span>
    <span class="carouselGallery-item-meta-likes">
        <span class="icons icon-heart"></span>5358
    </span>
</div>
</div>
</div>
</div>
<div class="carouselGallery-col-40">
<div class="carouselGallery-col-2 carouselGallery-carousel" data-index="6" data-username="visitsweden" data-imagetext="Photographer: @alexeliassonphoto
Location: Gamla stan

If you ever visit Stockholm, you have to take a stroll in Gamla stan (Old town). It's like traveling back in time.

Tag your photos with #visitsweden and #swedishmoments to get featured. //@deskriptiv" data-location="" data-likes="4151" data-imagepath="https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e35/p480x480/11934815_763148837144267_1213235293_n.jpg" data-posturl="https://instagram.com/p/9slFueQVQz/" style="background-image:url(https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e35/p480x480/11934815_763148837144267_1213235293_n.jpg);">
<div class="carouselGallery-item">
    <div class="carouselGallery-item-meta">
        <span class="carouselGallery-item-meta-user">
            @visitsweden
        </span>
        <span class="carouselGallery-item-meta-likes">
            <span class="icons icon-heart"></span>4151
        </span>
    </div>
</div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="assets/slide/js/main.js"></script>
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

<?php
  include_once("menuBas.php");
?>
