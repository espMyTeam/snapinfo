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
                    'title'         : donnees["1"]["lieu"],
                    'description'   : donnees["1"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["1"]["photo"], 'images/small/2.jpg'],
                    'large'         : [cheminLarge+donnees["1"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'title':'Demo', 'url' : 'http://bonchen.net/' },
                        { 'title':'Download', 'url':'http://porfolio.bonchen.net/'}
                    ],
                    'tags'          : ['']
                },
                {
                    'title'         : donnees["2"]["lieu"],
                    'description'   : donnees["2"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["2"]["photo"], 'images/small/5.jpg'],
                    'large'         : [cheminLarge+donnees["2"]["photo"], 'images/large/5.jpg'],
                    'button_list'   :
                    [
                        { 'title':'Demo', 'url' : 'http://bonchen.net/' },
                        { 'title':'Download', 'url':'http://porfolio.bonchen.net/'}
                    ],
                    'tags'          : ['']
                },                {
                    'title'         : donnees["3"]["lieu"],
                    'description'   : donnees["3"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["3"]["photo"], 'images/small/2.jpg'],
                    'large'         : [cheminLarge+donnees["3"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'title':'Demo', 'url' : 'http://bonchen.net/' },
                        { 'title':'Download', 'url':'http://porfolio.bonchen.net/'}
                    ],
                    'tags'          : ['']
                },                {
                    'title'         : donnees["4"]["lieu"],
                    'description'   : donnees["4"]["commentaire"],
                    'thumbnail'     : [cheminMin+donnees["4"]["photo"], 'images/small/2.jpg'],
                    'large'         : [cheminLarge+donnees["4"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'title':'Demo', 'url' : 'http://bonchen.net/' },
                        { 'title':'Download', 'url':'http://porfolio.bonchen.net/'}
                    ],
                    'tags'          : ['']
                }

            ]
        });
    });
</script>
</body>
</html>
