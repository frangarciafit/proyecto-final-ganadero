    <?php

    $con = new mysqli("localhost", "root", "", "ganadero");


    $funcion = isset($_POST['funcion']) ? $_POST["funcion"] : "";
    if ($funcion == "agregar_vaca") {
        $color = isset($_POST['color']) ? $_POST["color"] : "";
        $caravana = isset($_POST['caravana']) ? $_POST["caravana"] : "";
        $raza = isset($_POST['raza']) ? $_POST["raza"] : "";
        $peso = isset($_POST['peso']) ? $_POST["peso"] : "";
        $caravanaajena = isset($_POST['caravanaajena']) ? $_POST["caravanaajena"] : "";
        $nacimiento = isset($_POST['nacimiento']) ? $_POST["nacimiento"] : "";
        $sexo = isset($_POST['sexo']) ? $_POST["sexo"] : "";
        $lugar = isset($_POST['lugar']) ? $_POST["lugar"] : "";


        $sql = "INSERT INTO animal (caravanapropia, caravanaajena, raza, nacimiento, peso, color, lugar, sexo) VALUES ('$caravana', '$caravanaajena', '$raza', '$nacimiento','$peso', '$color','$lugar','$sexo') ";

        $stmt = $con->prepare($sql);

        $stmt->execute();
        $resultado = $stmt->get_result();
    } else {
        if ($funcion == "eliminar") {
            $id = isset($_POST['id']) ? $_POST["id"] : "";
            $sql = "DELETE FROM animal WHERE caravanapropia = $id";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->get_result();
        }
    }

    function cargartodo()
    {
      global $con;
      $sql = "SELECT * FROM animal";
      $stmt = $con->prepare($sql);
  
      $stmt->execute();
      $resultado = $stmt->get_result();
  
      return $resultado;
    }



    ?>