<?php

class TipoVO{
    
    private $Codigo;
    private $Nome;
    private $CodUsuario;
    
    public function getCodigo() {
        return $this->Codigo;
    }

    public function getNome() {
        return $this->Nome;
    }

    public function getCodUsuario() {
        return $this->CodUsuario;
    }

    public function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }

    public function setCodUsuario($CodUsuario) {
        $this->CodUsuario = $CodUsuario;
    }
}

