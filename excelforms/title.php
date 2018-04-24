<html>
  <head>
    <title>ExcelForms</title>
<!--   <meta charset="UTF-8">-->

      <!--                                    STYLE                                                -->

    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/bootstrap-table.css" rel="stylesheet">
    <link type="text/css" href="css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/redmond/jquery-ui.css" rel="stylesheet">
    <link type="text/css" href="css/custom.css"  rel="stylesheet">


<!--                                           SCRIPTS                                            -->

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/tableExport.js"></script>
    <script src="js/bootstrap.min.js"></script>
  	<script src="js/bootstrap-table.js"></script>
<!--	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
    <script src="https://rawgit.com/yaronyam/bootstrap-table/feature/print/src/extensions/print/bootstrap-table-print.js"></script>

<!--    <script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>-->
    </head>

   <body>
    <!--//**************************************************************************************-->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand navbar-left" href="index.php" class="pull-left"><img src="img/logo.png"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">

            <!-- <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">SI <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a data-toggle="modal" href="#add_si_modal">Добавить</a></li>

              </ul>
            </li> -->
            <!-- <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">...<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
              </ul>
            </li> -->
            <?php
            if (isset( $_SESSION['user_id'])){
             echo "<li><a href=\"auth.php?action=logout\">Выйти</a></li>";
            }
            ?>

          </ul>
        </div>
        </div>
      </div>
    </div>
    <br>
  <!--//**************************************************************************************-->
