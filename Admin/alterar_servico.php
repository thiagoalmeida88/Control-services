<!DOCTYPE html>
<?php
require_once '../VO/ServicoVO.php';
require_once '../Controller/ServicoCtrl.php';
require_once '../Controller/TipoCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarUserLogado();
$ctrlTipo = new TipoCtrl();
$cod_tipo = '';
$ret = '';
if(isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod'])){

    $ret = isset($_GET['ret']) ? $_GET['ret'] : '';    
    
    $cod = $_GET['cod'];
    $ctrl = new ServicoCtrl();
    
    $dados = $ctrl->detalhesServico($cod);
    
    if(count($dados) == 0){
        header('location: consultar_servico.php');
    }    
    
    $cod_tipo = $dados[0]['CodTipo'];
}
else if(isset($_POST['btnGravar'])){
    $ctrl = new ServicoCtrl();
    $vo = new ServicoVO();    
    $vo->setCodigo($_POST['codigo']);
    $cod_tipo = $_POST['tipo'];
    $vo->setCodTipo($cod_tipo);
    $vo->setDescricao($_POST['descricao']);
    $vo->setValor($_POST['valor']);
    $vo->setDataservico($_POST['data']);          
    $ret = $ctrl->alterarServico($vo);   
    
    header('location: alterar_servico.php?cod=' . $_POST['codigo'] . '&ret=' . $ret);
 }
 else{
    header('location: consultar_servico.php'); 
 }
$tipos = $ctrlTipo->consultarTipo();
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
                           <h2>Alterar Serviço</h2>          
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="alterar_servico.php">        
                        <input type="hidden" name="codigo" value="<?= $dados[0]['codigo']?>">
                        <div class="row">                                                        
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Dados do Serviço
                                    </div>
                                    <div class="panel-body">                                        
                                        <div class="form-group">
                                            <label>Tipo do Serviço</label>
                                            <select class="form-control" id="tipo" name="tipo">                                                
                                                <?php for($i = 0; $i < count($tipos); $i++) { ?>                             
                                                    <option value="<?= $tipos[$i]['codigo'] ?>"<?php if ($tipos[$i]['codigo'] == $cod_tipo) echo 'selected' ?>>
                                                        <?= $tipos[$i]['nome'] ?>
                                                    </option>                                    
                                                <?php } ?>
                                            </select>                                            
                                            <div hidden id="val_tipo" style="color: red"></div>
                                        </div>
                                        <div class="form-group">
                                        <label>Descrição</label>
                                            <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="100" placeholder="Descrição do serviço"><?= $dados[0]['descricao'] ?></textarea>
                                            <div hidden id="val_descricao" style="color: red"></div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Valor</label>                                            
                                            <input type="text" class="form-control money num" id="valor" name="valor" placeholder="Valor do serviço" value="<?= $dados[0]['valor'] ?>" />                                            
                                            <div hidden id="val_valor" style="color: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data</label>                                                                             
                                            <input type="text" class="form-control date num datapree" id="data" name="data" maxlength="10" placeholder="Data do serviço" value="<?= date('d/m/Y', strtotime($dados[0]['dataservico'])) ?>" />                                                                                                                                                                                    
                                            <div hidden class="form-group" id="val_data" style="color: red"></div>
                                        </div>                                                                                
                                    </div>
                                </div>               
                                <button class="btn btn-default" title="Voltar" name="btnVoltat"><span class="glyphicon glyphicon-arrow-left"></span></button> 
                                <button class="btn btn-success" title="Gravar" name="btnGravar" onclick="return Validar(5)"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Gravar</button>                            
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