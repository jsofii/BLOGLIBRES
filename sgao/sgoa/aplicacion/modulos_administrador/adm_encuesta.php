<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {
//header("Location:index2.php");
    echo "ERES PROFESOR";
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    echo "ERES ESTUDIANTE";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>

        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../encuesta/results.css"></head>
        <title>Proyecto SGOA</title>
    </head>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */ 
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 390px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        html{
            min-height: 100%;
            position: relative;
        }
        body{
            margin:0;
            margin-bottom: 40px;
        }
        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;} 
        }

        .table > tbody > tr > td {
            vertical-align: middle;
        }

    </style>


    <body>
        <?php include './navbar_adm_encuesta.php';?>
   
        <?php

    include '../encuesta/Poll.php';
    
    $poll1 = new Poll;


    //$pollResult = $poll1->getResult($_GET["1"]);
    $pollResult = $poll1->getResult('1'); //de nuestra encuesta :v 

        ?>
    <h3><?php echo $pollResult['poll']; ?></h3>
    <p><b>Votos totales:</b> <?php echo $pollResult['total_votes']; ?></p>
    <?php
    if(!empty($pollResult['options'])){ $i=0;
    //Option bar color class array
    $barColorArr = array('azure','emerald','violet','yellow','red');
    //Generate option bars with votes count
    foreach($pollResult['options'] as $opt=>$vote){
        //Calculate vote percent
        $votePercent = round(($vote/$pollResult['total_votes'])*100);
        $votePercent = !empty($votePercent)?$votePercent.'%':'0%';
        //Define bar color class
        if(!array_key_exists($i, $barColorArr)){
            $i=0;
        }
        $barColor = $barColorArr[$i];
    ?>
    <div class="bar-main-container <?php echo $barColor; ?>">
        <div class="txt"><?php echo $opt; ?></div>
        <div class="wrap">
     <div class="bar-percentage"><?php echo $votePercent; ?></div>
        <div class="bar-container">
          <div class="bar" style="width: <?php echo $votePercent; ?>;"></div>
        </div>
     </div>
    </div>
    <?php $i++; } } ?>
<!--<a href="index.php">Back To Poll</a>-->



        <footer class="container-fluid text-center">
            <p>Diseño y programación: Elsa Vasco, Edison Tamayo, José Criollo</p>
        </footer>
    </body>

</html>



