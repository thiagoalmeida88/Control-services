<!DOCTYPE html>
<?php
require_once '../VO/TipoVO.php';
require_once '../Controller/TipoCtrl.php';
require_once '../Helpers/Utils.php';
require_once '_msg.php';
Utils::VerificarAdminLogado();
$ret = '';
$nome = (!empty($_POST['nome'])) ? $_POST['nome'] : null;

if(isset($_POST['btnGravar'])){
    $ctrl = new TipoCtrl();
    $vo = new TipoVO();    
    $vo->setNome($_POST['nome']);    
    $ret = $ctrl->InserirTipo($vo);     
    
    if($ret > 0){
        $nome = null;        
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
                           <h2>Novo Tipo de Serviço</h2>          
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="novo_tipo.php">                        
                        <div class="row">                                                        
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Dados do tipo de serviço
                                    </div>
                                    <div class="panel-body">                                        
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input class="form-control" id="nome" name="nome" maxlength="50" placeholder="Nome" value="<?php echo $nome ?>"/>                            
                                            <div hidden id="val_nome" style="color: red"></div>
                                        </div>                                                 
                                    </div>
                                </div>                                
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