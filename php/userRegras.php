<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(empty($_COOKIE["USER"])){
        header ("Location: ../php/login.php");
    }else{
        setcookie('USER', $_COOKIE["USER"], time()+600);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <title>Regras do Jogo</title>

        <link rel = "stylesheet" href = "../css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "../css/estilo.css" />
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/validaform.min.js"></script>

    </head>
    <body>

        <?php
            include "../inc/cabecalho_menu.inc";
        ?>

        <div class="container">
            <h1 class="regra">Regras do Jogo</h1>

            <br>

            <div class="row justify-content-center">
                <dl class="col-sm-6">
                    <dt>1 - Você poderá apostar/adivinhar a palavra:</dt>
                    <dd>• Se acertar, ganha a pontuação que você está no jogo;</dd>
                    <dd>• Se errar, perde o jogo automaticamente.</dd>

                    <br>

                    <dt>2 - Você poderá apostar uma letra por vez:</dt>
                    <dd>• Mas perde 20 pontos por cada letra errada.</dd>

                    <br>

                    <dt>3 - Você poderá solicitar dicas especificas:</dt>
                    <dd>• No começo do jogo já haverá uma dica genérica;</dd>
                    <dd>• Mas havera duas dicas específicas que podem ser solicitadas mas 25 pontos são subtraidos por cada dica.</dd>
                </dl>
            </div>
        </div>
    </body>
</html>

<?php
    include "../inc/admFooter.inc";
?>
