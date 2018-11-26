<!DOCTYPE html>
<?php
require_once '../VO/ServicoVO.php';
require_once '../Controller/ServicoCtrl.php';
require_once '../Controller/TipoCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarUserLogado();
$ctrlTipo = new TipoCtrl();
$ret = '';
$cod_tipo = '';
$descricao = (!empty($_POST['descricao'])) ? $_POST['descricao'] : null;
$valor = (!empty($_POST['valor'])) ? $_POST['valor'] : null;
$data = (!empty($_POST['data'])) ? $_POST['data'] : null;

if(isset($_POST['btnGravar'])){
    $ctrl = new ServicoCtrl();
    $vo = new ServicoVO();    
    $cod_tipo = $_POST['tipo'];
    $vo->setCodTipo($cod_tipo);
    $vo->setDescricao($_POST['descricao']);
    $vo->setValor($_POST['valor']);
    $vo->setDataservico($_POST['data']);
    $vo->setCadastro(Utils::DataAtual());      
    $ret = $ctrl->InserirServico($vo);     
    
    if($ret > 0){
        $cod_tipo = null;
        $descricao = null;
        $valor = null;
        $data = null;        
    }
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
                           <h2>Novo Serviço</h2>          
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="novo_servico.php">                        
                        <div class="row">                                                        
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Dados do serviço
                                    </div>
                                    <div class="panel-body">                                        
                                        <div class="form-group">
                                            <label>Tipo do Serviço</label>
                                            <select class="form-control" id="tipo" name="tipo">
                                                <option value="">Selecione</option>   
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
                                            <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="100" placeholder="Descrição do serviço"><?php echo $descricao ?></textarea>
                                            <div hidden id="val_descricao" style="color: red"></div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Valor</label>                                            
                                            <input type="text" class="form-control money num" id="valor" name="valor" placeholder="Valor do serviço" value="<?php echo $valor ?>" />                                            
                                            <div hidden id="val_valor" style="color: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data</label>                                                                             
                                            <input type="text" class="form-control date num datapree" id="data" name="data" maxlength="10" placeholder="Data do serviço" value="<?php echo $data ?>" />                                                                                                                                                                                    
                                            <div hidden class="form-group" id="val_data" style="color: red"></div>
                                        </div>                                                                                
                                    </div>
                                </div>                                
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