<?php

require_once '../DAO/ServicoDAO.php';
require_once '../VO/ServicoVO.php';

class ServicoCtrl{
    
    public function inserirServico(ServicoVO $vo){        
        if($vo->getCodTipo() == '' || $vo->getDescricao() == '' || $vo->getValor() == '' 
            || $vo->getDataservico() == ''){
            return Messages::CamposObrigatorios;
        }else if(Utils::ValidaData($vo->getDataservico()) == 0){
            return Messages::DataInvalida;
        }
        $dao = new ServicoDAO();
        $vo->setDataservico(Utils::TratarDataBanco($vo->getDataservico()));
        $vo->setCodUsuario(Utils::CodigoLogado());          
        return $dao->inserirServico($vo);
    }
    
    public function alterarServico(ServicoVO $vo){        
        if($vo->getCodTipo() == '' || $vo->getDescricao() == '' || $vo->getValor() == '' 
            || $vo->getDataservico() == ''){
            return Messages::CamposObrigatorios;
        }else if(Utils::ValidaData($vo->getDataservico()) == 0){
            return Messages::DataInvalida;
        }
        $dao = new ServicoDAO();         
        $vo->setDataservico(Utils::TratarDataBanco($vo->getDataservico()));
        $vo->setCodUsuario(Utils::CodigoLogado());        
        return $dao->alterarServico($vo);
    }
    
    public function excluirServico($codigo) {
        $dao = new ServicoDAO();        
        return $dao->excluirServico($codigo, Utils::CodigoLogado());
    }
    
    public function detalhesServico($codigo){                 
        $dao = new ServicoDAO();           
        return $dao->detalhesServico($codigo);
    }
    
    public function consultarServico(){                 
        $dao = new ServicoDAO();   
        return $dao->consultarServico(Utils::CodigoLogado());
    }
    
    public function consultarServicoTodos(){  
        if(Utils::PerfilLogado() == 1){
            return Messages::UsuarioNaoAutorizado;
        }
        $dao = new ServicoDAO();   
        return $dao->consultarServicoTodos();
    }
    
    public function filtrarServicosTodos($datainicial, $datafinal){         
        if($datainicial == '' || $datafinal == ''){
            return Messages::CamposObrigatorios;
        }else if(Utils::PerfilLogado() == 1){
            return Messages::UsuarioNaoAutorizado;
        }else if(Utils::ValidaData($datainicial) == 0 || Utils::ValidaData($datafinal) == 0){
            return Messages::DataInvalida;
        }
        $dao = new ServicoDAO();           
        return $dao->filtrarServicosTodos(Utils::TratarDataBanco($datainicial), 
                Utils::TratarDataBanco($datafinal));
    }
    
    public function filtrarServicos($datainicial, $datafinal){         
        if($datainicial == '' || $datafinal == ''){
            return Messages::CamposObrigatorios;
        }else if(Utils::ValidaData($datainicial) == 0 || Utils::ValidaData($datafinal) == 0){
            return Messages::DataInvalida;
        }
        $dao = new ServicoDAO();           
        return $dao->filtrarServicos(Utils::TratarDataBanco($datainicial), 
                Utils::TratarDataBanco($datafinal), Utils::CodigoLogado());
    }
}