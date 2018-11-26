<!DOCTYPE html>
<?php
require_once '../Controller/ServicoCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarAdminLogado();
$ctrl = new ServicoCtrl();
$ret = '';
$datainicial = '';
$datafinal = '';

if(isset($_GET['btnPesquisar'])){
    $ctrl = new ServicoCtrl();
    
    $datainicial = $_GET['datainicial'];
    $datafinal = $_GET['datafinal'];
    
    $servicos = $ctrl->filtrarServicosTodos($datainicial, $datafinal);
    
    if($servicos == Messages::UsuarioNaoAutorizado){
        Utils::Deslogar();     
    }elseif($servicos == Messages::DataInvalida){
        $ret = $servicos;
        $servicos = $ctrl->consultarServicoTodos();        
    }elseif($servicos == Messages::CamposObrigatorios){
        $servicos = $ctrl->consultarServicoTodos();          
    }
}
else{
    $servicos = $ctrl->consultarServicoTodos();
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
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="get" action="servicos_cliente.php">                    
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
                                                        <th>Usuário</th>                                                                                                            
                                                        <th>Tipo</th>                                                                                                            
                                                        <th>Descrição</th>                                                                                                                                                                    
                                                        <th>Data Serviço</th>                                                                                                                
                                                        <th>Valor</th>                                                                                                                
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $soma = 0; ?>
                                                <?php for ($i = 0; $i < count($servicos); $i++) { ?>
                                                        <tr class="odd gradeX">                                                            
                                                            <td><?= $servicos[$i]['cliente'] ?></td>                                                    
                                                            <td><?= $servicos[$i]['nome'] ?></td>                                                    
                                                            <td><?= $servicos[$i]['descricao'] ?></td>                                                            
                                                            <td><?= date('d/m/Y', strtotime($servicos[$i]['dataservico'])) ?></td>                                                                                                                                                                                                                        
                                                            <td><?= Utils::TratarValorTela($servicos[$i]['valor']) ?></td>                                                            
                                                        </tr>                                                 
                                                 <?php $soma += $servicos[$i]['valor'];} ?>
                                                        <tr>
                                                            <td class="text-right" colspan="4"><b>Total:</b></td>
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
    </body>   
</html>
