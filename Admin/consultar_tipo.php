<!DOCTYPE html>
<?php
require_once '../Controller/TipoCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarAdminLogado();
$ctrl = new TipoCtrl();
$ret = '';
if(isset($_GET['ret']) && is_numeric($_GET['ret'])){
    $ret = $_GET['ret'];
}
if (isset($_POST['btnExcluir'])) {    
    $codigo = $_POST['id_tipo_excluir_popup'];
    $ret = $ctrl->excluirTipo($codigo);
}

$tipos = $ctrl->consultarTipo();
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
                            <h2>Consultar Tipos de Serviço</h2>   
                            <h5>Consultar / Alterar Tipos de Serviços</h5>                            
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />                    
                    <?php if (isset($tipos) && count($tipos) > 0) { ?>
                        <a name="ancora"></a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Tipos de serviço cadastrados
                                    </div>                                    
                                    <div class="panel-body">                                                                                  
                                        <div class="table-responsive">                                        
                                            <table class="table table-striped table-bordered table-hover" id="id_tabela">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>                                                                                                                                                                    
                                                        <th colspan="3">Ação</th>                                           
                                                    </tr>
                                                </thead>
                                                <tbody>                                                
                                                <?php for ($i = 0; $i < count($tipos); $i++) { ?>
                                                        <tr class="odd gradeX">                                                            
                                                            <td><?= $tipos[$i]['nome'] ?></td>                                                    
                                                            <td width="1">
                                                                <input type="hidden" id="nome<?= $i ?>" value="<?= $tipos[$i]['nome']?>">                                                                                                                                
                                                            </td>
                                                            <td width="1">                                                            
                                                                <a href="alterar_tipo.php?cod=<?= $tipos[$i]['codigo'] ?>" class="btn btn-default btn-sm" title="Alterar"><span class="glyphicon glyphicon-pencil"></span></a>
                                                            </td>         
                                                            <td width="1">
                                                                <input type="hidden" id="id_tipo_excluir<?= $i ?>" value="<?= $tipos[$i]['codigo'] ?>">                            
                                                                <button data-toggle="modal" data-target="#popupExcluir" class="btn btn-danger btn-sm" onclick="return CarregarValorExcluir(<?= $i ?>)" title="Excluir"><span class="glyphicon glyphicon-trash"></span></button>                                                            
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
        
        <div class="modal fade" id="popupExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">                        
                    <div class="modal-header">                            
                        <h4>Atenção</h4>                            
                    </div>   
                    <form method="post" action="consultar_tipo.php">
                        <div class="modal-body">                            
                            <div class="form-group">                                    
                                Deseja realmente excluir o Tipo de Serviço?  
                            </div>                                                                                               
                            <div class="form-group">                                
                                <input type="text" id="tipo_excluir" class="form-control" disabled>
                            </div>                                                                                                                                               
                            <input type="hidden" id="id_tipo_excluir_popup" name="id_tipo_excluir_popup">                            
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
            function CarregarValorExcluir(valor) {
                $("#tipo_excluir").val($("#nome" + valor).val());
                $("#id_tipo_excluir_popup").val($("#id_tipo_excluir" + valor).val());                                
                return false;                
            }
        </script>
    </body>   
</html>
