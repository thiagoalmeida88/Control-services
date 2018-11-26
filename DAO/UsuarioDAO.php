<?php

require_once '../Helpers/Conexao.class.php';
require_once '../VO/UsuarioVO.php';

class UsuarioDAO extends Conexao {    
    /** @var PDO */
    private $conexao;    
    /** @var PDOStatement */
    private $sql;    
    
    public function inserirUsuario(UsuarioVO $vo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'insert into usuario (nome, email, senha, ativo, perfil, cadastro) '
         . 'values (?,?,?,?,?,?)';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $vo->getNome());
        $this->sql->bindValue(2, $vo->getEmail());
        $this->sql->bindValue(3, $vo->getSenha());
        $this->sql->bindValue(4, $vo->getAtivo());
        $this->sql->bindValue(5, $vo->getPerfil());
        $this->sql->bindValue(6, $vo->getCadastro());       

        try {
            $this->sql->execute();
            return 1;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        } 
    }
    
    public function alterarUsuario(UsuarioVO $vo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'update usuario set nome = ?, email = ?, senha = ?, ativo = ?, perfil = ? '
         . 'where codigo = ? ';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $vo->getNome());
        $this->sql->bindValue(2, $vo->getEmail());
        $this->sql->bindValue(3, $vo->getSenha());
        $this->sql->bindValue(4, $vo->getAtivo());
        $this->sql->bindValue(5, $vo->getPerfil());        
        $this->sql->bindValue(6, $vo->getCodigo());        

        try {
            $this->sql->execute();
            return 2;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        } 
    }
    
    public function excluirUsuario($codigo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'delete from usuario where codigo = ?';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $codigo);
        
        try {
            $this->sql->execute();
            return 3;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        }
    }
    
    public function ativarUsuario($codigo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'update usuario set ativo = 1 where codigo = ?';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $codigo);
        
        try {
            $this->sql->execute();
            return 2;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        }
    }
    
    public function inativarUsuario($codigo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'update usuario set ativo = 0 where codigo = ?';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $codigo);
        
        try {
            $this->sql->execute();
            return 2;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        }
    }
    
    public function detalhesUsuario($codigo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'select codigo, nome, email, senha, ativo, perfil from usuario '
                . 'where codigo = ? ';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $codigo);        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    
    public function consultarUsuarioTodos() {    
        $this->conexao = parent::getConexao();        
        $comando = 'select codigo, nome, email, ativo, perfil, cadastro '
                . 'from usuario where codigo order by cadastro desc';                
        $this->sql = $this->conexao->prepare($comando);                
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);        
        $this->sql->execute();        
        return $this->sql->fetchAll(); 
    }    
    
    public function validarLogin($email, $senha) {
        
        $this->conexao = parent::getConexao();
        
        $comando = 'select codigo, email, ativo, perfil from usuario '
                . 'where email = ? and senha = ?';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $email);
        $this->sql->bindValue(2, $senha);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();

        return $this->sql->fetchAll();
        
    }
    
    public function verificarEmailExistente($email) {
        
        $this->conexao = parent::getConexao();
        
        $comando = 'select codigo, email FROM usuario '
                . 'WHERE email = ? ';

        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $email);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        
        return $this->sql->fetchAll();
    }
}
