<!DOCTYPE html>
<html>
<?php include("./funciones.php") ?>

<?php include_once("includes/head.php"); ?>

<body>

    <nav>
        <p>Cambiar contraseña</p>
        <a href="./index.php">Volver</a>
    </nav>

    <section class="login formulario">
        <form>
            <label for="">Contraseña actual</label>
            <input type="text" name="txtContraseñaActual" id="oldContraseña">
            <label for="">Nueva Contraseña</label>
            <input type="password" name="pasPassword" id="newContraseña">
            <a class="enviar1" name="subLogin" onclick="nuevaPassword()" id="login">Enviar</a>
        </form>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function nuevaPassword() {
            let newContraseña = $("#newContraseña").val();
            let oldContraseña = $("#oldContraseña").val();
            
            if (newContraseña == "") {
                alert("Por favor ingrese la contraseña actual");
                return false;
            }

            if (oldContraseña == "") {
                alert("Por favor ingrese la nueva contraseña");
                return false;
            }

            $.ajax({
                "url": "./funciones.php",
                "type": "post",
                "dataType": "json",
                "data": {
                    "newContraseña": newContraseña,
                    "oldContraseña": oldContraseña,
                    "funcion": "newContraseña",
                },
                success: function(r) {
                    if (r.error == 0) {
                        alert("La contraseña ha sido cambiada con exito.")
                        //   location.href="index.php"
                    } else {
                        alert("La contraseña actual no coincide.")
                    }
                },
            })

        }
    </script>
</body>

</html>