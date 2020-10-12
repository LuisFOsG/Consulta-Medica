<?php
include("dbconnection/conexion.php");//Conexión a la Base de Datos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/css/utillogin.css">
    <link rel="stylesheet" type="text/css" href="public/css/colorlogin.css">
    <!--===============================================================================================-->
    <?php
        include("particiones/head.php");
    ?>
    <!--===============================================================================================-->
</head>

<body>
    <?php
        include("particiones/menu.php");
    ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="col-12">
            <?php
                include("dbconnection/verificationform.php");
            ?>
            </div>
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img class="animate__animated animate__tada" src="public/img/img1.png" alt="IMG">
                </div>

                <form action="login.php" method="POST" class="login100-form validate-form">
                    <span class="titulologin login100-form-title">
                        <i class="fas fa-users"></i> Administración
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="El Nombre es Necesario">
                        <input class="textlogin input100" type="text" name="nick" placeholder="Nombre">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="La Contraseña es Necesaria">
                        <input class="textlogin input100" type="password" name="password" placeholder="Contraseña">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="titulologin login100-form-btn" style="font-size: 18px;">
                            Ingresar
                        </button>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <?php
        include("particiones/pie.php");
    ?>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
    </script>
    <!--===============================================================================================-->
    <script src="public/js/mainlogin.js"></script>
</body>

</html>