<!-- TODO
- Guardar datos en BD de edit
- Sintomas (A medias)
- Arreglar especialistas
- Guardar como PDF (Opcional)
- Limpiar Base de Datos
- Modal para validar cambios y cancelar cambios
-->

<?php
    include("dbconnection/conexion.php");
    /* include("dbconnection/verificationedit.php"); */
?>

<?php
    if(isset($_POST['Documentos'])){
        $cedula = $_POST['Documentos'];
        $fecha = $_POST['FechaVencimiento'];

        $con = conectar();

        $consulta = "SELECT usuario.ccusuario, usuario.nombres, usuario.apellidos, usuario.genero, usuario.fechaexpedicion, usuario.fechanacimiento, usuario.direccion, usuario.telefono, usuario.correo, usuario.adjuntar, datosconsultas.descripcion, datosconsultas.tipoconsulta, datosconsultas.fechaconsulta, tipoespecialista.idtipo FROM usuario
        inner join datosconsultas on datosconsultas.idconsultas = usuario.Idconsultas
        inner join especialistas on especialistas.ccespe = usuario.Ccespe
        inner join tipoespecialista on tipoespecialista.idtipo = especialistas.Idtipo
        WHERE ccusuario = '$cedula' AND fechaexpedicion = '$fecha'";
        $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
        while ($valores = mysqli_fetch_array($resultado)) {
            $nombre = $valores["nombres"];
            $apellidos = $valores["apellidos"];
            if($valores["genero"]==1){
                $genero = 'Femenino';
            }
            if($valores["genero"]==2){
                $genero = 'Masculino';
            }
            if($valores["genero"]==3){
                $genero = 'Otro';
            }
            $fechanac = $valores["fechanacimiento"];
            $mail = $valores["correo"];
            $date = $valores["direccion"];
            $tel = $valores["telefono"];
            $details = $valores["descripcion"];
            $archivo = $valores["adjuntar"];
            $tipocons = $valores["tipoconsulta"];
            $tipoespe = $valores["idtipo"];
            $fechaconsul = $valores["fechaconsulta"];
        }
    }
?>
<?php
    include("particiones/head.php");
?>

<!-- Modal para Cancelar Accion -->
<div class="modal animate__animated animate__jackInTheBox" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Confirmar</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Esta Seguro de Eliminar esta Inquietud?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="inquietudes.php" method="POST">
                    <input type="hidden" name="eliminar" id="deletee">
                    <button type="submit" class="btn btn-danger">Si, Estoy seguro</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Validar Accion -->
<div class="modal animate__animated animate__jackInTheBox" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Confirmar</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Esta Seguro de Eliminar esta Inquietud?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="inquietudes.php" method="POST">
                    <input type="hidden" name="eliminar" id="deletee">
                    <button type="submit" class="btn btn-danger">Si, Estoy seguro</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Editar -->
<head>
    <link rel="stylesheet" href="public/css/edit.css">
</head>

<nav class="navbar navbar-dark bg-dark d-flex justify-content-center">
  <strong><a class="nav-link text-light titulo"><img src="./public/img/ico.png" width="50" alt="logo"> Editar Formulario</a></strong>
</nav>

<?php
    include("dbconnection/verificationedit.php");
?>

<div class="row mt-5 mb-5">
    <div class="col-3">
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body text-left">
                <form action="editar.php" method="POST" enctype="multipart/form-data">
                    <h3 class="titulo"><i class="fas fa-user"></i> Datos Personales</h3>
                    <div class="form-group">
                        <label class="col control-label parrafo">Nombres</label>
                        <div class="col">
                            <input type="text" name="Nombres" class="form-control redondear"
                                placeholder="Ingrese sus Nombres" <?php echo "value='$nombre'"; ?> autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Apellidos</label>
                        <div class="col">
                            <input type="text" name="Apellidos" class="form-control redondear"
                                placeholder="Ingrese sus Apellidos" <?php echo "value='$apellidos'"; ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Documento de Identidad</label>
                        <div class="col">
                            <input type="Number" min="0" name="Doc" class="form-control redondear"
                                placeholder="Ingrese su número de Identificación" <?php echo "value='$cedula'"; ?> readonly>
                            <div id="usuarioEncontrado"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Expedecion del Documento</label>
                        <div class="col">
                            <input type="date" name="FechaVencimiento" class="form-control redondear"
                                placeholder="DD/MM/AAAA" <?php echo "value='$fecha'"; ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Género</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="femenino" value="Femenino"
                                    <?php if($genero=="Femenino"){echo "checked";} ?> >
                                    <label for="femenino"> Femenino</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="masculino" value="Masculino"
                                    <?php if($genero=="Masculino"){echo "checked";} ?> >
                                    <label for="masculino"> Masculino</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="otro" value="Otro"
                                    <?php if($genero=="Otro"){echo "checked";} ?> >
                                    <label for="otro"> Otro</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Nacimiento</label>
                        <div class="col">
                            <input type="date" name="FechaNacimiento" class="form-control redondear"
                                placeholder="DD/MM/AAAA" <?php echo "value='$fechanac'"; ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Direccion</label>
                        <div class="col">
                            <input type="text" name="Direccion" class="form-control redondear"
                                placeholder="Ingrese Direccion de vivienda" <?php echo "value='$date'"; ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Telefono</label>
                        <div class="col">
                            <input type="Number" min="0" name="Telefono" class="form-control redondear"
                                placeholder="Ingrese su telefono" <?php echo "value='$tel'"; ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Correo</label>
                        <div class="col">
                            <input type="email" name="Correo" class="form-control redondear"
                                placeholder="Ingrese su Correo" <?php echo "value='$mail'"; ?> >
                        </div>
                    </div>
                    <h3 class="titulo"><i class="fas fa-pen-square"></i> Datos de Consulta</h3>
                    <div class="form-group">
                        <label class="col control-label parrafo">Tipo de Consulta</label>
                        <select name="TipoConsulta" class="col form-control redondear" >
                            <option name="TipoConsulta" value="CInd" <?php if($tipocons==1){echo "selected";} ?> >Consulta Virtual Individual</option>
                            <option name="TipoConsulta" value="CDom" <?php if($tipocons==2){echo "selected";} ?> >Consulta Domiciliaria</option>
                            <option name="TipoConsulta" value="CDes" <?php if($tipocons==3){echo "selected";} ?> >Consulta de Despacho</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col control-label parrafo">Especialista</label>
                        <select name="Especialistas" class="col form-control redondear" >
                            <?php
                                $con = conectar();
                                $consulta = "SELECT * FROM tipoespecialista";
                                $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
                                while ($valores = mysqli_fetch_array($resultado)) {
                                    echo '<option name="Especialistas" value="'.$valores["nombretipoesp"].'">'.$valores["nombretipoesp"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Consulta</label>
                        <div class="col">
                            <input name="FechaConsulta" class="form-control redondear"
                            <?php echo "value='$fechaconsul'"; ?> readonly>
                            <div id="usuarioEncontrado"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Sintomas Generales:</label>
                        <div class="card-columns">
                            <?php
                                $con = conectar();
                                $consulta = "SELECT * FROM sintomas";
                                $resultado = mysqli_query($con, $consulta) or die ( "Algo ha salido mal en la consulta a la base de datos");
                                while ($valores = mysqli_fetch_array($resultado)) {
                                    echo '<div class="card">';
                                    echo '<div class="form-group form-control" style="font-size: 77%;">';
                                    echo '<input type="checkbox" name="sintoma[]" id="'.$valores["nombresintoma"].'" value="'.$valores["nombresintoma"].'"> <label for="'.$valores["nombresintoma"].'"> '.$valores["nombresintoma"].'</label>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                        <h6 class="text-center"><strong>Seleccione al menos un sintoma.</strong></h6>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Detalles:</label>
                        <textarea type="text" name="Descripcion" class="form-control redondear"
                            placeholder="Descripción de tu estado" ><?php echo $details; ?></textarea>
                    </div>
                    <div class="form-group" id="divArchivo">
                        <p class="parrafo" id="textArchivo"><i class="fas fa-paperclip"></i> Adjuntar</p>
                        <input type="file" name="Adjuntar" id="archivo" onchange="cambio()" accept=".pdf">
                    </div>
                    <p class="fuenteArchivo" id="nameArchivo"><?php echo $archivo; ?></p>

                    <!-- Boton -->
                    <div class="form-group">
                        <label class="col control-label">&nbsp;</label>
                        <div class="col">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-book"></i> Actualizar Consulta</button>
                            <a href="basedatos.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="public/js/verificacion.js"></script>