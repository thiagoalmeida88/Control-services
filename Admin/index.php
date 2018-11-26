<!DOCTYPE html>
<?php
require_once '../VO/UsuarioVO.php';
require_once '../Controller/UsuarioCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
//Utils::VerificarLogado();
$ret = '';
$nome = (!empty($_POST['nome'])) ? $_POST['nome'] : null;
$email = (!empty($_POST['email'])) ? $_POST['email'] : null;
$email_registro = (!empty($_POST['email_registro'])) ? $_POST['email_registro'] : null;

if(isset($_POST['btnAcessar'])){
     $ctrl = new UsuarioCtrl();
     
     $email = $_POST['email'];
     $senha = $_POST['senha'];
     
     $ret = $ctrl->validarLogin($email, $senha);
     
     if($ret < 0){
        $senha = null;          
    }
}
else if(isset($_POST['btnRegistrar'])){
    $ctrl = new UsuarioCtrl();
    $vo = new UsuarioVO();    
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email_registro']);
    $vo->setSenha($_POST['senha_registro']);
    $vo->setSenhaConfirma($_POST['senhaconfirma_registro']);  
    $vo->setPerfil(1); // 1 - Usuário
    $vo->setAtivo(0); // 0 - Inativo
    $vo->setCadastro(Utils::DataAtual());    
    $ret = $ctrl->InserirUsuario($vo);     
    
    if($ret > 0){
        $nome = null;
        $email_registro = null;               
    }
 }

?>
<html xmlns="http://www.w3.org/1999/xhtml">    
    <?php include '_head.php'; ?>
    <body>
        <div id="wrapper">            
            <?php
            include '_topo.php';
            ?>  
                <section class="jumbotron">          
                    <div class="container">                       
                      <div class="row text-center">
                            <div class="col-md-12">
                                <br /><br />
                                <h2> Bem-vindo!</h2>                                
                                <br />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>Novo usuário ? Solicite o acesso </strong>  
                                    </div>
                                    <div class="panel-body">  
                                        <?php ExibirMsg($ret) ?>
                                        <form method="post" action="index.php"> 
                                            <div class="col-md-12 col-sm-12">
                                                <div class="panel-body">                                        
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#login" data-toggle="tab" role="tab" title="Se a sua solicitação de acesso foi aprovada, faça o login no sistema" onclick="cleanLogin()">Efetuar Login</a>
                                                        </li>
                                                        <li class=""><a href="#registro" data-toggle="tab" role="tab" title="Se você ainda não possui cadastro, solicite agora mesmo. Caso já tenha solicitado, aguarde a liberação" onclick="cleanRegistro()">Solicitar acesso</a>
                                                        </li>                                
                                                    </ul>
                                                    <br /> 
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active in" id="login">                                                                                                                                  
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon">@</span>
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail" value="<?php echo $email ?>" />                                                            
                                                            </div>
                                                            <div hidden class="form-group" id="val_email" style="color: red"></div>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" />                                                            
                                                            </div>                                                        
                                                            <div hidden class="form-group" id="val_senha" style="color: red"></div>
                                                            <button class="btn btn-success" id="btnAcessar" name="btnAcessar" onclick="return Validar(3)"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Acessar</button>&nbsp;&nbsp;                                                                                                                
                                                        </div>

                                                        <div class="tab-pane fade" id="registro">                                                                                                                        
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" value="<?php echo $nome ?>" />                                                            
                                                            </div>
                                                            <div hidden class="form-group" id="val_nome" style="color: red"></div>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon">@</span>
                                                                <input type="email" class="form-control" id="email_registro" name="email_registro" placeholder="Seu e-mail" value="<?php echo $email_registro ?>" />
                                                            </div>
                                                            <div hidden class="form-group" id="val_email_registro" style="color: red"></div>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                <input type="password" class="form-control" id="senha_registro" name="senha_registro" placeholder="Sua senha" />
                                                            </div>
                                                            <div hidden class="form-group" id="val_senha_registro" style="color: red"></div>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                <input type="password" class="form-control" id="senhaconfirma_registro" name="senhaconfirma_registro" placeholder="Confirme a senha" />
                                                            </div>
                                                            <div hidden class="form-group" id="val_senhaconfirma_registro" style="color: red"></div>
                                                            <button class="btn btn-success" id="btnRegistrar" name="btnRegistrar" onclick="return Validar(4)"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Solicitar Acesso</button>&nbsp;&nbsp;                                                                                                                
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>                            
                                </div>
                            </div>
                        </div>    
                    </div>
                </section>
            <footer class="text-muted">
                <div class="container">            
                    <center>
                        <p>Almeida Tecnologia &copy; 2018 - <i>Todos os direitos reservados</i></p>
                    </center>                
                </div>
            </footer>
        </div>
        <!-- /. WRAPPER  -->        
        <script type="text/javascript">
            function cleanLogin() {
                $('#email').val('');
                $('#senha').val('');
                $('#senhaconfirma').val('');
            }

            function cleanRegistro() {
                $('#nome').val('');
                $('#email_registro').val('');
                $('#senha_registro').val('');
                $('#senhaconfirma_registro').val('');
            }

            $('[data-toggle="tab"]').tooltip({
                trigger: 'hover',
                placement: 'top',
                animate: true,
                delay: 500,
                container: 'body'
            });
        </script>
    </body>
</html>
