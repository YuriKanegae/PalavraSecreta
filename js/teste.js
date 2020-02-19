function gerarModal(codigo, nome, email){
    document.getElementById('codigo').value=codigo;
    document.getElementById('nome').value=nome;
    document.getElementById('email').value=email;
    document.getElementById('modo').value = 1;

    $('#NovoUsuario').modal();
}
