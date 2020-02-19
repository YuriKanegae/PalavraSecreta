<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Página de Login</title>

    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/login.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
</head>
<body>
    <div class="login-form col-sm-6 offset-3 col-md-4 offset-4">
        <header>
            <h1><img class="img-fluid" src="../logos/login.png"></h1>
            <h2 class="text-center">Entre com seu <b>e-mail</b> e <b>senha</b></h2>
        </header>
            <?php
                include "../inc/funcoes.inc";

                if (empty($_POST)){
                    echo '
                    <form action="login.php" method="POST">
                    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="material-icons">email</i>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="E-mail"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </div>
                        <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha"/>
                    </div>
                </div>

                <footer>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </footer>
            </form>
            <div class="float-left"></div>
                <button class="btn btn-secondary btn-cadastrar" data-toggle="modal" data-target="#NovoUsuario">
                  Cadastrar
                </button>
          </div>';

          include "../inc/modal.inc";

          echo'
          <script src = "../js/validaForm.js"></script>
          <script src = "../js/jquery-3.2.1.min.js"></script>
          <script src = "../js/bootstrap.min.js"></script>
          <script src = "../js/validaform.min.js"></script>';
                }else{
                    $emailL=$_POST['email'];
                    $senhaL=$_POST['senha'];
                    echo $senhaL;

                    if($emailL == 'Admin@admin.com' && $senhaL == 'admin'){
                        setcookie('ADM', 1, time()+600);
                        header("Location: ../php/admHome.php");

                    }else{
                        if (!file_exists('../xml/jogador.xml')){
                            echo '<h5 class = "text-center">Não há jogadores registrados</h5>';
                        }else{
                            $achou = false;
                            $jogador=simplexml_load_file('../xml/jogador.xml');
                            foreach($jogador->children() as $usuario){
                                $email=$usuario->email;
                                $senha=$usuario->senha;
                                $codigo = $usuario->codigo;

                                if ($emailL==$email && $senhaL==$senha){
                                    setcookie('USER', $codigo, time()+600);
                                    header("Location: userHome.php");
                                    $achou = true;
                                }
                            }
                            if(!$achou){
                                header("Location: login.php");
                            }
                        }
                    }
                }
            ?>
</body>
</html>
