<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="assets/slide2/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="assets/slide2/css/elastic_grid.min.css" />
</head>
<body>
<div id="elastic_grid_demo"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="assets/slide2/js/modernizr.custom.js"></script>
<script src="assets/slide2/js/classie.js"></script>
<script type="text/javascript" src="assets/slide2/js/elastic_grid.min.js"></script>

<script type="text/javascript">
    $(function(){
      var donnees = <?php print_r(json_encode($_SESSION['donnees'])); ?>;
      var cheminLarge="images/large/";//chemin vers les images larges
      var cheminMin="images/thumbs/";//chemin vers les miniatures
        $("#elastic_grid_demo").elastic_grid({
            'showAllText' : 'All',
            'items' :
            [
                {
                    'title'         : 'le titre ici',
                    'lieu'         : donnees["1"]["lieu"],
                    'commentaire'   : donnees["1"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["1"]["photo"], 'images/small/2.jpg'],
                    'large'         : [cheminLarge+donnees["1"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'date':donnees["1"]["datePhoto"] },
                        { 'date':'', 'url':''}
                    ],
                    'tags'          : ['']
                },
                {
                    'title'         : 'le titre ici',
                    'lieu'         : donnees["2"]["lieu"],
                    'commentaire'   : donnees["2"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["2"]["photo"], 'images/small/5.jpg'],
                    'large'         : [cheminLarge+donnees["2"]["photo"], 'images/large/5.jpg'],
                    'button_list'   :
                    [
                        { 'date':donnees["2"]["datePhoto"]},
                        { 'date':'', 'url':''}
                    ],
                    'tags'          : ['']
                },
                {
                    'title'         : 'le titre ici',
                    'lieu'         : donnees["3"]["lieu"],
                    'commentaire'   : donnees["3"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["3"]["photo"], 'images/small/2.jpg'],
                    'large'         : [cheminLarge+donnees["3"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'date':donnees["3"]["datePhoto"] },
                        { 'date':'', 'url':''}
                    ],
                    'tags'          : ['']
                },
                {
                    'title'         : 'le titre ici',
                    'lieu'         : donnees["4"]["lieu"],
                    'commentaire'   : donnees["4"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["4"]["photo"], 'images/small/2.jpg'],
                    'large'         : [cheminLarge+donnees["4"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'date':donnees["4"]["datePhoto"]},
                        { 'date':'', 'url':''}
                    ],
                    'tags'          : ['']
                },
                {
                    'title'         : 'le titre ici',
                    'lieu'         : donnees["5"]["lieu"],
                    'commentaire'   : donnees["5"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["5"]["photo"], 'images/small/2.jpg'],
                    'large'         : [cheminLarge+donnees["5"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'date':donnees["5"]["datePhoto"]},
                        { 'date':'', 'url':''}
                    ],
                    'tags'          : ['']
                }


            ]
        });
    });
</script>
</body>
</html>
