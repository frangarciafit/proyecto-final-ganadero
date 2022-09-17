<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@200&family=Splash&family=Trispace:wght@200&display=swap" rel="stylesheet">
  
  <title>Ganadero</title>
</head>

<body id="blur">

  <nav >
    <p>Agregar animal</p>
    <a href="../index.php">Volver</a>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert">
      <ul>
        <li>
          <label for="">Caravana propia</label>
          <input type="number" id="caravanapropia" min="0" required>
        </li>
        <li>
          <label for="">Caravana ajena</label>
          <input type="number" id="caravanaajena" min="0" placeholder="Opcional">
        </li>
        <li>
          <label for="">Raza</label>
          <input type="text" id="raza" required>
        </li>
        <li>
          <label for="">Nacimiento</label>
          <input type="date" id="nacimiento" required>
        </li>
        <li>
          <label for="">Peso</label>
          <input type="number" id="peso" step="0.01" min="0" required>
        </li>
        <li>
          <label for="">Color</label>
          <input type="text" id="color" required>
        </li>
        <li>
          <label for="">Lugar</label>
          <input type="text" id="lugar" required>
        </li>
        <li>
          <label for="">Sexo</label>
          <select id="sexo" required>
            <option value="macho">Macho</option>
            <option value="hembra" selected>Hembra</option>
          </select>
        </li>
      </ul>
      <button type="submit" class="enviar" id="insertar" onclick="agregar_animal()">Enviar</button>
    </form>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>


  <script>
    function agregar_animal() {
      let caravana = $("#caravanapropia").val();
      let caravanaajena = $("#caravanaajena").val();
      let raza = $("#raza").val();
      let nacimiento = $("#nacimiento").val();
      let peso = $("#peso").val();
      let color = $("#color").val();
      let sexo = $("#sexo").val();
      let lugar = $("#lugar").val();
      console.log(sexo);
      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "caravana": caravana,
          "raza": raza,
          "peso": peso,
          "color": color,
          "caravanaajena": caravanaajena,
          "nacimiento": nacimiento,
          "sexo": sexo,
          "lugar": lugar,
          "funcion": "agregar_vaca",
        },
        success: function(r) {
          if (r.error == 0) {
            console.log("Exitoso")
          } else {
            console.log(r.error);
          }
        },
      })

    }
  </script>



</body>

</html>