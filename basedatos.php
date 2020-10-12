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
        include("particiones/menu.php");
    ?>
    <div class="container mt-5 mb-5">
        <div class="card animate__animated animate__pulse animate__lightSpeedInLeft">
            <div class="card-header text-center">
                <h3 class="titulo"><i class="fas fa-scroll"></i> Consultar Datos</h3>
            </div>
            <div class="card-body">
                <form action="basedatos.php" method="POST">
                    <div class="form-group">
                        <label class="col control-label parrafo">Documento de Identidad</label>
                        <input id="cuenta" type="Number" min="0" name="Documento" class="form-control redondear"
                            placeholder="Ingrese el Documento" autofocus required>
                        <div id="encontrado"></div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label parrafo">Fecha de Expedecion del Documento</label>
                        <input type="date" name="FechaExpedicion" class="form-control redondear"
                            placeholder="DD/MM/AAAA" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info btn-block" type="submit">Consultar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php
            include("dbconnection/verificationform.php");
        ?>
        <br>
        <br>
        <br>
        <br>
    </div>
    <?php
        include("particiones/pie.php");
    ?>
    <script src="dbconnection/useronready/jquery.min.js"></script>
    <script src="dbconnection/useronready/main.js"></script>
</body>

</html>