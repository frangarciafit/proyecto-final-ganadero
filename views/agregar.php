<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/index.css">

  <title>Ganadero</title>
</head>

<body id="blur">

  <nav>
    <p>Agregar animal</p>
    <a href="../index.php">Volver</a>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert">
      <ul>
        <li>
          <label for="">Caravana propia</label>
          <input type="number" id="caravanapropia" name="caravanapropia" min="0" required>
        </li>
        <!-- <li>
          <label for="">Caravana ajena</label>
          <input type="number" name="caravanaajane" min="0" placeholder="Opcional">
        </li> -->
        <li>
          <label for="">Raza</label>
          <input type="text" id="raza" name="raza" required>
        </li>
        <!-- <li>
          <label for="">Nacimiento</label>
          <input type="date" name="nacimiento" required>
        </li> -->
        <li>
          <label for="">Peso</label>
          <input type="number" id="peso" name="peso" step="0.01" min="0" required>
        </li>
        <li>
          <label for="">Color</label>
          <input type="text" id="color" name="color" required>
        </li>
        <li>
          <!-- <label for="">Sexo</label>
          <div>
          <label for="">Macho</label>
          <input type="radio" id="macho" name="sexo" required></div>

          <div>
          <label for="">Hembra</label>
          <input type="radio" id="hembra" name="sexo" required></div>
        </li> -->
      </ul>
      <button type="submit" class="enviar" id="insertar" onclick="agregar_animal()">Enviar</button>
    </form>
  </section>

  <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>


  <script>
  function agregar_animal(){
    let caravana = $("#caravanapropia").val();
    let raza = $("#raza").val();
    let peso = $("#peso").val();
    let color = $("#color").val();
    console.log("AGREGAR ANIMAL", caravana, raza, peso, color);
    $.ajax({
                "url": "../funciones.php",
                "type": "post",
                "dataType": "json",
                "data":{
                    "caravana": caravana,
                    "raza": raza,
                    "peso": peso,
                    "color": color,
                    "funcion": "agregar_vaca",    
                },success:function(r){
                    if (r.error == 0) {
                      console.log("Exitoso")
                    }else{
                      console.log(r.error);
                    }
                },
    })
  
  }

  </script>



</body>

</html>
