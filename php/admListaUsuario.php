<?php
      if($_COOKIE["ADM"]==0){
          header ("Location: ../php/login.php");
    }else{
      setcookie('ADM', 1, time()+600);
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/estilo.css" />

    <title>Lista de usuários</title>
  </head>
  <?php
    include "../inc/admCabecalhoMenu.inc";
    include "../inc/funcoes.inc";
  ?>
  <body>
    <div class="container">
      <?php
        if(file_exists("../xml/jogador.xml")){
          echo '
            <h1 class="text-center">Lista de Usuários</h1>
            <div class="row justify-content-center">
                <table class="table center">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col-auto" class = "text-center">#</th>
                      <th scope="col-auto" class = "text-center">Nome</th>
                      <th scope="col-auto" class = "text-center">E-Mail</th>
                      <th scope="col-auto" class = "text-center">Pontuação</th>
                      <th scope="col-auto" class = "text-center">Jogos Ganhos</th>
                      <th scope="col-auto" class = "text-center">Jogos Perdidos</th>
                      <th scope="col-auto class = "text-center"">Ação</th>
                    </tr>
                  </thead>';
                  admJogador();
            echo'
                </table>
            </div>';
        }else{
          echo '<h1 class="text-center">Não há jogadores cadastrados</h1>';
        }
      ?>
    </div>

<?php
    include "../inc/modal_alterar.inc";
?>
    <script src = "../js/validaForm.js"></script>
    <script src = "../js/jquery-3.2.1.min.js"></script>
    <script src = "../js/popper.min.js"></script>
    <script src = "../js/bootstrap.min.js"></script>
  </body>
  <?php
      include "../inc/admFooter.inc";
  ?>
</html>
