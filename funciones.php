    <?php

    $con = new mysqli("localhost", "root", "", "ganadero");



    if (isset($_POST["subAgregar"])) {
        global $con;

        $caravanaPropia = $_POST['txtCaravanaPropia'];
        $caravanaAjena = $_POST['txtCaravanaAjena'];
        $raza = $_POST['txtRaza'];
        $nacimiento = $_POST['datNacimiento'];
        $peso = $_POST['numPeso'];
        $fecha = $_POST['datFecha'];
        $color = $_POST['txtColor'];
        $lugar = $_POST['txtLugar'];
        $sexo = $_POST['selSexo'];


        $sql = "INSERT INTO t_animal (caravanaPropia, caravanaAjena, raza, nacimiento, color, sexo) VALUES ('$caravanaPropia', '$caravanaAjena', '$raza', '$nacimiento', '$color','$sexo') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) VALUES ('$caravanaPropia', '$fecha', '$peso') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$caravanaPropia', '$fecha', '$lugar') ";
        $result = mysqli_query($con, $sql);

        // $stmt = $con->prepare($sql);
        // $stmt->execute();


        // if (mysqli_num_rows($result) == 1) {
        //     echo "<h3>Cargado exitoso</h3>";
        //     return 1;
        // } else {
        //     echo "<h3>ERROR</h3>";
        // }
    }

    // if ($funcion == "eliminar") {
    //     $id = isset($_POST['id']) ? $_POST["id"] : "";
    //     $sql = "DELETE FROM animal WHERE caravanapropia = $id";
    //     $stmt = $con->prepare($sql);
    //     $stmt->execute();
    //     $resultado = $stmt->get_result();
    // } else {

    if (isset($_POST["subLogin"])) {
        global $con;
        $usuario = $_POST['txtUsuario'];
        $password = $_POST['pasPassword'];

        $sql = "SELECT * FROM t_login WHERE usuario = '$usuario' and password = '$password'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 1) {
            echo "<h3> login successfully.</h3>";
            return 1;
        } else {
            echo "<h3>ERROR</h3>";
        }
    }


    function cargarTodo($conf = array())
    {
        global $con;

        $caravanaPropia = isset($conf["caravanaPropia"]) ? $conf["caravanaPropia"] : "";
        $caravanaAjena = isset($conf["caravanaAjena"]) ? $conf["caravanaAjena"] : "";
        $sexo = isset($conf["sexo"]) ? $conf["sexo"] : "";
        $color = isset($conf['color']) ? $conf["color"] : "";
        $raza = isset($conf['raza']) ? $conf["raza"] : "";
        $peso = isset($conf['peso']) ? $conf["peso"] : "";
        $nacimiento = isset($conf['nacimiento']) ? $conf["nacimiento"] : "";
        $lugar = isset($conf['lugar']) ? $conf["lugar"] : "";

        $sql = "SELECT * FROM t_animal a ";
        $sql .= "CROSS JOIN t_peso p , t_lugar l ";
        $sql .= "WHERE a.caravanaPropia = p.caravanaPropia AND a.caravanaPropia = l.caravanaPropia ";

        if ($caravanaPropia != "") $sql .= "AND caravanaPropia LIKE '%$caravanaPropia%' ";
        if ($caravanaAjena != "") $sql .= "AND caravanaAjena LIKE '%$caravanaAjena%' ";
        if ($sexo != "") $sql .= "AND sexo LIKE '%$sexo%' ";
        if ($color != "") $sql .= "AND color LIKE '%$color%' ";
        if ($raza != "") $sql .= "AND raza LIKE '%$raza%' ";
        if ($peso != "") $sql .= "AND peso LIKE '%$peso%' ";
        if ($nacimiento != "") $sql .= "AND nacimiento LIKE '%$nacimiento%' ";
        if ($lugar != "") $sql .= "AND lugar LIKE '%$lugar%' ";

        $stmt = $con->prepare($sql);

        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado;
        #$stmt->bind_param("sss", $firstname, $lastname, $email);
        // $resultado = mysqli_query($con, $sql);

        // if (mysqli_num_rows($resultado) == 0) {

        //     echo "No se encontro ningun dato";
        // }
        // mysqli_free_result($resultado);
    }

    function cargarVaca()
    {
        global $con;

        $id = $_GET["id"];

        $sql = "SELECT * ";
        $sql .= "FROM t_animal a ";
        $sql .= "CROSS JOIN t_peso p , t_lugar l ";
        $sql .= "WHERE '$id' = a.caravanaPropia AND '$id' = p.caravanaPropia AND '$id' = l.caravanaPropia ";

        // $resultado = mysqli_query($con, $sql);

        // if (mysqli_num_rows($resultado) == 0) {

        //     echo "No se encontro ningun dato";
        // }else{
        //     echo "hola";
        // }
        $stmt = $con->prepare($sql);


        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado;
    }



    // function modificarVaca()
    // {
    // }



    ?>