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
        <?php
            include("dbconnection/verificationform.php");
        ?>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th><strong>Id</strong></th>
                    <th>Correo</th>
                    <th>Inquietud</th>
                    <th></th>
                </tr>
            </thead>
            <?php
                $con = conectar();
                $consulta = "SELECT * FROM inquietud";
                $resultado = mysqli_query( $con, $consulta ) or die ( "Algo ha salido mal en la consulta a la base de datos");
                while ($valores = mysqli_fetch_array($resultado)) {
                    echo '<tr>';
                    echo '<td><strong>'.$valores["idinquietud"].'</strong></td>';
                    echo '<td>'.$valores["email"].'</td>';
                    echo '<td>'.$valores["descripcioni"].'</td>';
                    echo '<td><input type="hidden" name="dato[]"><button class="borrarinq btn" data-toggle="modal" data-target="#myModal"><i class="far fa-trash-alt text-danger"></i></button></form></td>';
                    echo '</tr>';
                }
            ?>
        </table>
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
    </div>
    <?php
        include("particiones/pie.php");
    ?>
    <script>
    $('.borrarinq').on("click", function() {
        $tr = $(this).closest("tr");
        var datos = $tr.children("td").map(function() {
            return $(this).text();
        });
        $("#deletee").val(datos[0]);
    });

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus');
    })
    </script>
</body>

</html>