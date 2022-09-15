    <?php

    $con = new mysqli("localhost", "root", "", "ganadero");

    
    $funcion = isset($_POST['funcion']) ? $_POST["funcion"] : "";
    if ($funcion=="agregar_vaca") {
        $color = isset($_POST['color']) ? $_POST["color"] : "";
        $caravana = isset($_POST['caravana']) ? $_POST["caravana"] : "";
        $raza = isset($_POST['raza']) ? $_POST["raza"] : "";
        $peso = isset($_POST['peso']) ? $_POST["peso"] : "";
        $caravanaajena = isset($_POST['caravanaajena']) ? $_POST["caravanaajena"] : "";
        $nacimiento = isset($_POST['nacimiento']) ? $_POST["nacimiento"] : "";
        $sexo = isset($_POST['sexo']) ? $_POST["sexo"] : "";
        
        $sql = "INSERT INTO animal (caravanapropia, caravanaajena, raza, nacimiento, peso, color, sexo) VALUES ('$caravana', '$caravanaajena', '$raza', '$nacimiento','$peso', '$color','$sexo') ";

        $stmt = $con->prepare($sql);

        $stmt->execute();
        $resultado = $stmt->get_result();
    }

    mysqli_close($con);
    ?>