<?php

    function mostrar($ti, $fechaexp){
        menuConsulta($ti, $fechaexp);
        datosBasicos($ti, $fechaexp);
        datosDireccion($ti, $fechaexp);
        datosConsulta($ti, $fechaexp);
        sintomas($ti, $fechaexp);
        datosDoctor($ti, $fechaexp);
    }

    function menuConsulta($ti, $fechaexp){
        $con = conectar();

        $consulta = "SELECT usuario.ccusuario, usuario.fechaexpedicion FROM usuario WHERE ccusuario = '$ti' AND fechaexpedicion = '$fechaexp'";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
            echo '<strong class="text-info">Consulta Medica</strong>';
            echo '<div class="collapse navbar-collapse" id="navbarNavAltMarkup">';
            echo '<ul class="navbar-nav ml-auto">';
            echo '<li class="nav-item active">';
            /* EDITAR */
            echo '<form action="./editar.php" method="POST">';
            echo '<input type="hidden" name="Documentos" value="'.$valores["ccusuario"].'">';
            echo '<input type="hidden" name="FechaVencimiento" value="'.$valores["fechaexpedicion"].'">';
            echo '<button class="btn btn-primary text-white nav-link titulo" type="submit">Editar <i class="fas fa-pencil-alt"></i></button>';
            echo '</form>';
            /* ELIMINAR */
            echo "</li>";
            echo '<li class="nav-item active">';
            echo '<button class="btn btn-danger text-white nav-link titulo" data-toggle="modal" data-target="#myModal">Eliminar <i class="fas fa-trash-alt"></i></button>';
            echo "</li>";
            echo "</ul>";
            echo "</div>";
            echo '</nav>';

            echo '<div class="modal animate__animated animate__jackInTheBox" id="myModal" tabindex="-1">';
            echo '<div class="modal-dialog">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title"><strong>Confirmar</strong></h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<p>¿Esta Seguro de Eliminar su Consulta?</p>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>';
            echo '<form action="./basedatos.php" method="POST">';
            echo '<input type="hidden" name="docEliminar" value="'.$valores["ccusuario"].'">';
            echo '<button class="btn btn-danger text-white nav-link titulo" type="submit">Si, Estoy Seguro <i class="fas fa-trash-alt"></i></i></button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }

    function datosBasicos($ti, $fechaexp){
        $con = conectar();

        $consulta = "SELECT usuario.ccusuario, usuario.nombres, usuario.apellidos, usuario.genero, usuario.fechaexpedicion, usuario.fechanacimiento FROM usuario WHERE ccusuario = '$ti' AND fechaexpedicion = '$fechaexp'";
        echo "</br>";
        echo '<h3><i class="fas fa-user"></i> Datos Basicos</h3>';
        echo '<table class="table table-hover">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Genero</th>';
        echo '<th>Cedula</th>';
        echo '<th>Fecha de Expedición</th>';
        echo '<th>Fecha de Nacimiento</th>';
        echo '</tr>';
        echo '</thead>';
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            echo '<tr>';
            echo '<td>'.$valores["nombres"].'</td>';
            echo '<td>'.$valores["apellidos"].'</td>';
            if($valores["genero"]==1){
                echo '<td>Femenino</td>';
            }
            if($valores["genero"]==2){
                echo '<td>Masculino</td>';
            }
            if($valores["genero"]==3){
                echo '<td>Otro</td>';
            }
            echo '<td>'.$valores["ccusuario"].'</td>';
            echo '<td>'.$valores["fechaexpedicion"].'</td>';
            echo '<td>'.$valores["fechanacimiento"].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    function datosDireccion($ti, $fechaexp){
        $con = conectar();

        $consulta = "SELECT usuario.ccusuario, usuario.direccion, usuario.telefono, usuario.correo, usuario.adjuntar FROM usuario WHERE ccusuario = '$ti' AND fechaexpedicion = '$fechaexp'";

        echo '</table>';
        echo '<table class="table table-hover">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th class="text-center">Dirección</th>';
        echo '<th class="text-center">Telefono</th>';
        echo '<th class="text-center">Correo</th>';
        echo '<th class="text-center">Archivo Documento Identidad</th>';
        echo '</tr>';
        echo '</thead>';
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            echo '<tr>';
            echo '<td class="text-center">'.$valores["direccion"].'</td>';
            echo '<td class="text-center">'.$valores["telefono"].'</td>';
            echo '<td class="text-center">'.$valores["correo"].'</td>';
            echo '<td class="text-center"><a href="public/documentos/archivo.php?id='.$valores["ccusuario"].'" target="_blank"><img src="public/img/archivo.png" alt="Archivo" width="30" height="30"></td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    function datosConsulta($ti, $fechaexp){
        $con = conectar();

        $consulta = "SELECT datosconsultas.descripcion, datosconsultas.tipoconsulta, datosconsultas.fechaconsulta FROM usuario inner join datosconsultas on datosconsultas.idconsultas = usuario.Idconsultas WHERE ccusuario = '$ti' AND fechaexpedicion = '$fechaexp'";

        echo "</br>";
        echo '<h3><i class="fas fa-search"></i> Datos de la Consulta</h3>';
        echo '</table>';
        echo '<table class="table table-hover table-responsive-sm">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th>Descripcion</th>';
        echo '<th>Tipo de Consulta</th>';
        echo '<th>Fecha de la Consulta</th>';
        echo '</tr>';
        echo '</thead>';
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            echo '<tr>';
            echo '<td width="650">'.$valores["descripcion"].'</td>';
            if($valores["tipoconsulta"]==1){
                echo '<td width="280">Consulta Virtual Individual</td>';
            }
            if($valores["tipoconsulta"]==2){
                echo '<td width="280">Consulta Domiciliaria</td>';
            }
            if($valores["tipoconsulta"]==3){
                echo '<td width="280">Consulta de Despacho</td>';
            }
            echo '<td>'.$valores["fechaconsulta"].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    function sintomas($ti, $fechaexp){
        $con = conectar();

        $consulta = "SELECT sintomas.nombresintoma FROM usuario
        inner join datosconsultas on datosconsultas.idconsultas = usuario.Idconsultas
        inner join datosconsulta_sintomas on datosconsulta_sintomas.Idconsultas = datosconsultas.idconsultas
        inner join sintomas on sintomas.idsintomas = datosconsulta_sintomas.IdSintomas
        WHERE ccusuario = '$ti' AND fechaexpedicion = '$fechaexp'";

        echo "<h5 class='parrafo'><i class='fas fa-viruses'></i> Sintomas</h5>";
        echo '<ul class="live">';
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            echo '<li class="titulo">'.$valores["nombresintoma"].'</li>';
        }
        echo '</ul>';
    }

    function datosDoctor($ti, $fechaexp){
        $con = conectar();

        $consulta = "SELECT especialistas.ccespe, especialistas.nombreespe, especialistas.apellidoespe, tipoespecialista.nombretipoesp FROM usuario
        inner join especialistas on especialistas.ccespe = usuario.CCespe
        inner join tipoespecialista on tipoespecialista.idtipo = especialistas.Idtipo
        WHERE ccusuario = '$ti' AND fechaexpedicion = '$fechaexp'";

        echo "</br>";
        echo '<h3><i class="fas fa-user-md"></i> Datos Del Especialista</h3>';
        echo '</table>';
        echo '<table class="table table-hover">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Cedula</th>';
        echo '<th>Especialidad</th>';
        echo '</tr>';
        echo '</thead>';
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            echo '<tr>';
            echo '<td>'.$valores["nombreespe"].'</td>';
            echo '<td>'.$valores["apellidoespe"].'</td>';
            echo '<td>'.$valores["ccespe"].'</td>';
            echo '<td>'.$valores["nombretipoesp"].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
?>