<?php
    if(empty($_COOKIE["ADM"])){
        header ("Location: ../php/login.php");
    }else{
        setcookie('ADM', 1, time()+600);
    }
    $alterar = false;
    if(!empty($_GET)){
        $codigo = $_GET["codigo"];
        $alterar = true;

        $palavras = simplexml_load_file("../xml/palavras.xml");

        foreach ($palavras-> children() as $palavra) {
            if($codigo == $palavra->codigo){
    			$str = $palavra->str;
    			$dicaGenerica = $palavra->dicaGenerica;
    			$dicaEspecificaI = $palavra->dicaEspecificaI;
    			$dicaEspecificaII = $palavra->dicaEspecificaII;
            }
        }
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

        <title>Cadastro de Palavras</title>
    </head>
    <?php
        include "../inc/admCabecalhoMenu.inc";
        include "../inc/funcoes.inc";
        //include "../inc/admFooter.inc";
    ?>
    <body>
        <div class = "container">
            <?php
                if(empty($_POST)){
                    include "../inc/admCadastroPalavras.inc";
                }else{
                    if($_POST["atualizaPalavra"] == 'true' && admChecagemPalavra()){
                        admCadastrarPalavras();
                        echo'
                            <h2 class = "text-center">Palavra atualizada com sucesso</h2>
                        ';
                        $_POST["atualizaPalavra"] = false;
                    }
                    else if(admChecagemPalavra()){
                        admCadastrarPalavras();
                        echo'
                            <h2 class = "text-center">Palavra cadastrada com sucesso</h2>
                        ';
                    }else{
                        echo'
                            <h2 class = "text-center">Palavra já cadastrada</h2>
                        ';
                    }

                }
            ?>
        </div>
        <script src = "../js/jquery-3.2.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
        <script src = "../js/validaForm.js"></script>
    </body>
    <?php
        include "../inc/admFooter.inc";
    ?>
</html>
