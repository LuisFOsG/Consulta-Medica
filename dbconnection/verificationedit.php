<?php
    $con = conectar();
    /* sintomas*/

    if(isset($_POST['Documentos'])){
        $Nombres = $_POST['Nombres'];
        echo $Nombres;
        echo "<br>";
        $Apellidos = $_POST['Apellidos'];
        echo $Apellidos;
        echo "<br>";
        $Documentos = $_POST['Documentos'];
        echo $Documentos;
        echo "<br>";
        $FechaNacimiento = $_POST['FechaNacimiento'];
        echo $FechaNacimiento;
        echo "<br>";
        $FechaVencimiento = $_POST['FechaVencimiento'];
        echo $FechaVencimiento;
        echo "<br>";
        $Direccion = $_POST['Direccion'];
        echo $Direccion;
        echo "<br>";
        $Telefono = $_POST['Telefono'];
        echo $Telefono;
        echo "<br>";
        $Correo = $_POST['Correo'];
        echo $Correo;
        echo "<br>";
        $Descripcion = $_POST['Descripcion'];
        echo $Descripcion;

        if($_REQUEST['genero']=="Femenino"){
            $Genero = 1;
        }
        if($_REQUEST['genero']=="Masculino"){
            $Genero = 2;
        }
        if($_REQUEST['genero']=="Otro"){
            $Genero = 3;
        }

        if($_REQUEST['TipoConsulta']=="CInd"){
            $tipoconsulta = 1;
        }
        if($_REQUEST['TipoConsulta']=="CDom"){
            $tipoconsulta = 2;
        }
        if($_REQUEST['TipoConsulta']=="CDes"){
            $tipoconsulta = 3;
        }

        echo "<br>";
        echo $Genero;
        echo "<br>";
        echo $tipoconsulta;

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
        }else{
            $ruta = "public/documentos/";
            $nombrefinal = $Documentos . ".pdf";
            $upload = $ruta . $nombrefinal;
            move_uploaded_file($_FILES["Adjuntar"]["tmp_name"], $upload);
            echo "El Nombre que tiene el archivo es: ". $nombrefinal;
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
