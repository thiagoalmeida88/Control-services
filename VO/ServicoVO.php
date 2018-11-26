<?php

class ServicoVO{
    
    private $Codigo;
    private $Descricao;
    private $Valor;
    private $Dataservico;
    private $Cadastro;
    private $CodUsuario;
    private $CodTipo;
    
    public function getCodigo() {
        return $this->Codigo;
    }

    public function getDescricao() {
        return $this->Descricao;
    }

    public function getValor() {
        return $this->Valor;
    }

    public function getDataservico() {
        return $this->Dataservico;
    }

    public function getCadastro() {
        return $this->Cadastro;
    }

    public function getCodUsuario() {
        return $this->CodUsuario;
    }

    public function getCodTipo() {
        return $this->CodTipo;
    }

    public function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    public function setDescricao($Descricao) {
        $this->Descricao = $Descricao;
    }

    public function setValor($Valor) {
        $this->Valor = str_replace(',','.', str_replace('.','',$Valor));
    }

    public function setDataservico($Dataservico) {
        $this->Dataservico = $Dataservico;
    }

    public function setCadastro($Cadastro) {
        $this->Cadastro = $Cadastro;
    }

    public function setCodUsuario($CodUsuario) {
        $this->CodUsuario = $CodUsuario;
    }

    public function setCodTipo($CodTipo) {
        $this->CodTipo = $CodTipo;
    }
}
