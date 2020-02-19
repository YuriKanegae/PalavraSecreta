<?php
    $codigoPalavra = $_GET["codigo"];

    $palavras = simplexml_load_file("../xml/palavras.xml");

    foreach ($palavras->children() as $palavra) {

        if($palavra->codigo == $codigoPalavra){
            unset($palavra[0]);
        }
    }

    file_put_contents("../xml/palavras.xml", $palavras->asXML());
    header("Location: ../php/admListaPalavras.php");
 ?>
