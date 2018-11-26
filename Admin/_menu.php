<?php

require_once '../Helpers/Utils.php';

if(isset($_GET['close']) && $_GET['close'] == 1){
    Utils::Deslogar();    
}

?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <?php if($_SESSION['perfil'] == 2) { ?>
            <li> 
                <a href="#"><i class="fa fa-users fa-3x"></i> Usuários<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="novo_cliente.php"><i class="fa fa-plus-circle fa-1x"></i> Novo</a>
                    </li>
                    <li>
                        <a href="consultar_cliente.php"><i class="fa fa-search fa-1x"></i> Consultar / Alterar</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-3x"></i> Tipos de Serviço<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="novo_tipo.php"><i class="fa fa-plus-circle fa-1x"></i> Novo</a>
                    </li>
                    <li>
                        <a href="consultar_tipo.php"><i class="fa fa-search fa-1x"></i> Consultar / Alterar</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="servicos_cliente.php"><i class="fa fa-briefcase fa-3x"></i> Serviços</a>
            </li>
            <?php }else{ ?>               
            <li>
                <a href="#"><i class="fa fa-briefcase fa-3x"></i> Serviço<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="novo_servico.php"><i class="fa fa-plus-circle fa-1x"></i> Novo</a>
                    </li>
                    <li>
                        <a href="consultar_servico.php"><i class="fa fa-search fa-1x"></i> Consultar / Alterar</a>
                    </li>                    
                </ul>                
            </li>
            <?php } ?>
            <li>
                <a href="#Sobre" data-toggle="modal"><i class="fa fa-exclamation-circle fa-3x"></i>Sobre</a>               
            </li>
            <li>
                <a  href="_menu.php?close=1" style="color: tomato"><i class="fa fa-close fa-3x"></i> Sair</a>
            </li>
        </ul>
    </div>
</nav>

<div class="modal fade" id="Sobre" role="dialog" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">    
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Sobre</h4>                                            
            </div>
            <center><div class="panel-body">
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label>Desenvolvido por: </label> 
                        <p><span class="fa fa-user fa-1x"></span>&nbsp;&nbsp;Thiago Almeida</p>
                        <p><span class="fa fa-send fa-1x"></span>&nbsp;&nbsp;thiagoalmeida_bsm@outlook.com</p>
                        <p><span class="fa fa-phone-square fa-1x"></span>&nbsp;&nbsp;(43)99611-0032</p>                                                
                    </div>
                </div>                   
            </div></center>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                            
            </div>                       
        </div>
    </div>
</div>

