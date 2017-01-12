<!DOCTYPE html>
<?php include_once("commun/controlleur.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>SNAPInfo | Login</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>snapinfo@gmail.com
                    &nbsp;&nbsp;
                    <strong>Support: </strong>+221 77 777 77 77
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html" >

                    <img src="images/logo.png" width="50%"  style="position:absolute;left:30%;top:120%;"/>
                </a>

            </div>

            </div>
        </div><!-- fin nav-bar-->
    <!-- LOGO HEADER END-->

    <!-- MENU SECTION END-->
    <div class="content-wrapper" style="margin-top:10%;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line"> Veillez vous identifier </h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <hr />
                     <h4> identifiez-vous avec <strong> Votre compte SNAPInfo :</strong></h4>
                    <br />
                    <?php
                        if ($_REQUEST["errolog"]=="erreur") {?>
                          <div class="alert alert-block alert-danger fade in">
                              <button data-dismiss="alert" class="close close-sm" type="button">
                                  <i class="icon-remove"></i>
                              </button>
                               Le login ou le mot de passe est incorrect
                          </div>
                    <?php    }
                    ?>
                    <?php
                        if ($_REQUEST["errolog"]=="folie") {?>
                          <div class="alert alert-block alert-danger fade in">
                              <button data-dismiss="alert" class="close close-sm" type="button">
                                  <i class="icon-remove"></i>
                              </button>
                               On ne peut pas acceder par URL il faut passer par là!!!
                          </div>
                    <?php    }
                    ?>
                    <form method="POST" action="index.php">
                       <label>Login : </label>
                          <input type="text" name="login" class="form-control" />
                          <label>Mot de passe :  </label>
                          <input type="password" name="password" class="form-control" />
                          <hr />
                          <button type="submit"><span class="glyphicon glyphicon-user"></span> &nbsp;Valider </button>&nbsp;
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-info">
                        This is a free bootstrap admin template with basic pages you need to craft your project.
                        Use this template for free to use for personal and commercial use.
                        <br />
                         <strong> Some of its features are given below :</strong>
                        <ul>
                            <li>
                                Responsive Design Framework Used
                            </li>
                            <li>
                                Easy to use and customize
                            </li>
                            <li>
                                Font awesome icons included
                            </li>
                            <li>
                                Clean and light code used.
                            </li>
                        </ul>

                    </div>
                    <div class="alert alert-success">
                         <strong> Instructions To Use:</strong>
                        <ul>
                            <li>
                               Lorem ipsum dolor sit amet ipsum dolor sit ame
                            </li>
                            <li>
                                 Aamet ipsum dolor sit ame
                            </li>
                            <li>
                               Lorem ipsum dolor sit amet ipsum dolor
                            </li>
                            <li>
                                 Cpsum dolor sit ame
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2017 SNAPInfo | By : DIC3TR
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
