<?php

require_once '../Helpers/Conexao.class.php';
require_once '../VO/ServicoVO.php';

class ServicoDAO extends Conexao {    
    /** @var PDO */
    private $conexao;    
    /** @var PDOStatement */
    private $sql;    
    
    public function inserirServico(ServicoVO $vo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'insert into servico (Descricao, Valor, Dataservico, Cadastro, CodTipo, CodUsuario) '
         . 'values (?,?,?,?,?,?)';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $vo->getDescricao());
        $this->sql->bindValue(2, $vo->getValor());
        $this->sql->bindValue(3, $vo->getDataservico());
        $this->sql->bindValue(4, $vo->getCadastro());        
        $this->sql->bindValue(5, $vo->getCodTipo());
        $this->sql->bindValue(6, $vo->getCodUsuario());        

        try {
            $this->sql->execute();
            return 1;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        } 
    }
    
    public function alterarServico(ServicoVO $vo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'update servico '
                . 'set descricao = ?, valor = ?, dataservico = ?, CodTipo = ? '
                . 'where codigo = ? and CodUsuario = ? ';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $vo->getDescricao());
        $this->sql->bindValue(2, $vo->getValor());
        $this->sql->bindValue(3, $vo->getDataservico());             
        $this->sql->bindValue(4, $vo->getCodTipo());        
        $this->sql->bindValue(5, $vo->getCodigo());        
        $this->sql->bindValue(6, $vo->getCodUsuario());        
        
        try {
            $this->sql->execute();
            return 2;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        } 
    }
    
    public function excluirServico($codigo, $codUsuario) {    
        $this->conexao = parent::getConexao();        
        $comando = 'delete from servico where codigo = ? and CodUsuario = ? ';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $codigo);
        $this->sql->bindValue(2, $codUsuario);
        
        try {
            $this->sql->execute();
            return 3;            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -100;
        }
    }
    
    public function detalhesServico($codigo) {    
        $this->conexao = parent::getConexao();        
        $comando = 'select codigo, descricao, valor, dataservico, cadastro, CodTipo from servico '
                . 'where codigo = ? ';
        $this->sql = $this->conexao->prepare($comando);        
        $this->sql->bindValue(1, $codigo);        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    
    public function consultarServicoTodos() {    
        $this->conexao = parent::getConexao();        
        $comando = 'select servico.codigo, usuario.nome as cliente, tiposervico.nome, descricao, valor, dataservico '
                . 'from servico '
                . 'inner join tiposervico on servico.CodTipo = tiposervico.Codigo '
                . 'inner join usuario on servico.CodUsuario = usuario.Codigo '
                . 'order by servico.cadastro desc ';                
        $this->sql = $this->conexao->prepare($comando);                        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);        
        $this->sql->execute();        
        return $this->sql->fetchAll(); 
    }
    
    public function filtrarServicosTodos($datainicial, $datafinal) {    
        $this->conexao = parent::getConexao();  
        $comando = 'select servico.codigo, usuario.nome as cliente, tiposervico.nome, descricao, valor, dataservico '
                . 'from servico '
                . 'inner join tiposervico on servico.CodTipo = tiposervico.Codigo '
                . 'inner join usuario on servico.CodUsuario = usuario.Codigo '
                . 'where dataservico between ? and ? order by dataservico desc '; 
        $this->sql = $this->conexao->prepare($comando);                
        $this->sql->bindValue(1, $datainicial);
        $this->sql->bindValue(2, $datafinal);        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);        
        $this->sql->execute();        
        return $this->sql->fetchAll(); 
    }

    public function consultarServico($codUsuario) {    
        $this->conexao = parent::getConexao();        
        $comando = 'select servico.codigo, tiposervico.nome, descricao, valor, dataservico '
                . 'from servico '
                . 'inner join tiposervico on servico.CodTipo = tiposervico.Codigo '
                . 'inner join usuario on servico.CodUsuario = usuario.Codigo '
                . 'where servico.CodUsuario = ? ';
        $this->sql = $this->conexao->prepare($comando);                
        $this->sql->bindValue(1, $codUsuario);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);        
        $this->sql->execute();        
        return $this->sql->fetchAll(); 
    }
    
    public function filtrarServicos($datainicial, $datafinal, $codUsuario) {    
        $this->conexao = parent::getConexao();  
        $comando = 'select servico.codigo, tiposervico.nome, descricao, valor, dataservico '
                . 'from servico '
                . 'inner join tiposervico on servico.CodTipo = tiposervico.Codigo '
                . 'inner join usuario on servico.CodUsuario = usuario.Codigo '
                . 'where dataservico between ? and ? and servico.CodUsuario = ? ';
        $this->sql = $this->conexao->prepare($comando);                
        $this->sql->bindValue(1, $datainicial);
        $this->sql->bindValue(2, $datafinal);
        $this->sql->bindValue(3, $codUsuario);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);        
        $this->sql->execute();        
        return $this->sql->fetchAll(); 
    }
}
