<!DOCTYPE html>
<html>
<?php include("../funciones.php") ?>

<?php include_once("../includes/head.php"); ?>

<body id="blur">

  <nav>
    <p>Agregar por compra</p>
    <a href="../index.php">Volver</a>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="post">
      <ul>
        <li>
          <label for="">Caravana propia</label>
          <input type="text" name="txtCaravanaPropia" minlength="10" maxlength="12" min="0" onkeyup="this.value=this.value.toLowerCase()" required>
        </li>
        <li>
          <label for="">Caravana ajena</label>
          <input type="text" name="txtCaravanaAjena" minlength="10" maxlength="12" min="0" onkeyup="this.value=this.value.toLowerCase()" placeholder="Opcional">
        </li>
        <li>
          <label for="">Raza</label>
          <input type="text" name="txtRaza" onkeyup="this.value=this.value.toLowerCase()" required>
        </li>
        <li>
          <label for="">Nacimiento</label>
          <input type="date" name="datNacimiento" id="datNacimiento">
        </li>
        <li>
          <label for="">Peso</label>
          <input type="number" name="numPeso" id="numPeso" step="0.01" min="120" max="9999" required>
        </li>
        <li>
          <label for="">Fecha ingreso</label>
          <input type="date" name="datFecha" required>
        </li>
        <li>
          <label for="">Color</label>
          <input type="text" name="txtColor" id="txtColor" onkeyup="this.value=this.value.toLowerCase()" required>
        </li>
        <li>
          <label for="">Lugar</label>
          <input type="text" name="txtLugar" id="txtLugar" onkeyup="this.value=this.value.toLowerCase()" required>
        </li>
        <li>
          <label for="">Sexo</label>
          <select name="selSexo" id="selSexo" required>
            <option value="macho">Macho</option>
            <option value="hembra" selected>Hembra</option>
          </select>
        </li>
      </ul>
      <input onclick="" class="enviar1" type="submit" name="subAgregar" id="subAgregar">
    </form>
  </section>
</body>
</html>