<?php

class UsuarioVO{
    
    private $Codigo;
    private $Nome;
    private $Email;
    private $Senha;
    private $SenhaConfirma;
    private $Ativo;
    private $Perfil;
    private $Cadastro;

    public function getCodigo() {
        return $this->Codigo;
    }

    public function getNome() {
        return $this->Nome;
    }
    
    public function getEmail() {
        return $this->Email;
    }

    public function getSenha() {
        return $this->Senha;
    }
    
    public function getSenhaConfirma() {
        return $this->SenhaConfirma;
    }
    
    public function getAtivo() {
        return $this->Ativo;
    }

    public function getPerfil() {
        return $this->Perfil;
    }

    public function getCadastro() {
        return $this->Cadastro;
    }
    
    public function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }
    
    public function setEmail($Email) {
        $this->Email = strtolower($Email);
    }

    public function setSenha($Senha) {
        $this->Senha = $Senha;
    }

    public function setSenhaConfirma($SenhaConfirma) {
        $this->SenhaConfirma = $SenhaConfirma;
    }
    
    public function setAtivo($Ativo) {
        $this->Ativo = $Ativo;
    }

    public function setPerfil($Perfil) {
        $this->Perfil = $Perfil;
    }

    public function setCadastro($Cadastro) {
        $this->Cadastro = $Cadastro;
    }
}
