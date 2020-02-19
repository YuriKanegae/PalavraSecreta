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
		 ?>
		<div class="container">
			<?php
				echo'
				<article>
					<h1 class = "text-center">Seja bem-vindo(a)!</h1>
				</article>
				';
			?>
		</div>
		<?php
			include "../inc/admFooter.inc";
		 ?>
		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/validaform.min.js"></script>
	</body>
</html>
