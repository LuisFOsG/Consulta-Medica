<!-- TODO
- Estilo
- Verificar PDF
- Guardar datos en BD
- Arreglar especialistas
- Guardar como PDF (Opcional)
- Cambiar el pie de Pagina
 -->

<?php
    include("dbconnection/conexion.php");//Conexión a la Base de Datos

    if(isset($_POST['cedr'])){
        $cedula = $_POST['cedr'];
        $fecha = $_POST['venci'];

        $con = conectar();

        $consulta = "SELECT usuario.ccusuario, usuario.nombres, usuario.apellidos, usuario.genero, usuario.fechaexpedicion, usuario.fechanacimiento, usuario.direccion, usuario.telefono, usuario.correo, usuario.adjuntar, datosconsultas.descripcion, datosconsultas.tipoconsulta, tipoespecialista.idtipo FROM usuario
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
        }
    }
?>
<?php
        include("particiones/head.php");
?>

<div class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Editar Formulario</h1>
            </div>
            <div class="card-body text-left">
                <form action="formulario.php" method="POST" enctype="multipart/form-data">
                    <h3 class="titulo"><i class="fas fa-user"></i> Datos Personales:</h3>
                    <div class="form-group">
                        <label class="col control-label parrafo">Nombres</label>
                        <div class="col">
                            <input type="text" name="Nombres" class="form-control redondear"
                                placeholder="Ingrese sus Nombres" <?php echo "value='$nombre'"; ?> required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Apellidos</label>
                        <div class="col">
                            <input type="text" name="Apellidos" class="form-control redondear"
                                placeholder="Ingrese sus Apellidos" <?php echo "value='$apellidos'"; ?> required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Documento de Identidad</label>
                        <div class="col">
                            <input id="cambioo" type="Number" min="0" name="Documentos" class="form-control redondear"
                                placeholder="Ingrese su número de Identificación" <?php echo "value='$cedula'"; ?> required>
                            <div id="usuarioEncontrado"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Expedecion del Documento</label>
                        <div class="col">
                            <input type="date" name="FechaVencimiento" class="form-control redondear"
                                placeholder="DD/MM/AAAA" <?php echo "value='$fecha'"; ?> required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Género</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="femenino" value="Femenino"
                                    <?php if($genero=="Femenino"){echo "checked";} ?> >
                                    <label for="femenino" required> Femenino</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="masculino" value="Masculino"
                                    <?php if($genero=="Masculino"){echo "checked";} ?> >
                                    <label for="masculino" required> Masculino</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="otro" value="Otro"
                                    <?php if($genero=="Otro"){echo "checked";} ?> required>
                                    <label for="otro"> Otro</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Nacimiento</label>
                        <div class="col">
                            <input type="date" name="FechaNacimiento" class="form-control redondear"
                                placeholder="DD/MM/AAAA" <?php echo "value='$fechanac'"; ?> required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Direccion</label>
                        <div class="col">
                            <input type="text" name="Direccion" class="form-control redondear"
                                placeholder="Ingrese Direccion de vivienda" <?php echo "value='$date'"; ?> required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Telefono</label>
                        <div class="col">
                            <input type="Number" min="0" name="Telefono" class="form-control redondear"
                                placeholder="Ingrese su telefono" <?php echo "value='$tel'"; ?> required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Correo</label>
                        <div class="col">
                            <input type="email" name="Correo" class="form-control redondear"
                                placeholder="Ingrese su Correo" <?php echo "value='$mail'"; ?> required>
                        </div>
                    </div>
                    <h3 class="titulo"><i class="fas fa-pen-square"></i> Datos de Consulta:</h3>
                    <div class="form-group">
                        <label class="col control-label parrafo">Tipo de Consulta</label>
                        <select name="TipoConsulta" class="col form-control redondear" required>
                            <option name="TipoConsulta" value="CInd" <?php if($tipocons==1){echo "selected";} ?> >Consulta Virtual Individual</option>
                            <option name="TipoConsulta" value="CDom" <?php if($tipocons==2){echo "selected";} ?> >Consulta Domiciliaria</option>
                            <option name="TipoConsulta" value="CDes" <?php if($tipocons==3){echo "selected";} ?> >Consulta de Despacho</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col control-label parrafo">Especialista</label>
                        <select name="Especialistas" class="col form-control redondear" required>
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
                            placeholder="Descripción de tu estado" required><?php echo $details; ?></textarea>
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
                            <button type="submit" class="btn btn-primary"><i class="fas fa-book"></i> Enviar
                                Formulario</button>
                            <a href="index.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
