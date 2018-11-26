<?php

require_once '../DAO/UsuarioDAO.php';
require_once '../VO/UsuarioVO.php';

class UsuarioCtrl{
    
    public function inserirUsuario(UsuarioVO $vo){        
        if($vo->getNome() == '' || $vo->getEmail() == '' || $vo->getSenha() == '' 
            || $vo->getPerfil() == ''){
            return Messages::CamposObrigatorios;
        }else if ($vo->getSenha() !== $vo->getSenhaConfirma()){
            return Messages::SenhasPrecisamSerIdenticas;
        }   
        $dao = new UsuarioDAO();   
        $ret = $dao->verificarEmailExistente($vo->getEmail());        
        if(count($ret) > 0){
            return Messages::EmailJaExiste;
        }        
        return $dao->inserirUsuario($vo);
    }
    
    public function alterarUsuario(UsuarioVO $vo){        
        if($vo->getNome() == '' || $vo->getEmail() == '' || $vo->getSenha() == '' 
            || $vo->getPerfil() == ''){
            return Messages::CamposObrigatorios;
        }else if ($vo->getSenha() !== $vo->getSenhaConfirma()){
            return Messages::SenhasPrecisamSerIdenticas;
        }else if($vo->getCodigo() == 1 && $vo->getAtivo() == 0 ||
                $_SESSION['cod'] == $vo->getCodigo() && $vo->getAtivo() == 0 ||
                $_SESSION['cod'] == $vo->getCodigo() && $vo->getPerfil() == 1){
            return Messages::AcaoNaoAutorizada;                    
        }    
        $dao = new UsuarioDAO();  
        $ret = $dao->verificarEmailExistente($vo->getEmail());        
        if(count($ret) > 0){
            return Messages::EmailJaExiste;
        }        
        return $dao->alterarUsuario($vo);
    }
    
    public function excluirUsuario($codigo) {
        if($codigo == 1 || $_SESSION['cod'] == $codigo){
            return Messages::AcaoNaoAutorizada;
        }
        $dao = new UsuarioDAO();
        return $dao->excluirUsuario($codigo);
    }
    
    public function detalhesUsuario($codigo){                 
        $dao = new UsuarioDAO();   
        return $dao->detalhesUsuario($codigo);
    }
    
    public function consultarUsuarioTodos(){                 
        $dao = new UsuarioDAO();   
        return $dao->consultarUsuarioTodos();
    }
    
    public function ativarUsuario($codigo){    
        if($_SESSION['cod'] == $codigo){
            return Messages::AcaoNaoAutorizada;
        }
        $dao = new UsuarioDAO();   
        return $dao->ativarUsuario($codigo);
    }
    
    public function inativarUsuario($codigo){                 
        if($codigo == 1 || $_SESSION['cod'] == $codigo){
            return Messages::AcaoNaoAutorizada;
        }
        $dao = new UsuarioDAO();   
        return $dao->inativarUsuario($codigo);
    }
    
    public function validarLogin($email, $senha) {
        
        if($email == '' || $senha == ''){
            return Messages::CamposObrigatorios;
        }
        
        $dao = new UsuarioDAO();
        
        $usuario = $dao->validarLogin($email, $senha);
        
        if(count($usuario) == 0){
            return Messages::UsuarioNaoEncontrado;
        }else if(!$usuario[0]['ativo']){
            return Messages::UsuarioInativo;
        }else{            
            Utils::GuardarInformacao($usuario[0]['codigo'], $usuario[0]['email'], $usuario[0]['perfil']);
            if($usuario[0]['perfil'] == 2){
                header('location: consultar_cliente.php');
            }else{
                header('location: consultar_servico.php');
            }
        }        
    }
}