<?php
    if(empty($_COOKIE["USER"])){
        header ("Location: ../php/login.php");
    }else{
        setcookie('USER', $_COOKIE["USER"], time()+600);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Palavra Secreta - Área do jogador</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/estilo.css" />
	</head>
	<body>
		<?php
			include "../inc/cabecalho_menu.inc";
            include "../inc/funcoes.inc";
		 ?>

		<div class="container">
            <h1 class="text-center">Perfil</h1>
            <div class="row justify-content-center">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col-auto" class = "text-center">#</th>
                            <th scope="col-auto" class = "text-center">Nome</th>
                            <th scope="col-auto" class = "text-center">E-Mail</th>
                            <th scope="col-auto" class = "text-center">Pontuação</th>
                            <th scope="col-auto" class = "text-center">Jogos Ganhos</th>
                            <th scope="col-auto" class = "text-center">Jogos Perdidos</th>
                            <th scope="col-auto" class = "text-center">Trofeu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            perfilUsuario();
                        ?>
                    </tbody>
                </table>
            </div>
		</div>

		<?php
			include "../inc/admFooter.inc";
		 ?>
		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/validaform.min.js"></script>
	</body>
</html>
