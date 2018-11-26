<!DOCTYPE html>
<?php
require_once '../VO/TipoVO.php';
require_once '../Controller/TipoCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarAdminLogado();
$ret = '';

if(isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod'])){

    $ret = isset($_GET['ret']) ? $_GET['ret'] : '';    
    
    $cod = $_GET['cod'];
    $ctrl = new TipoCtrl();
    
    $dados = $ctrl->detalhesTipo($cod);
    
    if(count($dados) == 0){
        header('location: consultar_Tipo.php');
    }    
}
else if(isset($_POST['btnGravar'])){
    $ctrl = new TipoCtrl();
    $vo = new TipoVO();    
    $vo->setCodigo($_POST['codigo']);
    $vo->setNome($_POST['nome']);
    $ret = $ctrl->alterarTipo($vo);   
    
    header('location: alterar_tipo.php?cod=' . $_POST['codigo'] . '&ret=' . $ret);
 }
 else{
    header('location: consultar_tipo.php'); 
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
                           <h2>Alterar Tipos de Serviço</h2>          
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="alterar_tipo.php">        
                        <input type="hidden" name="codigo" value="<?= $dados[0]['codigo']?>">
                        <div class="row">                                                        
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Dados dos Tipos de Serviço
                                    </div>
                                    <div class="panel-body">                                        
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input class="form-control" id="nome" name="nome" maxlength="50" placeholder="Nome" value="<?= $dados[0]['nome'] ?>"/>                            
                                            <div hidden id="val_nome" style="color: red"></div>
                                        </div>                                                 
                                    </div>
                                </div>               
                                <button class="btn btn-default" title="Voltar" name="btnVoltat"><span class="glyphicon glyphicon-arrow-left"></span></button> 
                                <button class="btn btn-success" title="Gravar" name="btnGravar" onclick="return Validar(2)"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Gravar</button>                            
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