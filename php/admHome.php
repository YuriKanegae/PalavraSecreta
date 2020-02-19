<?php
    if(empty($_COOKIE["ADM"])){
        header ("Location: ../php/login.php");
    }else{
        setcookie('ADM', 1, time()+600);
    }
?>
<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/estilo.css" />

        <title>Home</title>
    </head>
    <body>
        <?php
            include "../inc/admCabecalhoMenu.inc";
            //include "../inc/admFooter.inc";
        ?>
        <div class = "container">
            <h1 class = "text-center">Bem Vindo</h1>
        </div>

        <script src = "../js/jquery-3.2.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
        <?php
            include "../inc/admFooter.inc";
        ?>
    </body>
</html>
