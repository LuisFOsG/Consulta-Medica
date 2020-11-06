<?php
    $con = conectar();
    /* sintomas*/

    if(isset($_POST['Doc'])){
        $nombre = $_POST['Nombres'];
        $apellidos = $_POST['Apellidos'];
        $cedula = $_POST['Doc'];
        $fechanac = $_POST['FechaNacimiento'];
        $fecha = $_POST['FechaVencimiento'];
        $date = $_POST['Direccion'];
        $tel = $_POST['Telefono'];
        $mail = $_POST['Correo'];
        $details = $_POST['Descripcion'];
        $fechaconsul = $_POST['FechaConsulta'];

        $consulta = "SELECT usuario.nombres, usuario.apellidos, usuario.fechaexpedicion, usuario.fechanacimiento, usuario.direccion, usuario.telefono, usuario.correo, datosconsultas.descripcion, datosconsultas.idconsultas
        FROM usuario
        inner join datosconsultas on datosconsultas.idconsultas = usuario.Idconsultas
        WHERE ccusuario = '$cedula'";

        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            $nombree = $valores["nombres"];
            $apellidoss = $valores["apellidos"];
            $fechaa = $valores["fechaexpedicion"];
            $fechanacc = $valores["fechanacimiento"];
            $datee = $valores["direccion"];
            $tell = $valores["telefono"];
            $maill = $valores["correo"];
            $detailss = $valores["descripcion"];
            $idConsulta = $valores["idconsultas"];
        }

        if($_REQUEST['genero']=="Femenino"){
            $genero = 'Femenino';
        }
        if($_REQUEST['genero']=="Masculino"){
            $genero = 'Masculino';
        }
        if($_REQUEST['genero']=="Otro"){
            $genero = 'Otro';
        }

        if($_REQUEST['TipoConsulta']=="CInd"){
            $tipocons = 1;
        }
        if($_REQUEST['TipoConsulta']=="CDom"){
            $tipocons = 2;
        }
        if($_REQUEST['TipoConsulta']=="CDes"){
            $tipocons = 3;
        }

        $consulta = "SELECT * FROM tipoespecialista";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            if($_REQUEST['Especialistas']===$valores["nombretipoesp"]){
                $especialista = $valores["nombretipoesp"];

                $consulta1 = " SELECT tipoespecialista.idtipo FROM tipoespecialista WHERE nombretipoesp = '$especialista'";
                $resultado1 = mysqli_query($con, $consulta1) or die ( "Algo ha salido mal en la consulta a la base de datos de datos de consulta");

                while ($valores1 = mysqli_fetch_array($resultado1)) {
                    $idespecialista = $valores1["idtipo"];
                    $consulta2 = " SELECT especialistas.ccespe FROM especialistas WHERE Idtipo = '$idespecialista'";
                    $resultado2 = mysqli_query($con, $consulta2) or die ( "Algo ha salido mal en la consulta a la base de datos de datos de consulta");
                    while ($valores2 = mysqli_fetch_array($resultado2)) {
                        $Ccespe = $valores2['ccespe'];
                    }
                }
            }
        }

        if($_FILES["Adjuntar"]["error"]>0){
            $archivo = $cedula . ".pdf";
        }else{
            $ruta = "public/documentos/";
            $archivo = $cedula . ".pdf";
            $upload = $ruta . $archivo;
            move_uploaded_file($_FILES["Adjuntar"]["tmp_name"], $upload);
        }
        /* ==================================Sintomas ====================================== */

        if(isset($_REQUEST["sintoma"])){
            $consulta = "DELETE FROM datosconsulta_sintomas WHERE Idconsultas = '$idConsulta'";
            $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal al Eliminar Sintomas");

            $arreglo = $_REQUEST["sintoma"];
            if($arreglo){
                $num = count($arreglo);
                for($n=0; $n<$num; $n++){
                    $consulta2 = "SELECT * FROM sintomas";
                    $resultado2 = mysqli_query($con, $consulta2) or die ( "Algo ha salido mal en la consulta a la base de datos de sintomas");

                    while ($valores2 = mysqli_fetch_array($resultado2)) {
                        if ($arreglo[$n] === $valores2["nombresintoma"]){
                            $idSintoma = $valores2["idsintomas"];
                            $consulta = "INSERT INTO datosconsulta_sintomas(Idconsultas, IdSintomas) VALUES ('$idConsulta','$idSintoma')";
                            $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos datosconsulta_sintomas");
                        }
                    }
                }
            }
        }

        if($nombre==""){
            $nombre = $nombree;
        }
        if($apellidos==""){
            $apellidos = $apellidoss;
        }
        if($fecha==""){
            $fecha = $fechaa;
        }
        if($fechanac==""){
            $fechanac = $fechanacc;
        }
        if($date==""){
            $date = $datee;
        }
        if($tel==""){
            $tel = $tell;
        }
        if($mail==""){
            $mail = $maill;
        }
        if($details==""){
            $details = $detailss;
        }

        if($genero=="Femenino"){
            $gen = 1;
        }
        if($genero=="Masculino"){
            $gen = 2;
        }
        if($genero=="Otro"){
            $gen = 3;
        }


        $consulta = "UPDATE datosconsultas SET descripcion = '$details' , tipoconsulta = '$tipocons' WHERE idconsultas = '$idConsulta' ";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal al actualizar la Tabla de Consulta");

        $consulta = "UPDATE usuario SET nombres = '$nombre', apellidos = '$apellidos' , genero = '$gen' , fechaexpedicion = '$fecha', fechanacimiento = '$fechanac' , direccion = '$date' , telefono = '$tel' , correo = '$mail' , Ccespe = '$Ccespe' WHERE ccusuario = '$cedula'";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal al actualizar la Tabla de Consulta");

        echo '<div class="alert alert-primary" role="alert">';
        echo '<strong>Sus datos se han actualizado de forma satisfactoria</strong>';
        echo '<a class="btn btn-success" href="index.php">Volver a Inicio</a>';
        echo '</div>';
    }
?>
