<!DOCTYPE html>
<?php
require_once '../VO/UsuarioVO.php';
require_once '../Controller/UsuarioCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarAdminLogado();
$ret = '';
$nome = (!empty($_POST['nome'])) ? $_POST['nome'] : null;
$email = (!empty($_POST['email'])) ? $_POST['email'] : null;
$perfil = (!empty($_POST['perfil'])) ? $_POST['perfil'] : -1;

if(isset($_POST['btnGravar'])){
    $ctrl = new UsuarioCtrl();
    $vo = new UsuarioVO();    
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email']);
    $vo->setSenha($_POST['senha']);
    $vo->setSenhaConfirma($_POST['senhaconfirma']); 
    $vo->setPerfil($_POST['perfil']);
    $vo->setAtivo(isset($_POST['ativo']) ? 1 : 0);
    $vo->setCadastro(Utils::DataAtual());    
    $ret = $ctrl->InserirUsuario($vo);     
    
    if($ret > 0){
        $nome = null;
        $email = null;
        $perfil = -1;        
    }
 }

?>
<html xmlns="http://www.w3.org/1999/xhtml">    
    <?php include '_head.php'; ?>
    <body>
        <div id="wrapper">
            <?php
                include '_topo.php';
                include '_menu.php';
            ?>            
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php ExibirMsg($ret) ?>
                           <h2>Novo Usuário</h2>          
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="novo_cliente.php">                        
                        <div class="row">                                                        
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Dados do usuário
                                    </div>
                                    <div class="panel-body">                                        
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input class="form-control" id="nome" name="nome" maxlength="50" placeholder="Nome" value="<?php echo $nome ?>"/>                            
                                            <div hidden id="val_nome" style="color: red"></div>
                                        </div>                                                 
                                        <div class="form-group">                                            
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Email" value="<?php echo $email ?>" />                                                                                                
                                            <div hidden class="form-group" id="val_email" style="color: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Perfil</label>                                                                             
                                            <select class="form-control" id="perfil" name="perfil">
                                                <option value="">Selecione</option>                                                     
                                                <option value="1"<?php if($perfil == 1) {echo "selected";}?>>Usuário</option>                                                     
                                                <option value="2"<?php if($perfil == 2) {echo "selected";}?>>Administrador</option>                                                     
                                            </select>                                                                                      
                                            <div hidden class="form-group" id="val_perfil" style="color: red"></div>
                                        </div>
                                        <div class="form-group">                                            
                                            <label>Senha</label>
                                            <input type="password" class="form-control" id="senha" maxlength="15" name="senha" placeholder="Senha" />                                                                                                
                                            <div hidden class="form-group" id="val_senha" style="color: red"></div>
                                        </div>
                                        <div class="form-group">                                            
                                            <label>Senha confirma</label>
                                            <input type="password" class="form-control" id="senhaconfirma" maxlength="15" name="senhaconfirma" placeholder="Confirme a senha" />                                                                                                
                                            <div hidden class="form-group" id="val_senhaconfirma" style="color: red"></div>
                                        </div>                                                                                
                                        <div class="form-group">
                                            <div class="checkbox">                               
                                                <label>                                                       
                                                    <b><input type="checkbox" checked="true" id="ativo" name="ativo" value="1" />Ativo</b>                                
                                                </label>                     
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>                                
                                <button class="btn btn-success" title="Gravar" name="btnGravar" onclick="return Validar(1)"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Gravar</button>                            
                            </div>                            
                        </div>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->    
    </body>   
</html>