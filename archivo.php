<?php
include("dbconnection/conexion.php");//Conexión a la Base de Datos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
        include("particiones/head.php");
    ?>
</head>

<body>
    <?php

    $con = conectar();

    $consulta = "SELECT usuario.adjuntar FROM usuario WHERE ccusuario = ".$_GET['id'];
    $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");

    while ($valores = mysqli_fetch_array($resultado)) {
        if($valores["adjuntar"]==""){
            echo "Documento no encontrado";
        }else{
            header("content-type: application/pdf");
            readfile("public/documentos/".$valores["adjuntar"]);
        }
    }

    ?>