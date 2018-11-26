<?php
date_default_timezone_set('America/Sao_Paulo');

abstract class Messages{
    const Erro = -100;
    const CamposObrigatorios = -1;
    const SenhasPrecisamSerIdenticas = -2;
    const UsuarioNaoAutorizado = -3;
    const DataInvalida = -4;
    const AcaoNaoAutorizada = -5;    
    const EmailJaExiste = -6; 
    const DadosGravados = 1;
    const DadosAlterados = 2;
    const DadosExcluidos = 3;
    const CadastroInativado = 4;
    const UsuarioNaoEncontrado = 5;
    const UsuarioInativo = 6;      
}

class Utils{
    
    public static function IniciarSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function GuardarInformacao($cod, $email, $perfil) {
        self::IniciarSession();
        $_SESSION['cod'] = $cod;
        $_SESSION['email'] = $email;
        $_SESSION['perfil'] = $perfil;
    }

    public static function CodigoLogado() {
        self::IniciarSession();
        return $_SESSION['cod'];
    }
    
    public static function PerfilLogado() {
        self::IniciarSession();
        return $_SESSION['perfil'];
    }
    
    public static function VerificarAdminLogado() {
        self::IniciarSession();
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
            header('location: index.php');
        }
        else if($_SESSION['perfil'] != 2){
            header('location: index.php');
        }
    }
    
    public static function VerificarUserLogado() {
        self::IniciarSession();
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
            header('location: index.php');
        }
        else if($_SESSION['perfil'] != 1){
            header('location: index.php');
        }
    }
        
    public static function Deslogar() {
        self::IniciarSession();
        unset($_SESSION['cod']);
        unset($_SESSION['email']);
        unset($_SESSION['perfil']);
        header('location: index.php');
    }
    
    public static function DataAtual() {
        return date('Y-m-d H:i:s');
    }
    
    public static function TratarDataBanco($data) {
        return explode('/', $data)[2] . '-' . explode('/', $data)[1] . '-' . explode('/', $data)[0];
    }    
    
    public static function TratarAtivoTela($ativo) {        
        if($ativo){
            return '<span class="badge" style="background: #398439">S</span>';
        }
        return '<span class="badge" style="background: #B40101">N</span>';
    }
    
    public static function TratarValorTela($valor) {        
        return 'R$ '. str_replace('.', ',', $valor);        
    }
    
    public static function ValidaData($dataCadastro){
	
        $data = explode("/","$dataCadastro"); 
	$dia = $data[0];
	$mes = $data[1];
	$ano = $data[2];

	$ret = checkdate($mes,$dia,$ano);
	
        return $ret;            
    }
}