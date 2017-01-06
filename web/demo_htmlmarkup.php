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
        $("#elastic_grid_demo").elastic_grid({
            'showAllText' : 'All',
            'items' :
            [
                {
                    'title'         : donnees["1"]["lieu"],
                    'description'   : donnees["1"]["commentaire"],
                    'thumbnail'     : ['images/small/1.jpg', 'images/small/2.jpg'],
                    'large'         : [donnees["1"]["photo"], 'images/large/2.jpg'],
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
                    'thumbnail'     : ['images/small/4.jpg', 'images/small/5.jpg'],
                    'large'         : [donnees["2"]["photo"], 'images/large/5.jpg'],
                    'button_list'   :
                    [
                        { 'title':'Demo', 'url' : 'http://bonchen.net/' },
                        { 'title':'Download', 'url':'http://porfolio.bonchen.net/'}
                    ],
                    'tags'          : ['']
                },                {
                    'title'         : donnees["3"]["lieu"],
                    'description'   : donnees["3"]["commentaire"],
                    'thumbnail'     : ['images/small/15.jpg', 'images/small/2.jpg'],
                    'large'         : [donnees["3"]["photo"], 'images/large/2.jpg'],
                    'button_list'   :
                    [
                        { 'title':'Demo', 'url' : 'http://bonchen.net/' },
                        { 'title':'Download', 'url':'http://porfolio.bonchen.net/'}
                    ],
                    'tags'          : ['']
                },                {
                    'title'         : donnees["4"]["lieu"],
                    'description'   : donnees["4"]["commentaire"],
                    'thumbnail'     : ['images/small/15.jpg', 'images/small/2.jpg'],
                    'large'         : [donnees["3"]["photo"], 'images/large/2.jpg'],
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
