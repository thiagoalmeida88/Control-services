<?php

require_once '../DAO/TipoDAO.php';
require_once '../VO/TipoVO.php';

class TipoCtrl{
    
    public function inserirTipo(TipoVO $vo){        
        if($vo->getNome() == ''){
            return Messages::CamposObrigatorios;
        }
        $vo->setCodUsuario(Utils::CodigoLogado());
        $dao = new TipoDAO();           
        return $dao->inserirTipo($vo);
    }
    
    public function alterarTipo(TipoVO $vo){        
        if($vo->getNome() == ''){
            return Messages::CamposObrigatorios;
        }    
        $dao = new TipoDAO();   
        return $dao->alterarTipo($vo);
    }
    
    public function excluirTipo($codigo) {
        $dao = new TipoDAO();
        return $dao->excluirTipo($codigo);
    }
    
    public function detalhesTipo($codigo){                 
        $dao = new TipoDAO();   
        return $dao->detalhesTipo($codigo);
    }
    
    public function consultarTipo(){                 
        $dao = new TipoDAO();   
        return $dao->consultarTipo();
    }    
}