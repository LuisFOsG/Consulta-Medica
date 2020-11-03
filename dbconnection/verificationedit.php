<?php
    $con = conectar();
    /* sintomas*/

    if(isset($_POST['Doc'])){
        $nombre = $_POST['Nombres'];
        echo $nombre;
        echo "<br>";
        $apellidos = $_POST['Apellidos'];
        echo $apellidos;
        echo "<br>";
        $cedula = $_POST['Doc'];
        echo $cedula;
        echo "<br>";
        $fechanac = $_POST['FechaNacimiento'];
        echo $fechanac;
        echo "<br>";
        $fecha = $_POST['FechaVencimiento'];
        echo $fecha;
        echo "<br>";
        $date = $_POST['Direccion'];
        echo $date;
        echo "<br>";
        $tel = $_POST['Telefono'];
        echo $tel;
        echo "<br>";
        $mail = $_POST['Correo'];
        echo $mail;
        echo "<br>";
        $details = $_POST['Descripcion'];
        echo $details;
        echo "<br>";
        $fechaconsul = $_POST['FechaConsulta'];
        echo $fechaconsul;

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

        echo "<br>";
        echo $genero;
        echo "<br>";
        echo $tipocons;

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
        echo "<br>";
        echo $especialista;
        echo "<br>";

        if($_FILES["Adjuntar"]["error"]>0){
            echo "Su Archivo Es Igual Al Anterior";
            $archivo = $cedula . ".pdf";
        }else{
            $ruta = "public/documentos/";
            $archivo = $cedula . ".pdf";
            $upload = $ruta . $nombrefinal;
            move_uploaded_file($_FILES["Adjuntar"]["tmp_name"], $upload);
            echo "El Nombre que tiene el archivo es: ". $archivo;
        }
        echo "<br>";
        /* ==================================Sintomas ====================================== */
        if(isset($_REQUEST["sintoma"])){
            $arreglo = $_REQUEST["sintoma"];

            if($arreglo){
                $num = count($arreglo);
                for($n=0; $n<$num; $n++){
                    echo $arreglo[$n];
                    echo "<br>";
                }
            } else{
                echo "No ingreso ningun dato";
            }
        } else {
            echo "No Ingreso Ningun sintoma";
        }
    }
?>
