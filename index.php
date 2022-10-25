<!DOCTYPE html>
<html>
<?php include("./funciones.php") ?>

<?php include_once("includes/head.php"); ?>

<body>
  
  <nav id="menu">
    <ul>
      <li><a href="">Agregar animal</a>
        <ul>
          <li><a href="/views/agregar.php">Por compra</a></li>
          <li><a href="/views/agregarNacimiento.php">Por Nacimiento</a></li>
        </ul>
      </li>
    </ul>
    <a href="/views/consulta.php">Consulta de datos</a>

   <ul>
      <li><a href=""><i class="fa fa-user-circle" aria-hidden="true"></i></a>
        <ul>
          <li><a href="/cambiarContraseña.php">Cambiar Contraseña</a></li>
          <li><a href="/cerrarSesion.php">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
        </ul>
      </li>
    </ul>

  </nav>

<?php $datos=cantidadAnimales()?>

<p class="mostradoTotal">Cantidad de animales: <?php echo $datos->num_rows?></p>

  <footer>

    <p>Lautaro Linari | Lucas Mezza | Francisco Garcia</p>

  </footer>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>
