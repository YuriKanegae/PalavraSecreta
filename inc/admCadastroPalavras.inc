<h2 class = "text-center">Cadastre uma palavra</h2>
<form action = "admCadastroPalavras.php" method = "POST" onsubmit = "return admValidaForm();">
    <div class = "row" style = "margin-top: 30px;">
            <div class = "form-group col-2 offset-3">
                <input class = "form-control" type = "text" name = "codigo" readonly = "readonly" id = "codigo"
                    <?php
                        if($alterar){
                            echo 'value= "'.$codigo.'"';
                        }else{
                            $novoCodigo = admObterCodigo("palavra");
                            echo "value=\"$novoCodigo\"";
                        }
                    ?>
                />
            </div>
            <div class = "form-group col-4">
                <input class = "form-control" type = "text" name = "palavra" placeholder = "Palavra" id = "palavra" onfocus = "admValidaPalavra()" onchange = "admValidaPalavra()"
                    <?php
                        if($alterar){
                            echo 'value= "'.$str.'"';
                        }
                     ?>
                />
                <span id = "erroPalavra"></span>
            </div>
    </div>
    <div class = "row">
        <div class = "form-group col-6 offset-3">
            <input class = "form-control" type = "text" name = "dicaGenerica" id = "dicaGenerica" placeholder = "Dica genérica" onfocus = "admValidaDicaGenerica()" onchange = "admValidaDicaGenerica()"
                <?php
                    if($alterar){
                        echo 'value= "'.$dicaGenerica.'"';
                    }
                 ?>
            />
            <span id = "erroDicaGenerica"></span>
        </div>
    </div>
    <div class = "row">
        <div class = "form-group col-6 offset-3">
            <input class = "form-control" type = "text" name = "dicaEspecificaI" id = "dicaEspecificaI" placeholder = "Dica específica 1" onfocus = "admValidaDicaEspecificaI()" onchange = "admValidaDicaEspecificaI()"
                <?php
                    if($alterar){
                        echo 'value= "'.$dicaEspecificaI.'"';
                    }
                 ?>
            />
            <span id = "erroDicaEspecificaI"></span>
        </div>
    </div>
    <div class = "row">
        <div class = "form-group col-6 offset-3">
            <input class = "form-control" type = "text" name = "dicaEspecificaII" id = "dicaEspecificaII" placeholder = "Dica específica 2" onfocus = "admValidaDicaEspecificaII()" onchange = "admValidaDicaEspecificaII()"
                <?php
                    if($alterar){
                        echo 'value= "'.$dicaEspecificaII.'"';
                    }
                 ?>
            />
            <span id = "erroDicaEspecificaII"></span>
        </div>
    </div>
    <div class = "row">
        <div class = "form-group col-6 offset-3">
            <div class = "float-left">
                <button type = "reset" class = "btn btn-danger">
                    Limpar
                </button>
            </div>
            <div class = "float-right">
                <button type = "submit" class = "btn btn-primary">
                    Cadastrar
                </button>
            </div>
        </div>
    </div>
    <?php
        if($alterar){
            echo'<input type = "hidden" name = "atualizaPalavra" value = "true"/>';
        }else{
            echo'<input type = "hidden" name = "atualizaPalavra" value = "false"/>';
        }
     ?>
</form>
