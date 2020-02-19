<!--Modal-->
<?php
echo'
  <div class = "modal" tabindex = "-1" role = "dialog" id = "NovoUsuario">
      <div class = "modal-dialog">
          <div class = "modal-content">
              <!--Cabeçalho-->
              <div class = "modal-header">
                  <h5 class = "modal-title">Novo Usuário</h5>
                  <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                      <span aria-hidden = "true">&times;</span>
                  </button>
              </div>

              <form action = "../php/userChecaLogin.php" method = "POST" onsubmit = "return validaForm()">
                  <!--Corpo-->
                  <div class = "modal-body">
                      <div class = "row">
                          <div class = "form-group col-sm-6 col-12">
                                  <label for = "codigo">Código</label>
                                  <input type = "text" name = "codigo"  id = "codigo" class = "form-control"  readonly = "readonly"
                                  ';
                                      $codigoUsuario = admObterCodigo('usuario');
                                      echo "value = \"$codigoUsuario\"";
                                  echo'
                                  />
                           </div>
                          <div class="form-group col-sm-6 col-12">
                              <label for = "nome">Nome</label>
                              <input type = "text" name = "nome" id = "nome" class = "form-control" onfocusout = "validanome()"/>
                              <span id = "erronome"></span>
                          </div>
                      </div>
                      <div class = "row">
                          <div class = "form-group col-sm-12">
                              <label for = "email" class = "control-label">E-mail</label>
                              <input type = "email" name = "email" id = "email" class = "form-control" onfocusout = "validaemail()"/>
                              <span id = "erroemail"></span>
                          </div>
                      </div>
                      <div class = "row">
                          <div class = "form-group col-sm-6 col-sm-12">
                              <label for = "senha">Senha</label>
                              <input type = "password"  class = "form-control password" name = "senhaNova" id="senhaNova" onfocusout = "validasenha()"/>
                              <span id = "errosenha"></span>
                          </div>
                       </div>
                       <div class = "row">
                          <div class = "form-group col-sm-6 col-sm-12">
                              <label for = "confSenha">Confirmação de Senha</label>
                              <input type = "password"  class = "form-control password" name = "confSenha" id = "confSenha" onfocusout = "validaconfSenha()"/>
                              <span id = "erroconfSenha"></span>
                          </div>
                       </div>
                  </div>
                  <input type = "hidden" name = "modo" id = "modo" value = "0"/>
                  <!--Rodapé-->
                  <div class = "modal-footer">
                      <button type = "reset" class = "btn btn-danger">Limpar</button>
                      <button type = "submit" class = "btn btn-primary">Salvar</button>
                  </div>

              </form>
          </div>
      </div>
  </div>
';
?>
