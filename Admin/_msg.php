<?php

function ExibirMsg($ret) {

     switch ($ret){
        case -100:
            echo '<div class="alert alert-danger" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
              Ocorreu um erro na operação!
              </div>';
            break;
        case -1:
            echo '<div class="alert alert-warning" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
             Favor preencher o(s) campo(s) obrigatório(s)
             </div>';
            break;
        case -2:
            echo '<div class="alert alert-warning" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
             Senhas precisam ser idênticas
             </div>';
            break;        
        case -3:
            echo '<div class="alert alert-warning" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
             Usuário não autorizado
             </div>';
            break;   
        case -4:
            echo '<div class="alert alert-warning" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
             Data inválida. Informe uma data válida 
             </div>';
            break;
        case -5:
            echo '<div class="alert alert-warning" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
              Ação não autorizada!
              </div>';
            break; 
        case -6:
            echo '<div class="alert alert-warning" alert-dismissable fade in">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
             E-mail já existe. Por favor, cadastre outro e-mail
             </div>';
            break;
        case 1:
            echo '<div class="alert alert-success" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;             
             Dados gravados com sucesso
             </div>';
            break;
        case 2:
            echo '<div class="alert alert-success" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; 
             Dados alterados com sucesso
             </div>';
            break;
        case 3:
            echo '<div class="alert alert-success" alert-dismissable fade in>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; 
             Dados excluídos com sucesso
             </div>';
            break;        
        case 4:
            echo '<div class="alert alert-success" alert-dismissable fade in">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;
             Cadastro inativado com sucesso
             </div>';
            break;
        case 5:
            echo '<div class="alert alert-warning" alert-dismissable fade in">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
             Usuário não encontrado. Solicite o registro para acessar
             </div>';
            break;
        case 6:
            echo '<div class="alert alert-warning" alert-dismissable fade in">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;
             Usuário inativo. Aguarde a liberação do seu cadastro
             </div>';
            break;        
     }
}
