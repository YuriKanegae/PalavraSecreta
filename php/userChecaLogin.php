<!DOCTYPE html>
<html lang="pt-BR">
	<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Formulário - Cadastro usuario</title>

        <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/login.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
	</head>
	<body>
		<div class="login-form col-sm-6 offset-3 col-md-4 offset-4">
			<?php
                include "../inc/funcoes.inc";
				if($_POST["modo"]==1){
					if(checaEmail()){
						gravar_dados_usuario();
					}else{
						header("Location: ../php/admListaUsuario.php");
					}

				}else{
	                if(!file_exists("../xml/jogador.xml")){
	                    gravar_dados_usuario();
	                    header("Location: ../php/login.php");
	                }else{
	                    if(checaEmail()){
	                        gravar_dados_usuario();
	                        header("Location: ../php/login.php");
	                    }else{
	                        echo'
	                            <h5 class = "text-center">
	                                E-mail já existente!<br />
	                                Clique <a href = "../php/login.php">aqui</a> para voltar para o login.
	                            </h5>
	                        ';
	                    }
	                }
				}
			?>
		</div>

        <script src = "../js/validaForm.js"></script>
        <script src = "../js/jquery-3.2.1.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
        <script src = "../js/validaform.min.js"></script>
	</body>
</html>
