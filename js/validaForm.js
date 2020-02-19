function admValidaForm(){
    var str = document.getElementById("palavra").value;

    if(str == ""){
        window.alert("Campo palavra é obrigatório");
        return false;
    }else{
        var str = document.getElementById("dicaGenerica").value;

        if(str == ""){
            window.alert("Campo dica genérica é obrigatório");
            return false;
        }else{
            var str = document.getElementById("dicaEspecificaI").value;

            if(str == ""){
                window.alert("Campo dica específica 1 é obrigatório");
                return false;
            }else{
                var str = document.getElementById("dicaEspecificaII").value;

                if(str == ""){
                    window.alert("Campo dica específica 2 é obrigatório");
                    return false;
                }
            }
        }
    }
}

function admValidaPalavra(){
    var str = document.getElementById("palavra").value;

    if(str == ""){
        document.getElementById("erroPalavra").innerHTML = "Campo Obrigatório";
        return false;
    }else{
        document.getElementById("erroPalavra").innerHTML = "";
        return true;
    }
}
function admValidaDicaGenerica(){
    var str = document.getElementById("dicaGenerica").value;

    if(str == ""){
        document.getElementById("erroDicaGenerica").innerHTML = "Campo Obrigatório";
        return false;
    }else{
        document.getElementById("erroDicaGenerica").innerHTML = "";
        return true;
    }
}
function admValidaDicaEspecificaI(){
    var str = document.getElementById("dicaEspecificaI").value;

    if(str == ""){
        document.getElementById("erroDicaEspecificaI").innerHTML = "Campo Obrigatório";
        return false;
    }else{
        document.getElementById("erroDicaEspecificaI").innerHTML = "";
        return true;
    }
}
function admValidaDicaEspecificaII(){
    var str = document.getElementById("dicaEspecificaII").value;

    if(str == ""){
        document.getElementById("erroDicaEspecificaII").innerHTML = "Campo Obrigatório";
        return false;
    }else{
        document.getElementById("erroDicaEspecificaII").innerHTML = "";
        return true;
    }
}

function validanome()
{
    var nome = document.getElementById("nome").value;
    if(nome == "")
    {
        document.getElementById("erronome").innerHTML =
        "Nome obrigatório!";
        return false;
    }else{
        document.getElementById("erronome").innerHTML =
        "";
    }
    return true;
}

function validaemail()
{
    var email = document.getElementById("email").value;
    if(email == "")
    {
        document.getElementById("erroemail").innerHTML =
        "E-mail obrigatório!";
        return false;
    }else{
        document.getElementById("erroemail").innerHTML =
        "";
    }
    return true;
}


function validasenha()
{
    var senha = document.getElementById("senhaNova").value;
    if(senha == "")
    {
        document.getElementById("errosenha").innerHTML =
        "Senha obrigatória!";
        return false;
    }else{
        document.getElementById("errosenha").innerHTML =
        "";
    }
    return true;
}

function validaForm(){
    var flag = true;

    var nome = document.getElementById("nome").value;
    if(nome == "")
    {
        document.getElementById("erronome").innerHTML =
        "Nome obrigatório!";
        flag = false;
    }else{
        var email = document.getElementById("email").value;
        if(email == "")
        {
            document.getElementById("erroemail").innerHTML =
            "E-mail obrigatório!";
            flag = false;
        }else{
            var senha = document.getElementById("senhaNova").value;
            if(senha == "")
            {
                document.getElementById("errosenha").innerHTML =
                "Senha obrigatória!";
                flag = false;
            }
            else
            {
                var confSenha = document.getElementById("confSenha").value;
                var senha = document.getElementById("senhaNova").value;

                if(senha != confSenha)
                {
                     document.getElementById("erroconfSenha").innerHTML =
                     "As senhas não correspondem!";
                     flag = false;
               }
            }
        }
    }

    return flag;
}

function validaconfSenha()
{
    var confSenha = document.getElementById("confSenha").value;
    var senha = document.getElementById("senhaNova").value;

    if(senha != confSenha)
    {
        document.getElementById("erroconfSenha").innerHTML =
        "As senhas não correspondem!";
    }else{
        document.getElementById("erroconfSenha").innerHTML =
        "";
    }
}

function admExcluirPalavraAlert(codigoPalavra){
    if(confirm("Deseja excluir a palavra?")){
        window.location.href = "../php/admExcluirPalavra.php?codigo=" + codigoPalavra;
    }else{
        window.location.href = "../php/admListaPalavras.php";
    }
}

function admEditarPalavra(codigoPalavra){
    window.location.href = "../php/admCadastroPalavras.php?codigo=" + codigoPalavra;
}

function admExcluirJogadorAlert(codigoJogador){
    if(confirm("Deseja excluir o jogador?")){
        window.location.href = "../php/admExcluirJogador.php?codigo=" + codigoJogador;
    }else{
        window.location.href = "../php/admListaUsuario.php";
    }
}

function batata(codigo, nome, email){
    document.getElementById('codigo').value=codigo;
    document.getElementById('nome').value=nome;
    document.getElementById('email').value=email;
    document.getElementById('modo').value = 1;

    $('#NovoUsuario').modal();
}
