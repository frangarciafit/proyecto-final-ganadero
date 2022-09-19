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

    function cargartodo($conf = array())
    {
      global $con;

      $caravanapropia = isset($conf["caravanapropia"]) ? $conf["caravanapropia"] : "";
      $caravanaajena = isset($conf["caravanaajena"]) ? $conf["caravanaajena"] : "";
      $sexo = isset($conf["sexo"]) ? $conf["sexo"] : "";

      $sql = "SELECT * ";
      $sql.= "FROM animal ";
      $sql.= "WHERE 1 = 1 ";
      if ($caravanapropia != "") $sql.= "AND caravanapropia LIKE '%$caravanapropia%' ";
      if ($caravanaajena != "") $sql.= "AND caravanaajena = '$caravanaajena' ";
      if ($sexo != "") $sql.= "AND sexo = '$sexo' ";
      
      $stmt = $con->prepare($sql);
      #$stmt->bind_param("sss", $firstname, $lastname, $email);
  
      $stmt->execute();
      $resultado = $stmt->get_result();
  
      return $resultado;
    }



    ?>