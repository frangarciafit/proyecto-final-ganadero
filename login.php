<!DOCTYPE html>
<html>
<?php include("./funciones.php") ?>

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@200&family=Splash&family=Trispace:wght@200&display=swap" rel="stylesheet">

  <title>Ganadero</title>
</head>


<body id="blur">
  <nav class="invisible">
  </nav>

  <section class="login formulario">
    <h1>Iniciar Sesion</h1>
    <form>
      <label for="">Usuario</label>
      <input type="text" name="txtUsuario" id="usuario">
      <label for="">Contraseña</label>
      <input type="password" name="pasPassword" id="password">
      <a class="enviar1" name="subLogin" onclick="login()" id="login">Ingresar</a>
    </form>
  </section>


  <footer>

    <p>Lautaro Linari | Lucas Mezza | Francisco Garcia</p>

  </footer>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  function login() {
    let usuario = $("#usuario").val();
    let password = $("#password").val();
    
    if (usuario == "") {
      alert ("Por favor ingrese un usuario");
      return false;
    }

    if (password == "") {
      alert ("Por favor ingrese un password");
      return false;
    }

    $.ajax({
      "url": "./funciones.php",
      "type": "post",
      "dataType": "json",
      "data": {
        "usuario": usuario,
        "password": password,
        "funcion": "login",
      },
      success: function(r) {
        if (r.error == 0) {
          location.href="index.php"
        } else {
          alert("El usuario o contraseña son incorrectos.")
        }
      },
    })

  }
</script>

</html>