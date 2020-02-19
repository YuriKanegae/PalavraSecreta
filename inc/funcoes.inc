<?php
    function admObterCodigo($tipo){
        if(!file_exists("../xml/codigos.xml")){
            $xml =
'<?xml version = "1.0" encoding = "UTF-8"?>
<codigos>
    <palavra>1</palavra>
    <usuario>1</usuario>
</codigos>
';
            file_put_contents("../xml/codigos.xml", $xml);
            return 1;
        }else{
            $codigos = simplexml_load_file("../xml/codigos.xml");

            if($tipo == "palavra"){
                return $codigos->palavra;
            }
            if($tipo == "usuario"){
                return $codigos->usuario;
            }
        }
    }

    function admChecagemPalavra(){
        if(!file_exists("../xml/palavras.xml")){
            return true;
        }else{
            $palavras = simplexml_load_file("../xml/palavras.xml");
            $palavraCadastro = $_POST["palavra"];
            $codigo = $_POST["codigo"];

            foreach($palavras->children() as $palavra){
                $palavraComparada = $palavra->str;
                if($codigo!= $palavra->codigo){
                    if($palavraComparada == $palavraCadastro){
                        return false;
                    }
                }
            }
			return true;
        }
    }
    function userRanking(){
        $jogador = simplexml_load_file("../xml/jogador.xml");

        class MyStruct{
            public $codigo;
            public $nome;
            public $pontuacao;
        }

        $usuarios = array();
        $numeroUsuarios = 0;
        foreach($jogador->children() as $usuario){
            $usuarios[$numeroUsuarios] = new MyStruct();

            $usuarios[$numeroUsuarios]->codigo = $usuario->codigo;
            $usuarios[$numeroUsuarios]->nome = $usuario->nome;
            $usuarios[$numeroUsuarios]->pontuacao = $usuario->pontuacao;
            $numeroUsuarios++;
        }

        $aux = new MyStruct();
        for($i = 0; $i < $numeroUsuarios; $i++){
            for($j = 0; $j < $numeroUsuarios-1; $j++){
                if(intval($usuarios[$j+1]->pontuacao) > intval($usuarios[$j]->pontuacao)){
                    $aux->codigo = $usuarios[$j] ->codigo;
                    $aux->nome = $usuarios[$j] ->nome;
                    $aux->pontuacao = $usuarios[$j] ->pontuacao;

                    $usuarios[$j] ->codigo = $usuarios[$j+1] ->codigo;
                    $usuarios[$j] ->nome = $usuarios[$j+1] ->nome;
                    $usuarios[$j] ->pontuacao = $usuarios[$j+1] ->pontuacao;

                    $usuarios[$j+1] ->codigo = $aux->codigo ;
                    $usuarios[$j+1] ->nome = $aux->nome ;
                    $usuarios[$j+1] ->pontuacao = $aux->pontuacao ;
                }
            }
        }

        for($i = 0; $i < $numeroUsuarios; $i++){
            echo '
            <tr>
                <td class = "text-center">' . ($i+1) . '</td>
                <td class = "text-center">' .$usuarios[$i]->nome. '</td>
                <td class = "text-center">' .$usuarios[$i]->pontuacao. '</td>
            </tr>
            ';
        }
    }


    function admCadastrarPalavras(){
        $codigoCadastro = $_POST["codigo"];
        $palavraCadastro = $_POST["palavra"];
        $dicaGenericaCadastro = $_POST["dicaGenerica"];
        $dicaEspecificaICadastro = $_POST["dicaEspecificaI"];
        $dicaEspecificaIICadastro = $_POST["dicaEspecificaII"];

        if(!file_exists("../xml/palavras.xml")){
            $xml =
"<?xml version = \"1.0\" encoding = \"UTF-8\"?>
<palavras>
    <palavra>
        <codigo>$codigoCadastro</codigo>
        <str>$palavraCadastro</str>
        <dicaGenerica>$dicaGenericaCadastro</dicaGenerica>
        <dicaEspecificaI>$dicaEspecificaICadastro</dicaEspecificaI>
        <dicaEspecificaII>$dicaEspecificaIICadastro</dicaEspecificaII>
    </palavra>
</palavras>
";
            file_put_contents("../xml/palavras.xml", $xml);
        }else{
            if($_POST["atualizaPalavra"] == 'true'){
                $palavras = simplexml_load_file("../xml/palavras.xml");

                foreach($palavras->children() as $palavra){
                    if($palavra->codigo == $codigoCadastro){
                        $palavra->str = $palavraCadastro;
                        $palavra->dicaGenerica = $dicaGenericaCadastro;
                        $palavra->dicaEspecificaI = $dicaEspecificaICadastro;
                        $palavra->dicaEspecificaII = $dicaEspecificaIICadastro;
                    }
                }
            }else{
                $palavras = simplexml_load_file("../xml/palavras.xml");
                $palavra = $palavras->addChild("palavra");
    			$palavra -> addChild('codigo', $codigoCadastro);
                $palavra -> addChild('str', $palavraCadastro);
                $palavra -> addChild('dicaGenerica', $dicaGenericaCadastro);
                $palavra -> addChild('dicaEspecificaI', $dicaEspecificaICadastro);
                $palavra -> addChild('dicaEspecificaII', $dicaEspecificaIICadastro);
            }
            file_put_contents("../xml/palavras.xml", $palavras->asXML());
        }

        atualizaCodigo("palavra");
    }

    function atualizaCodigo($tipo){
        $codigos = simplexml_load_file("../xml/codigos.xml");

        if($tipo == "palavra"){
            $codigos->palavra++;
        }
        if($tipo == "usuario"){
            $codigos->usuario++;
        }

        file_put_contents("../xml/codigos.xml", $codigos->asXML());
    }

	function admTabela(){
		$palavras = simplexml_load_file("../xml/palavras.xml");

		foreach($palavras -> children() as $palavra){
			$codigoCadastro = $palavra->codigo;
			$palavraCadastro = $palavra->str;
			$dicaGenericaCadastro = $palavra->dicaGenerica;
			$dicaEspecificaICadastro = $palavra->dicaEspecificaI;
			$dicaEspecificaIICadastro = $palavra->dicaEspecificaII;

			echo'
				<tr>
					<td>' .$codigoCadastro. '</td>
					<td>' .$palavraCadastro. '</td>
					<td>' .$dicaGenericaCadastro. '</td>
					<td>' .$dicaEspecificaICadastro. '</td>
					<td>' .$dicaEspecificaIICadastro. '</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                Ação<span class="caret"></span>
                            </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class = "btn btn-primary" onclick = "admEditarPalavra('.$codigoCadastro.')">Editar</button>
                            </li>
                            <li>
                                <button class = "btn btn-danger" onclick = "admExcluirPalavraAlert('.$codigoCadastro.')">Excluir</button>
                            </li>
                        </ul>
                        </div>
                    </td>
				</tr>
			';
		}
	}

    function gravar_dados_usuario() {

        $codigo = $_POST["codigo"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $modo = $_POST["modo"];

        if($modo == 1){
            $jogador = simplexml_load_file("../xml/jogador.xml");

            foreach($jogador->children() as $usuario){
                if($usuario->codigo == $codigo){
                    $usuario->nome = $nome;
                    $usuario->email = $email;
                }
            }

            file_put_contents("../xml/jogador.xml", $jogador->asXML());

            header('Location: ../php/admListaUsuario.php');
        }else{
            $senha = $_POST["senhaNova"];
            $modo = $_POST["modo"];
            if (!file_exists("../xml/jogador.xml")) {
                $xml =
"<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<jogador>
    <usuario>
        <codigo>$codigo</codigo>
        <nome>$nome</nome>
        <email>$email</email>
        <senha>$senha</senha>
        <pontuacao>0</pontuacao>
        <jogos_ganhos>0</jogos_ganhos>
        <jogos_perdidos>0</jogos_perdidos>
        <trofeus>nenhum</trofeus>
    </usuario>
</jogador>";

                file_put_contents("../xml/jogador.xml", $xml);
            }else{// arquivo já existe
                $jogador = simplexml_load_file("../xml/jogador.xml");

                // criar um filho da livraria - um novo livro
                $usuario = $jogador->addChild("usuario");


                //criar  os filhos do livro - os dados
                $usuario->addChild('codigo', $codigo);
                $usuario->addChild('nome', $nome);
                $usuario->addChild('email', $email);
                $usuario->addChild('senha', $senha);
                $usuario->addChild('pontuacao', 0);
                $usuario->addChild('jogos_ganhos', 0);
                $usuario->addChild('jogos_perdidos', 0);
                $usuario->addChild('trofeus', 'nenhum');

                //gravar as novas informações  na livraria e gerar um xml dessa nova livraria alterada
                file_put_contents("../xml/jogador.xml", $jogador->asXML());
            }
        atualizaCodigo("usuario");
        }
    }


    function checaEmail(){
        $email = $_POST["email"];
		$codigo = $_POST["codigo"];
		
        $jogador = simplexml_load_file("../xml/jogador.xml");

        foreach($jogador -> children() as $usuario){
            $emailXML = $usuario-> email;

            if($emailXML == $email && $codigo != $usuario->codigo){
                return false;
            }
        }
        return true;
    }

    function admJogador(){
        $jogador=simplexml_load_file("../xml/jogador.xml");

        foreach ($jogador->children() as $usuario){
            $codigoJ=$usuario->codigo;
            $nomeJ=$usuario->nome;
            $emailJ=$usuario->email;
            $pontuacaoJ=$usuario->pontuacao;
            $jogosG=$usuario->jogos_ganhos;
            $jogosP=$usuario->jogos_perdidos;

            echo'
                <tr>
                    <td class = "text-center col-auto">'.$codigoJ.'</td>
                    <td class = "text-center col-auto">'.$nomeJ.'</td>
                    <td class = "text-center col-auto">'.$emailJ.'</td>
                    <td class = "text-center col-auto">'.$pontuacaoJ.'</td>
                    <td class = "text-center col-auto">'.$jogosG.'</td>
                    <td class = "text-center col-auto">'.$jogosP.'</td>

                    <td class = "text-center col-auto">
                        <div class="dropdown">
                            <button class="btn btn-primary" dropdown-toggle" data-toggle="dropdown">
                                Ação
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
            ';
            //<li><a href="../php/adm">Editar</a></li>
            echo'
                                <li>
                                    <button class = "btn btn-danger" onclick = "admExcluirJogadorAlert('.$codigoJ.')">Excluir</button>
                                </li>';
                                echo "
                                <li>
                                    <button class = \"btn btn-secondary\" onclick=\"batata($codigoJ, '$nomeJ', '$emailJ')\">Editar</button>
                                </li>";
                            echo'
                            </ul>
                        </div>
                    </td>
                </tr>
            ';
        }
    }

    function perfilUsuario(){
        $cod = $_COOKIE["USER"];

        $jogador = simplexml_load_file("../xml/jogador.xml");

        foreach ($jogador->children() as $usuario){
            $codigoJ = $usuario->codigo;
            $nomeJ = $usuario->nome;
            $emailJ = $usuario->email;
            $pontuacaoJ = $usuario->pontuacao;
            $jogosJ = $usuario->jogos_jogados;
            $jogosG = $usuario->jogos_ganhos;
            $jogosP = $usuario->jogos_perdidos;
            $trofeu = $usuario->trofeus;

            if ($cod == $codigoJ){
                echo'
                    <tr>
                        <td class = "text-center">'.$codigoJ.'</td>
                        <td class = "text-center">'.$nomeJ.'</td>
                        <td class = "text-center">'.$emailJ.'</td>
                        <td class = "text-center">'.$pontuacaoJ.'</td>
                        <td class = "text-center">'.$jogosG.'</td>
                        <td class = "text-center">'.$jogosP.'</td>
                        <td class = "text-center">'.$trofeu.'</td>
                    </tr>
                ';
            }
        }
    }


    function userGeraPalavra(){
        $palavras = simplexml_load_file("../xml/palavras.xml");
        $numeroPalavras = admObterCodigo("palavra") - 1;
        $PalavraJogo = new PalavraClasse();

        $achou = false;
        do{
            $codigoPalavra = rand(1, $numeroPalavras);
            foreach($palavras -> children() as $palavra){
                if($palavra->codigo == $codigoPalavra){
                    $PalavraJogo->str = (string)$palavra->str;
                    $PalavraJogo->dicaGenerica = (string)$palavra->dicaGenerica;
                    $PalavraJogo->dicaEspecificaI = (string)$palavra->dicaEspecificaI;
                    $PalavraJogo->dicaEspecificaII = (string)$palavra->dicaEspecificaII;
                    $achou = true;
                }
            }
        }while(!$achou);

        return $PalavraJogo;
    }

    function userGravarDados($tipo){
        $jogador = simplexml_load_file("../xml/jogador.xml");
        $codigo = $_COOKIE["USER"];

        foreach($jogador -> children() as $usuario){
            if($codigo == $usuario->codigo){
                if($tipo == "perdeu"){
                    $usuario->jogos_perdidos++;
                }
                if($tipo == "ganhou"){
                    $usuario->jogos_ganhos++;
                    $usuario->pontuacao += $_SESSION["pontuacao"];

                    $jogosG = $usuario->jogos_ganhos;
                    if($jogosG >= 20){
                        $usuario->trofeus = 'Troféu avançado';
                    }elseif($jogosG >= 10){
                        $usuario->trofeus = 'Troféu intermediário';
                    }elseif($jogosG >= 5){
                        $usuario->trofeus = 'Troféu iniciante';
                    }else{
                        $usuario->trofeus = '-';
                    }
                }
            }
        }

        file_put_contents("../xml/jogador.xml", $jogador->asXML());
    }
 ?>
