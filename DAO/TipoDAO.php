<?php

require_once '../Helpers/Conexao.class.php';
require_once '../VO/TipoVO.php';

class TipoDAO extends Conexao {    
    /** @var PDO */
    private $conexao;    
    /** @var PDOStatement */
    private $sql;    
    
    public function inserirTipo(TipoVO $vo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'insert into tiposervico (nome, codusuario) values (?,?)';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $vo->getNome());
        $this->sql->bindValue(2, $vo->getCodUsuario());        

        try {
            $this->sql->execute();
            return 1;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        } 
    }
    
    public function alterarTipo(TipoVO $vo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'update tiposervico set nome = ? where codigo = ? ';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $vo->getNome());
        $this->sql->bindValue(2, $vo->getCodigo());
        
        try {
            $this->sql->execute();
            return 2;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        } 
    }
    
    public function excluirTipo($codigo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'delete from tiposervico where codigo = ?';
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
    
    public function detalhesTipo($codigo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'select codigo, nome from tiposervico where codigo = ? ';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $codigo);        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    
    public function consultarTipo() {    
        $this->conexao = parent::getConexao();        
        $comando = 'select codigo, nome from tiposervico order by nome';                
        $this->sql = $this->conexao->prepare($comando);                
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);        
        $this->sql->execute();        
        return $this->sql->fetchAll(); 
    }    
}
