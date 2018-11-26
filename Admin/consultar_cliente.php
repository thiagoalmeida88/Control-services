<!DOCTYPE html>
<?php
header( 'refresh: 15; url= "consultar_cliente.php"' );

require_once '../Controller/UsuarioCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarAdminLogado();
$ctrl = new UsuarioCtrl();
$ret = '';
if(isset($_GET['ret']) && is_numeric($_GET['ret'])){
    $ret = $_GET['ret'];
}
if (isset($_POST['btnExcluir'])) {    
    $codigo = $_POST['id_cliente_excluir_popup'];
    $ret = $ctrl->excluirUsuario($codigo);
}
else if (isset($_POST['btnInativar'])) {    
    $codigo = $_POST['id_cliente_inativar_popup'];
    $ret = $ctrl->inativarUsuario($codigo);
}
else if(isset($_POST['btnAtivar'])) {    
    $codigo = $_POST['id_cliente_ativar_popup'];
    $ret = $ctrl->ativarUsuario($codigo);
}
$usuarios = $ctrl->consultarUsuarioTodos();
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
                            <h2>Consultar Usuários</h2>   
                            <h5>Consultar / Alterar Usuários</h5>                            
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />                    
                    <?php if (isset($usuarios) && count($usuarios) > 0) { ?>
                        <a name="ancora"></a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Usuários cadastrados
                                    </div>                                    
                                    <div class="panel-body">                                                                                  
                                        <div class="table-responsive">                                        
                                            <table class="table table-striped table-bordered table-hover" id="id_tabela">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>                                                                                                            
                                                        <th>E-mail</th>                                                                                                            
                                                        <th>Perfil</th>
                                                        <th>Ativo</th>                                                        
                                                        <th>Cadastro</th>                                                        
                                                        <th colspan="3">Ação</th>                                           
                                                    </tr>
                                                </thead>
                                                <tbody>                                                
                                                <?php for ($i = 0; $i < count($usuarios); $i++) { ?>                                                    
                                                        <tr class="odd gradeX">                                                            
                                                            <td><?= $usuarios[$i]['nome'] ?></td>                                                    
                                                            <td><?= $usuarios[$i]['email'] ?></td>
                                                            <td><?= ($usuarios[$i]['perfil'] == 1) ? 'Usuário':'Admin'?></td>
                                                            <td><?= Utils::TratarAtivoTela($usuarios[$i]['ativo'])?></td>
                                                            <td><?= date('d/m/Y H:i:s', strtotime($usuarios[$i]['cadastro'])) ?></td>                                                            
                                                            <td width="1">
                                                                <input type="hidden" id="nome<?= $i ?>" value="<?= $usuarios[$i]['nome']?>">                                                                    
                                                            <?php if($usuarios[$i]['ativo']) { ?>                                                                                                                            
                                                                <input type="hidden" id="id_cliente_inativar<?= $i ?>" value="<?= $usuarios[$i]['codigo'] ?>">                            
                                                                <button data-toggle="modal" data-target="#popupInativar" <?= $usuarios[$i]['codigo'] == 1 && $_SESSION['cod'] != 1?'disabled':'' ?> class="btn btn-warning btn-sm" onclick="return CarregarValorInativar(<?= $i ?>)" title="Inativar"><span class="glyphicon glyphicon-ban-circle"></span></button>                                                            
                                                            <?php }else{ ?>                                                                                                                            
                                                                <input type="hidden" id="id_cliente_ativar<?= $i ?>" value="<?= $usuarios[$i]['codigo'] ?>">                            
                                                                <button data-toggle="modal" data-target="#popupAtivar" <?= $usuarios[$i]['codigo'] == 1 && $_SESSION['cod'] != 1?'disabled':'' ?> class="btn btn-primary btn-sm" onclick="return CarregarValorAtivar(<?= $i ?>)" title="Ativar"><span class="glyphicon glyphicon-ok"></span></button>                                                            
                                                            <?php } ?>
                                                            </td>                                                            
                                                            <td width="1">                                                            
                                                                <a href="alterar_cliente.php?cod=<?= $usuarios[$i]['codigo'] ?>" <?= $usuarios[$i]['codigo'] == 1 && $_SESSION['cod'] != 1?'disabled':'' ?> class="btn btn-default btn-sm" title="Alterar"><span class="glyphicon glyphicon-pencil"></span></a>
                                                            </td>                                                                     
                                                            <td width="1">
                                                                <input type="hidden" id="id_cliente_excluir<?= $i ?>" value="<?= $usuarios[$i]['codigo'] ?>">                            
                                                                <button data-toggle="modal" data-target="#popupExcluir" class="btn btn-danger btn-sm" <?= $usuarios[$i]['codigo'] == 1 && $_SESSION['cod'] != 1?'disabled':'' ?> onclick="return CarregarValorExcluir(<?= $i ?>)" title="Excluir"><span class="glyphicon glyphicon-trash"></span></button>                                                            
                                                            </td>                                    
                                                        </tr>                                                    
                                                 <?php } ?>
                                                </tbody>
                                            </table>                
                                        </div>                                        
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    <?php } else { ?>
                        <center><div class="alert alert-info">Nenhum registro para ser exibido</div></center>
                    <?php } ?>                                        
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->  
        
        <div class="modal fade" id="popupAtivar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">                        
                    <div class="modal-header">                            
                        <h4>Atenção</h4>                            
                    </div>   
                    <form method="post" action="consultar_cliente.php">
                        <div class="modal-body">                            
                            <div class="form-group">                                    
                                Deseja realmente ativar o usuário?  
                            </div>                                                                                               
                            <div class="form-group">                                
                                <input type="text" id="cliente_ativar" class="form-control" disabled>
                            </div>                                                                                                                                               
                            <input type="hidden" id="id_cliente_ativar_popup" name="id_cliente_ativar_popup">                            
                        </div>                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                            <button class="btn btn-primary" name="btnAtivar">Sim</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="popupInativar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">                        
                    <div class="modal-header">                            
                        <h4>Atenção</h4>                            
                    </div>   
                    <form method="post" action="consultar_cliente.php">
                        <div class="modal-body">                            
                            <div class="form-group">                                    
                                Deseja realmente inativar o usuário?  
                            </div>                                                                                               
                            <div class="form-group">                                
                                <input type="text" id="cliente_inativar" class="form-control" disabled>
                            </div>                                                                                                                                               
                            <input type="hidden" id="id_cliente_inativar_popup" name="id_cliente_inativar_popup">                            
                        </div>                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                            <button class="btn btn-primary" name="btnInativar">Sim</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="popupExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">                        
                    <div class="modal-header">                            
                        <h4>Atenção</h4>                            
                    </div>   
                    <form method="post" action="consultar_cliente.php">
                        <div class="modal-body">                            
                            <div class="form-group">                                    
                                Deseja realmente excluir o usuário?  
                            </div>                                                                                               
                            <div class="form-group">                                
                                <input type="text" id="cliente_excluir" class="form-control" disabled>
                            </div>                                                                                                                                               
                            <input type="hidden" id="id_cliente_excluir_popup" name="id_cliente_excluir_popup">                            
                        </div>                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                            <button class="btn btn-primary" name="btnExcluir">Sim</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">                                                                 
            function CarregarValorAtivar(valor) {
                $("#cliente_ativar").val($("#nome" + valor).val());
                $("#id_cliente_ativar_popup").val($("#id_cliente_ativar" + valor).val());                                
                return false;                
            }            
            function CarregarValorInativar(valor) {
                $("#cliente_inativar").val($("#nome" + valor).val());
                $("#id_cliente_inativar_popup").val($("#id_cliente_inativar" + valor).val());                                
                return false;                
            }
            function CarregarValorExcluir(valor) {
                $("#cliente_excluir").val($("#nome" + valor).val());
                $("#id_cliente_excluir_popup").val($("#id_cliente_excluir" + valor).val());                                
                return false;                
            }
            
        </script>
    </body>   
</html>
