<?php
    if(isset($_POST['docEliminar'])){

        $con = conectar();

        $cedula = $_POST['docEliminar'];

        $consulta = "SELECT usuario.Idconsultas FROM usuario WHERE ccusuario = '$cedula'";

        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            $idConsulta = $valores['Idconsultas'];
        }

        $consulta = "DELETE FROM datosconsulta_sintomas WHERE Idconsultas = '$idConsulta'";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal al borrar datosconsulta_sintomas");
        $consulta2 = "DELETE FROM usuario WHERE ccusuario = '$cedula'";
        $resultado2 = mysqli_query($con, $consulta2) or die ( "Algo ha salido mal al borrar el usuario");
        $consulta1 = "DELETE FROM datosconsultas WHERE idconsultas = '$idConsulta'";
        $resultado1 = mysqli_query($con, $consulta1) or die ( "Algo ha salido mal al borrar datosconsultas");

        echo '<div class="alert alert-success" role="alert">';
        echo "Usuario Borrado Correctamente";
        echo "</div>";
    }
?>