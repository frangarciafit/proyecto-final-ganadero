    <?php

    $con = new mysqli("localhost", "root", "", "ganadero");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
   
     echo "Connected successfully";

    $funcion = isset($_POST['funcion']) ? $_POST["funcion"] : "";
    if ($funcion=="agregar_vaca") {
        $color = isset($_POST['color']) ? $_POST["color"] : "";
        $caravana = isset($_POST['caravana']) ? $_POST["caravana"] : "";
        $raza = isset($_POST['raza']) ? $_POST["raza"] : "";
        $peso = isset($_POST['peso']) ? $_POST["peso"] : "";
        
        $sql = "INSERT INTO animal (caravanapropia, raza, peso, color) VALUES ('$caravana', '$raza', '$peso', '$color') ";

        $stmt = $con->prepare($sql);

        $stmt->execute();
        $resultado = $stmt->get_result();
    }

    mysqli_close($con);
    ?>