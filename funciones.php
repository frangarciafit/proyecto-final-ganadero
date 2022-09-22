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
        } else {
            if ($funcion == "login") {

                global $con;
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM login WHERE usuario = '$usuario' and password = '$password'";
                $result = mysqli_query($con, $sql);

                echo $usuario;
                echo $password;

                if (mysqli_num_rows($result) == 1) {
                    echo "Login successful";
                    return 1;
                } else {
                    echo "Login failed. Invalid username or password.";
                }
            }
        }
    }

    function cargartodo($conf = array())
    {
        global $con;

        $caravanapropia = isset($conf["caravanapropia"]) ? $conf["caravanapropia"] : "";
        $caravanaajena = isset($conf["caravanaajena"]) ? $conf["caravanaajena"] : "";
        $sexo = isset($conf["sexo"]) ? $conf["sexo"] : "";
        $color = isset($conf['color']) ? $conf["color"] : "";
        $raza = isset($conf['raza']) ? $conf["raza"] : "";
        $peso = isset($conf['peso']) ? $conf["peso"] : "";
        $nacimiento = isset($conf['nacimiento']) ? $conf["nacimiento"] : "";
        $lugar = isset($conf['lugar']) ? $conf["lugar"] : "";


        $sql = "SELECT * ";
        $sql .= "FROM animal ";
        $sql .= "WHERE 1 = 1 ";

        if ($caravanapropia != "") $sql .= "AND caravanapropia LIKE '%$caravanapropia%' ";
        if ($caravanaajena != "") $sql .= "AND caravanaajena LIKE '%$caravanaajena%' ";
        if ($sexo != "") $sql .= "AND sexo LIKE '%$sexo%' ";
        if ($color != "") $sql .= "AND color LIKE '%$color%' ";
        if ($raza != "") $sql .= "AND raza LIKE '%$raza%' ";
        if ($peso != "") $sql .= "AND peso LIKE '%$peso%' ";
        if ($nacimiento != "") $sql .= "AND nacimiento LIKE '%$nacimiento%' ";
        if ($lugar != "") $sql .= "AND lugar LIKE '%$lugar%' ";


        $stmt = $con->prepare($sql);

        #$stmt->bind_param("sss", $firstname, $lastname, $email);

        $stmt->execute();
        $resultado = $stmt->get_result();

        //$resultado=mysqli_query($con,$sql);

        //if (mysqli_num_rows($resultado)==0){

        //echo "No se encontro ningun dato";
        //   }
        //   mysqli_free_result($resultado);

        return $resultado;
    }

    ?>