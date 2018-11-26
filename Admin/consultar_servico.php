<!DOCTYPE html>
<?php
require_once '../Controller/ServicoCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarUserLogado();
$ctrl = new ServicoCtrl();
$ret = '';
$datainicial = '';
$datafinal = '';

if(isset($_GET['ret']) && is_numeric($_GET['ret'])){
    $ret = $_GET['ret'];
}
if(isset($_GET['btnPesquisar'])){
    $ctrl = new ServicoCtrl();
    
    $datainicial = $_GET['datainicial'];
    $datafinal = $_GET['datafinal'];
    
    $servicos = $ctrl->filtrarServicos($datainicial, $datafinal);
    
    if($servicos == Messages::DataInvalida){
        $ret = $servicos;
        $servicos = $ctrl->consultarServico();          
    }elseif($servicos == Messages::CamposObrigatorios){
        $servicos = $ctrl->consultarServico();          
    }
}
else if (isset($_POST['btnExcluir'])) {    
    $codigo = $_POST['id_servico_excluir_popup'];
    $ret = $ctrl->excluirServico($codigo);
}
else{
    $servicos = $ctrl->consultarServico();
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
                            <h2>Consultar Serviços</h2>   
                            <h5>Consultar / Alterar Serviços</h5>                            
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="get" action="consultar_servico.php">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Pesquisar por período
                                </div>
                            <div class="panel-body">                                
                                <div class="row">                                    
                                    <div class="col-md-6">                                            
                                        <div class="form-group">
                                            <label>Data inicial</label>                                                                             
                                            <input type="text" class="form-control date num datapree" id="datainicial" name="datainicial" maxlength="10" placeholder="Data inicial do serviço" value="<?php echo $datainicial ?>" />                                                                                                                                                                                    
                                            <div hidden class="form-group" id="val_data" style="color: red"></div>
                                        </div>                                                    
                                    </div>                                                                                             
                                    <div class="col-md-6">                                               
                                        <div class="form-group">
                                            <label>Data final</label>                                                                             
                                            <input type="text" class="form-control date num datapree" id="datafinal" name="datafinal" maxlength="10" placeholder="Data final do serviço" value="<?php echo $datafinal ?>" />                                                                                                                                                                                    
                                            <div hidden class="form-group" id="val_data" style="color: red"></div>
                                        </div>                                                  
                                    </div>                                        
                               </div>                                                                                                 
                                <button class="btn btn-primary" title="Pesquisar" name="btnPesquisar" onclick="return Validar(6)"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Pesquisar</button>                            
                            </div>
                        </div>
                    </div>
                    </div>
                    </form>                    
                    <?php if (isset($servicos) && count($servicos) > 0) { ?>
                        <a name="ancora"></a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Serviços cadastrados
                                    </div>                                    
                                    <div class="panel-body">                                                                                  
                                        <div class="table-responsive">                                        
                                            <table class="table table-striped table-bordered table-hover" id="id_tabela">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>                                                                                                            
                                                        <th>Descrição</th>                                                                                                                                                                    
                                                        <th>Data</th>                                                        
                                                        <th>Valor</th>                                                                                                                
                                                        <th colspan="3">Ação</th>                                           
                                                    </tr>
                                                </thead>
                                                <tbody>   
                                                <?php $soma = 0; ?>
                                                <?php for ($i = 0; $i < count($servicos); $i++) { ?>
                                                        <tr class="odd gradeX">                                                            
                                                            <td><?= $servicos[$i]['nome'] ?></td>                                                    
                                                            <td><?= $servicos[$i]['descricao'] ?></td>                                                            
                                                            <td><?= date('d/m/Y', strtotime($servicos[$i]['dataservico'])) ?></td>                                                                                                                        
                                                            <td><?= Utils::TratarValorTela($servicos[$i]['valor']) ?></td>                                                            
                                                            <input type="hidden" id="nome<?= $i ?>" value="<?= $servicos[$i]['nome']?>">                                                            
                                                            <td width="1">                                                            
                                                                <a href="alterar_servico.php?cod=<?= $servicos[$i]['codigo'] ?>" class="btn btn-default btn-sm" title="Alterar"><span class="glyphicon glyphicon-pencil"></span></a>
                                                            </td>         
                                                            <td width="1">
                                                                <input type="hidden" id="id_servico_excluir<?= $i ?>" value="<?= $servicos[$i]['codigo'] ?>">                            
                                                                <button data-toggle="modal" data-target="#popupExcluir" class="btn btn-danger btn-sm" onclick="return CarregarValorExcluir(<?= $i ?>)" title="Excluir"><span class="glyphicon glyphicon-trash"></span></button>                                                            
                                                            </td>                                    
                                                        </tr>
                                                 <?php $soma += $servicos[$i]['valor'];} ?>
                                                        <tr>
                                                            <td class="text-right" colspan="3"><b>Total:</b></td>
                                                            <td><b><?= Utils::TratarValorTela($soma) ?></b></td>    
                                                        </tr>
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
                    <form method="post" action="consultar_servico.php">
                        <div class="modal-body">                            
                            <div class="form-group">                                    
                                Deseja realmente excluir o serviço?  
                            </div>                                                                                               
                            <div class="form-group">                                
                                <input type="text" id="servico_excluir" class="form-control" disabled>
                            </div>                                                                                                                                               
                            <input type="hidden" id="id_servico_excluir_popup" name="id_servico_excluir_popup">                            
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
                $("#servico_excluir").val($("#nome" + valor).val());
                $("#id_servico_excluir_popup").val($("#id_servico_excluir" + valor).val());                                
                return false;                
            }
            
        </script>
    </body>   
</html>
