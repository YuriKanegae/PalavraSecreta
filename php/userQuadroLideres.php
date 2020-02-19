<?php
    if($_COOKIE["USER"] == 0){
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

		<title>Palavra Secreta - Ranking</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/estilo.css" />
	</head>
	<body>
		<?php
			include "../inc/cabecalho_menu.inc";
            include "../inc/funcoes.inc"
		 ?>
		<div class="container">
            <h1 class="text-center">Ranking</h1>
            <div class="row justify-content-center">
                <table class="table col-8">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col-1" class = "text-center">#</th>
                            <th scope="col-2" class = "text-center">Nome</th>
                            <th scope="col-1" class = "text-center">Pontuação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            userRanking();
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
