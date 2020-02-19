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

        <title>Lista de palavras</title>
    </head>
    <?php
        include "../inc/admCabecalhoMenu.inc";
		include "../inc/funcoes.inc";
    ?>
    <body>
        <div class = "container">
			<?php
				if(file_exists("../xml/palavras.xml")){
					echo '
						<h1 class = "text-center">Lista de Palavras</h1>
						<div class = "row justify-content-center">
							<table class = "table">
								<thead class = "thead-dark">
									<tr>
										<th scope="col-auto">#</th>
										<th scope="col-auto">Palavra</th>
										<th scope="col-auto">Dica Genérica</th>
										<th scope="col-auto">Dica específica 1</th>
										<th scope="col-auto">Dica específica 2</th>
                                        <th scope="col-auto">Ações</th>
									</tr>
								</thead>
								<tbody>';
									admTabela();
				echo'
								</tbody>
							</table>
						</div>
					';
				}else{
					echo '<h1 class = "text-center">Não há palavras cadastradas</h1>';
				}
			?>
        </div>
        <script src = "../js/validaForm.js"></script>
        <script src = "../js/jquery-3.2.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
    <?php
        include "../inc/admFooter.inc";
    ?>
</html>
