<?php
    $codigoUsuario=$_GET['codigo'];

    $jogador=simplexml_load_file('../xml/jogador.xml');

    foreach($jogador->children() as $usuario){
      
        if($usuario->codigo == $codigoUsuario){
            unset($usuario[0]);
        }
    }

    file_put_contents('../xml/jogador.xml', $jogador->asXML());
    header('Location: ../php/admListaUsuario.php');
?>
