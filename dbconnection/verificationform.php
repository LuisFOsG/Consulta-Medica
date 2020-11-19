<?php
    $con = conectar();

    /* Eliminar Inquietudes */
    if(isset($_POST['eliminar'])){
        $Cut = trim($_POST['eliminar']);
        $consulta = "DELETE FROM inquietud WHERE idinquietud = '$Cut'";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal al borrar");

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo "Dato Borrado Correctamente";
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo ' </div>';
    }

    /* Formulario Login */
    if(isset($_POST['nick'])){
        $nick = trim($_POST['nick']);
        $pass = trim($_POST['password']);

        $consulta = "SELECT especialistas.ccespe, especialistas.nombreespe FROM especialistas WHERE ccespe = '$pass' AND nombreespe = '$nick'";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");

        if(mysqli_fetch_array($resultado)===null){
            echo '<div class="alert alert-danger" role="alert">';
            echo '<strong>Datos No Validos, Intente Nuevamente</strong>';
            echo '</div>';
            echo '</br>';
        }else{
            header("Location: ./inquietudes.php");
        }
    }

    /* Form Inquietudes */
    if(isset($_POST['Email'])){
        $email = trim($_POST['Email']);
        $descripcion = trim($_POST['DescripcionI']);
        $consulta = "INSERT INTO inquietud(email, descripcioni) VALUES ('$email', '$descripcion')";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        echo '<div class="alert alert-primary" role="alert">';
        echo '<strong>Inquietud Enviada, Espera la respuesta en tu correo</strong>';
        echo '</div>';
    }

    /* Form consultar datos */
    if(isset($_POST['Documento'])){
        $ti = $_POST['Documento'];
        $fechaexp = $_POST['FechaExpedicion'];

        $consulta = "SELECT usuario.ccusuario FROM usuario WHERE ccusuario = '$ti' AND fechaexpedicion = '$fechaexp'";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");

        if(mysqli_fetch_array($resultado)===null){
            echo '<div class="alert alert-danger" role="alert">';
            echo '<strong>Datos Erroneos</strong>';
            echo '</div>';
        }else{
            include("mostrardatos.php");
            mostrar($ti, $fechaexp);
        }
    }

    /* Form Grande :v */
    if(isset($_POST['Nombres'])){
        if(isset($_REQUEST["sintoma"])){
            $Nombres = $_POST['Nombres'];
            $Apellidos = $_POST['Apellidos'];
            $Documentos = $_POST['Documentos'];
            $FechaNacimiento = $_POST['FechaNacimiento'];
            $FechaVencimiento = $_POST['FechaVencimiento'];
            $Direccion = $_POST['Direccion'];
            $Telefono = $_POST['Telefono'];
            $Correo = $_POST['Correo'];
            $Descripcion = $_POST['Descripcion'];

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

            date_default_timezone_set("America/Bogota");
            $fecha = date("Y-m-d");
            $fechaManana = date("Y-m-d",strtotime($fecha."+ 1 days"));
            $fechaPasMan = date("Y-m-d",strtotime($fecha."+ 2 days"));
            $fechaPasPasMan = date("Y-m-d",strtotime($fecha."+ 3 days"));

            if($_REQUEST['FechaConsulta']=="1"){
                $fechaconsulta = $fechaManana;
            }
            if($_REQUEST['FechaConsulta']=="2"){
                $fechaconsulta = $fechaPasMan;
            }
            if($_REQUEST['FechaConsulta']=="3"){
                $fechaconsulta = $fechaPasPasMan;
            }

            $consulta = "SELECT usuario.ccusuario FROM usuario WHERE ccusuario = '$Documentos'";
            $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
            if(mysqli_fetch_array($resultado)===null){
                /* Se guardan los datos en datos consultas ============================================ */

                $consulta = "INSERT INTO datosconsultas(descripcion, tipoconsulta, fechaconsulta) VALUES ('$Descripcion','$tipoconsulta','$fechaconsulta')";
                $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos de datos de consulta");

                /* Se guardan los datos en datosconsultas_sintomas */

                $consulta1 = "SELECT datosconsultas.idconsultas FROM datosconsultas WHERE descripcion = '$Descripcion' AND tipoconsulta = '$tipoconsulta'";
                $resultado1 = mysqli_query($con, $consulta1) or die ( "Algo ha salido mal en la consulta a la base de datos datosconsultas");

                while ($valores1 = mysqli_fetch_array($resultado1)){
                    $idconsulta = $valores1["idconsultas"];
                    /* ==================================Sintomas ====================================== */
                    if(isset($_REQUEST["sintoma"])){
                        $arreglo = $_REQUEST["sintoma"];

                        if($arreglo){
                            $num = count($arreglo);
                            for($n=0; $n<$num; $n++){
                                $consulta2 = "SELECT * FROM sintomas";
                                $resultado2 = mysqli_query($con, $consulta2) or die ( "Algo ha salido mal en la consulta a la base de datos de sintomas");

                                while ($valores2 = mysqli_fetch_array($resultado2)) {
                                    if ($arreglo[$n] === $valores2["nombresintoma"]){
                                        $idSintoma = $valores2["idsintomas"];
                                        $consulta = "INSERT INTO datosconsulta_sintomas(Idconsultas, IdSintomas) VALUES ('$idconsulta','$idSintoma')";
                                        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos datosconsulta_sintomas");
                                    }
                                }
                            }
                        }
                    }
                }

                if($_FILES["Adjuntar"]["error"]>0){
                    echo "No se pudo cargar el archivo";
                }else{
                    $ruta = "public/documentos/";
                    $nombrefinal = $Documentos . ".pdf";
                    $upload = $ruta . $nombrefinal;
                    move_uploaded_file($_FILES["Adjuntar"]["tmp_name"], $upload);
                }

                /* Se guardan los datos en Usuario */
                $consultax = "INSERT INTO usuario(ccusuario, nombres, apellidos, genero, fechaexpedicion, fechanacimiento, direccion, telefono, correo, adjuntar, Idconsultas, Ccespe) VALUES ('$Documentos','$Nombres','$Apellidos','$Genero','$FechaVencimiento','$FechaNacimiento','$Direccion','$Telefono','$Correo','$nombrefinal','$idconsulta','$Ccespe')";
                $resultadox = mysqli_query($con, $consultax) or die ( "Algo ha salido mal en la consulta a la base de datos de usuario");
                echo '<div class="alert alert-primary" role="alert">';
                echo '<strong>Formulario Enviado, Pronto nos pondremos en Contacto!</strong>';
                echo '</div>';
            }else{
                echo '<div class="alert alert-danger" role="alert">';
                echo '<strong>El Usuario Ya se encuentra Registrado</strong>';
                echo '</div>';
            }
        }else{
            echo '<div class="alert alert-danger" role="alert">';
            echo '<strong>No Ingreso Ningun Sintoma</strong>';
            echo '</div>';
        }
    }
?>