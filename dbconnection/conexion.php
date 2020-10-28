<?php
// Datos Base de datos
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

?>