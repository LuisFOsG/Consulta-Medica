<?php
include("dbconnection/conexion.php");//Conexión a la Base de Datos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
        include("particiones/head.php");
    ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- DEPENDENCIAS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        include("particiones/menu.php");
    ?>
    <div class="container">

        <?php
        include("dbconnection/verificationform.php");
        ?>

        <div class="row mt-3">
            <div class="col-12 col-lg-6 animate__animated animate__backInLeft">
                <form id="formulario" action="formulario.php" method="POST" enctype="multipart/form-data">
                    <h3 class="titulo"><i class="fas fa-user"></i> Datos Personales:</h3>
                    <div class="form-group">
                        <label class="col control-label parrafo">Nombres</label>
                        <div class="col">
                            <input type="text" name="Nombres" class="form-control redondear"
                                placeholder="Ingrese sus Nombres" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Apellidos</label>
                        <div class="col">
                            <input type="text" name="Apellidos" class="form-control redondear"
                                placeholder="Ingrese sus Apellidos" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Documento de Identidad</label>
                        <div class="col">
                            <input id="cambioo" type="Number" min="0" name="Documentos" class="form-control redondear"
                                placeholder="Ingrese su número de Identificación" required>
                            <div id="usuarioEncontrado"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Expedecion del Documento</label>
                        <div class="col">
                            <input type="date" name="FechaVencimiento" class="form-control redondear"
                                placeholder="DD/MM/AAAA" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Género</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="femenino" value="Femenino"> <label
                                        for="femenino" required> Femenino</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="masculino" value="Masculino"> <label
                                        for="masculino" required> Masculino</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-control redondear">
                                    <input type="radio" name="genero" id="otro" value="Otro" required> <label
                                        for="otro"> Otro</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Nacimiento</label>
                        <div class="col">
                            <input type="date" name="FechaNacimiento" class="form-control redondear"
                                placeholder="DD/MM/AAAA" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Direccion</label>
                        <div class="col">
                            <input type="text" name="Direccion" class="form-control redondear"
                                placeholder="Ingrese Direccion de vivienda" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Telefono</label>
                        <div class="col">
                            <input type="Number" min="0" name="Telefono" class="form-control redondear"
                                placeholder="Ingrese su telefono" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Correo</label>
                        <div class="col">
                            <input type="email" name="Correo" class="form-control redondear"
                                placeholder="Ingrese su Correo" required>
                        </div>
                    </div>
                    <h3 class="titulo"><i class="fas fa-pen-square"></i> Datos de Consulta:</h3>
                    <div class="form-group">
                        <label class="col control-label parrafo">Tipo de Consulta</label>
                        <select name="TipoConsulta" class="col form-control redondear" required>
                            <option name="TipoConsulta" value="CInd">Consulta Virtual Individual</option>
                            <option name="TipoConsulta" value="CDom">Consulta Domiciliaria</option>
                            <option name="TipoConsulta" value="CDes">Consulta de Despacho</option>
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
                        <label class="col control-label parrafo">Fecha de Consulta</label>
                        <select name="FechaConsulta" class="col form-control redondear" required>
                            <?php
                                date_default_timezone_set("America/Bogota");
                                $dia = date("d");
                                $mes = date("m");
                                $anio = date("Y");
                                $dia +=1;
                                if($dia<10){
                                    $fechaManana = $anio . "-" . $mes . "-0" . $dia;
                                }else{
                                    $fechaManana = $anio . "-" . $mes . "-" . $dia;
                                }

                                $dia +=1;
                                if($dia<10){
                                    $fechaPasMan = $anio . "-" . $mes . "-0" . $dia;
                                }else{
                                    $fechaPasMan = $anio . "-" . $mes . "-" . $dia;
                                }

                                $dia +=1;
                                if($dia<10){
                                    $fechaPasPasMan = $anio . "-" . $mes . "-0" . $dia;
                                }else{
                                    $fechaPasPasMan = $anio . "-" . $mes . "-" . $dia;
                                }

                                echo '<option name="FechaConsulta" value="1">'.$fechaManana.'</option>';
                                echo '<option name="FechaConsulta" value="2">'.$fechaPasMan.'</option>';
                                echo '<option name="FechaConsulta" value="3">'.$fechaPasPasMan.'</option>';
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
                            placeholder="Descripción de tu estado" required></textarea>
                    </div>
                    <div class="form-group" id="divArchivo">
                        <p class="parrafo" id="textArchivo"><i class="fas fa-paperclip"></i> Adjuntar</p>
                        <input type="file" name="Adjuntar" id="archivo" onchange="cambio()" accept=".pdf" required>
                    </div>
                    <p class="fuenteArchivo" id="nameArchivo">Adjuntar Documento de Identidad</p>

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
            <!-- AQUI HAY OTRO FORMULARIO ===================================================================== -->
            <div class="col d-block animate__animated animate__backInRight">

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="4000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="public/img/formulario.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="public/img/formulario1.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="public/img/formulario2.jpg" alt="Third slide">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="titulo"><i class="fas fa-bullhorn"></i> Inquietudes</h3>
                    </div>
                    <div class="card-body">
                        <form action="formulario.php" method="POST">
                            <div class="form-group">
                                <input type="email" name="Email" class="form-control redondear" placeholder="Correo"
                                    required>
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="DescripcionI" class="form-control redondear"
                                    placeholder="Inquietud" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" class="form-control" type="submit"><i
                                        class="fas fa-paper-plane"></i> Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#formulario').submit(function(e){
            if ($('input[type=checkbox]:checked').length === 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Debes seleccionar al menos un síntoma',
                    icon: 'error',
                    confirmButtonText: 'Ok, Entiendo'
                });
            }else{
                window.location.assign("formulario.php");
            }
        });
    </script>

    <script src="dbconnection/useronready/main.js"></script>
    <script src="public/js/verificacion.js"></script>
    <?php
        include("particiones/pie.php");
    ?>
</body>

</html>