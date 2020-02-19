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
<html lang="pt-BR">
	<head>
		<meta charset = "UTF-8">
		<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
		<meta name = "viewport" content = "width=device-width, initial-scale=1">

		<title>Palavra Secreta - Área do jogador</title>

		<link rel = "stylesheet" href = "../css/bootstrap.min.css" />
		<link rel = "stylesheet" href = "../css/estilo.css" />
	</head>

	<body>
    <?php
        include "../inc/cabecalho_menu.inc";
        //Definição da classe de palavra
        class PalavraClasse{
            public $str;
            public $dicaGenerica;
            public $dicaEspecificaI;
            public $dicaEspecificaII;
        }
    ?>
    <div class="container">
		<?php

            include "../inc/funcoes.inc";


            if(file_exists("../xml/palavras.xml")){
                if(!isset($_SESSION["fase"])){//Se é um começo de jogo
                    $_SESSION["PalavraJogo"] = userGeraPalavra();

                    $_SESSION["PalavraDiv"] = $_SESSION["PalavraJogo"]->str;
                    $_SESSION["LetrasAcertadas"] = array();

                    for($i = 0; $i < strlen($_SESSION["PalavraDiv"]); $i++){
                        if($_SESSION["PalavraDiv"][$i] == " "){
                            $_SESSION["LetrasAcertadas"][] = 1;
                        }else{
                            $_SESSION["LetrasAcertadas"][] = 0;
                        }
                    }

                    $_SESSION["fase"] = 1;
                    $_SESSION["pontuacao"] = 100;
                    $_SESSION["ganhou"] = false;
                    $_SESSION["perdeu"] = false;
                    $_SESSION["estadoDica"] = 1;
                }else{//Se eles já estiver jogando

                    if(!empty($_POST)){
                        $modo = $_POST["modo"];

                        if($modo == 1){
                            $letra = strtoupper($_POST["letraChutada"]);

                            $achou = false;
                            for($i = 0; $i < strlen($_SESSION["PalavraDiv"]); $i++){
                                if(strtoupper($_SESSION["PalavraDiv"][$i]) == $letra){
                                    $_SESSION["LetrasAcertadas"][$i] = 1;
                                    $achou = true;
                                }
                            }

                            if(!$achou){
                                $_SESSION["pontuacao"] -=20;
                            }

                            unset($_POST["modo"]);
                        }else if($modo == 2){
                            $palavra = strtoupper($_POST["chutarPalavra"]);

                            if($palavra == strtoupper($_SESSION["PalavraDiv"])){
                                $_SESSION["ganhou"] = true;
                                for($i = 0; $i < strlen($_SESSION["PalavraDiv"]); $i++){
                                    $_SESSION["LetrasAcertadas"][$i] = 1;
                                }
                            }else{
                                $_SESSION["perdeu"] = true;
                            }

                            unset($_POST["modo"]);
                        }else if($modo == 3){
                            if($_SESSION["estadoDica"] <3){
                                $_SESSION["estadoDica"]++;
                                $_SESSION["pontuacao"] -=25;
                            }

                            unset($_POST["modo"]);
                        }
                    }

                    $soma = 0;
                    for($i = 0; $i < strlen($_SESSION["PalavraDiv"]); $i++){
                        $soma += $_SESSION["LetrasAcertadas"][$i];
                    }
                    if($soma == intval(strlen($_SESSION["PalavraDiv"]))){
                        $_SESSION["ganhou"] = true;
                    }

                    if($_SESSION["pontuacao"]<=0){
                        $_SESSION["perdeu"] = true;
                    }
                }

                echo'
                    <!--Cabeçalho-->
                    <h1 class = "text-center">Adivinhe a palavra</h1>
                    <div  class = "row justify-content-center">
                        <table>
                            <thead>
                                <tr>
                                    <th class = "col-auto text-center">Pontuação</th>
                                    <th class = "col-auto text-center">Dicas</th>
                                    <th class = "col-auto text-center">Tamanho da Palavra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class = "col-auto text-center">
                ';

                                        echo $_SESSION["pontuacao"];
                echo'
                                    </td>
                                    <td class = "col-auto text-center">
                ';

                                        if($_SESSION["estadoDica"] == 1){
                                            echo $_SESSION["PalavraJogo"] ->dicaGenerica;
                                        }else if($_SESSION["estadoDica"] == 2){
                                            echo $_SESSION["PalavraJogo"] ->dicaGenerica . "<br/>";
                                            echo $_SESSION["PalavraJogo"] ->dicaEspecificaI;
                                        }else if($_SESSION["estadoDica"] == 3){
                                            echo $_SESSION["PalavraJogo"] ->dicaGenerica . "<br/>";
                                            echo $_SESSION["PalavraJogo"] ->dicaEspecificaI  . "<br/>";
                                            echo $_SESSION["PalavraJogo"] ->dicaEspecificaII;
                                        }

                echo'
                                    </td>
                                    <td class = "col-auto text-center">
                ';

                                        echo strlen($_SESSION["PalavraDiv"]);
                echo'
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!--Parte da palavra-->
                    <div class = "p-5 m-4 border border-dark row justify-content-center">
                ';
                        for($i = 0; $i < strlen($_SESSION["PalavraDiv"]); $i++){
                            echo '
                        <div class = "letra text-center">
                            ';
                                if($_SESSION["LetrasAcertadas"][$i] == 1){
                            echo $_SESSION["PalavraDiv"][$i];
                                }else{
                            echo '_';
                                }
                            echo'
                        </div>
                            ';
                        }
                echo'

                    </div>

                    <!--Chutar uma letra-->
                    <form action = "userJogar.php" method = "POST">
                        <div class = "row justify-content-center mt-5">
                            <input type = "hidden" name = "modo" value = "1"/>
                            <div class = "col-4">
                                <input class = "form-control" name = "letraChutada" id = "letraChutada" type = "text" required = "required" maxlength="1" placeholder ="Chute uma letra"/>
                            </div>
                            <div class = "col-3 text-right">
                                <input class = "btn btn-primary" type = "submit" value = "Chutar uma letra"/>
                            </div>
                        </div>
                    </form>

                    <!--Chutar a palavra-->
                    <form action = "userJogar.php" method = "POST">
                        <div class = "row justify-content-center mt-4">
                            <input type = "hidden" name = "modo" value = "2"/>
                            <div class = "col-4">
                                <input class = "form-control" name = "chutarPalavra" id = "chutarPalavra" type = "text" required = "required" placeholder ="Chute uma palavra"/>
                            </div>
                            <div class = "col-3 text-right">
                                <input type = "submit" class = "btn btn-danger" value = "Chutar a palavra"/>
                            </div>
                        </div>
                    </form>

                    <!--Pedir dica-->
                    <form action = "userJogar.php" method = "POST">
                        <div class = "row justify-content-center mt-4">
                            <input type = "hidden" name = "modo" value = "3"/>
                            <div class = "row-auto">
                                <input class = "btn btn-primary pull-right" type = "submit" value = "Pedir dica"/>
                            </div>
                        </div>
                    </form>
                ';

                if($_SESSION["perdeu"])
                {
                    userGravarDados("perdeu");
                    session_destroy();
                    echo '
                        <h2 class = "text-center mt-5">Você errou a palavra</h2>
                        <div class = "text-center">
                            <a href = "userJogar.php">Jogar novamente?</a>
                        </div>
                    ';

                }
                if($_SESSION["ganhou"]){
                    userGravarDados("ganhou");
                    session_destroy();
                    echo '
                        <h2 class = "text-center mt-5">Você acertou a palavra</h2>
                        <div class = "text-center">
                            <a href = "userJogar.php">Jogar novamente?</a>
                        </div
                    ';
                }

            }else{
                echo '
                    <h2 class = "text-center">Nenhuma palavra cadastrada!</h2>
                ';
            }
        ?>
    </div>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validaform.min.js"></script>
	</body>
    <?php
        include "../inc/admFooter.inc";
    ?>
</html>
