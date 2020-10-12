<?php

function conectar(){
    $servidor = "localhost";
    $usuario = "root";
	$password = "";
	$basededatos = "consultamedica";
    
    // creación de la conexión a la base de datos con mysql_connect()
    $con = mysqli_connect($servidor, $usuario, $password) or die ("No se ha podido conectar al servidor de Base de datos");

    // Para reconocer acentos y ñ
    mysqli_query ($con,"SET NAMES 'utf8'");

    // Selección de la base de datos a utilizar
    mysqli_select_db($con, $basededatos) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
    
    return $con;
}

$salida = "";
$consulta = "SELECT usuario.ccusuario FROM usuario WHERE ccusuario = '$salida'";

if(isset($_POST['consulta'])){
    $q = $_POST["consulta"];
    $consulta = "SELECT usuario.ccusuario FROM usuario WHERE ccusuario = '$q'";
    $con = conectar();
    $resultado = mysqli_query($con, $consulta) or die ("No Pudimos Buscar Nada");

    if($resultado->num_rows>0){
        $salida = '<h6 class="text-danger"><strong>Cuidado: El Usuario ya se encuentra Registrado</strong></h6>';
    }

    echo $salida;
}

if(isset($_POST['usuario'])){
    $q = $_POST["usuario"];
    $consulta = "SELECT usuario.ccusuario FROM usuario WHERE ccusuario = '$q'";
    $con = conectar();
    $resultado = mysqli_query($con, $consulta) or die ("No Pudimos Buscar Nada");

    if($resultado->num_rows>0){
        $salida = '<h6 class="text-primary"><strong>Usuario Encontrado</strong></h6>';
    }

    echo $salida;
}

?>