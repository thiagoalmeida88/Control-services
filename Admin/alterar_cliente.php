<!DOCTYPE html>
<?php
require_once '../VO/UsuarioVO.php';
require_once '../Controller/UsuarioCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarAdminLogado();

$ret = '';

if(isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod'])){

    $ret = isset($_GET['ret']) ? $_GET['ret'] : '';    
    
    $cod = $_GET['cod'];
    $ctrl = new UsuarioCtrl();
    
    $dados = $ctrl->detalhesUsuario($cod);
    
    if(count($dados) == 0 || ($dados[0]['codigo'] == 1 && $_SESSION['cod'] != 1)){
        header('location: consultar_cliente.php');
    }    
}
else if(isset($_POST['btnGravar'])){
    $ctrl = new UsuarioCtrl();
    $vo = new UsuarioVO();    
    $vo->setCodigo($_POST['codigo']);
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email']);
    $vo->setSenha($_POST['senha']);
    $vo->setSenhaConfirma($_POST['senhaconfirma']); 
    $vo->setPerfil($_POST['perfil']);
    $vo->setAtivo(isset($_POST['ativo']) ? 1 : 0);    
    $ret = $ctrl->alterarUsuario($vo);   
    
    header('location: alterar_cliente.php?cod=' . $_POST['codigo'] . '&ret=' . $ret);
 }
 else{
    header('location: consultar_cliente.php'); 
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
                           <h2>Alterar Usuário</h2>          
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="alterar_cliente.php">        
                        <input type="hidden" name="codigo" value="<?= $dados[0]['codigo']?>">
                        <div class="row">                                                        
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Dados do Usuário
                                    </div>
                                    <div class="panel-body">                                        
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input class="form-control" id="nome" name="nome" maxlength="50" placeholder="Nome" value="<?= $dados[0]['nome'] ?>"/>                            
                                            <div hidden id="val_nome" style="color: red"></div>
                                        </div>                                                 
                                        <div class="form-group">                                            
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Email" value="<?= $dados[0]['email'] ?>" />                                                                                                
                                            <div hidden class="form-group" id="val_email" style="color: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Perfil</label>                                                                             
                                            <select class="form-control" id="perfil" name="perfil">
                                                <option value="">Selecione</option>                                                     
                                                <option value="1"<?php if($dados[0]['perfil'] == 1) {echo "selected";}?>>Usuário</option>                                                     
                                                <option value="2"<?php if($dados[0]['perfil'] == 2) {echo "selected";}?>>Administrador</option>                                                     
                                            </select>                                                                                      
                                            <div hidden class="form-group" id="val_perfil" style="color: red"></div>
                                        </div>
                                        <div class="form-group">                                            
                                            <label>Senha</label>
                                            <input type="password" class="form-control" id="senha" maxlength="15" name="senha" placeholder="Senha" value="<?= $dados[0]['senha'] ?>" />                                                                                                
                                            <div hidden class="form-group" id="val_senha" style="color: red"></div>
                                        </div>
                                        <div class="form-group">                                            
                                            <label>Senha confirma</label>
                                            <input type="password" class="form-control" id="senhaconfirma" maxlength="15" name="senhaconfirma" placeholder="Confirme a senha" value="<?= $dados[0]['senha'] ?>" />                                                                                                
                                            <div hidden class="form-group" id="val_senhaconfirma" style="color: red"></div>
                                        </div>                                                                                
                                        <div class="form-group">
                                            <div class="checkbox">                               
                                                <label>                                                       
                                                    <b><input type="checkbox" <?= ($dados[0]['ativo'] == 0) ? 'unchecked':'checked' ?> id="ativo" name="ativo" value="<?= $dados[0]['ativo'] ? '1' : '0' ?>" />Ativo</b>                                
                                                </label>                     
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>               
                                <button class="btn btn-default" title="Voltar" name="btnVoltat"><span class="glyphicon glyphicon-arrow-left"></span></button> 
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