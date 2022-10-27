<?php

$con = new mysqli("localhost", "root", "", "ganadero");


$funcion = isset($_POST['funcion']) ? $_POST["funcion"] : "";
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

    $sql = "INSERT INTO t_animal (caravanaPropia, caravanaAjena, raza, nacimiento, color, sexo, eliminada) VALUES ('$caravanaPropia', '$caravanaAjena', '$raza', '$nacimiento', '$color','$sexo', 'FALSE') ";
    $result = mysqli_query($con, $sql);
    $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) VALUES ('$caravanaPropia', '$fecha', '$peso') ";
    $result = mysqli_query($con, $sql);
    $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$caravanaPropia', '$fecha', '$lugar') ";
    $result = mysqli_query($con, $sql);

    // echo'<script type="text/javascript">
    // alert("Animal agregado");
    // </script>';

    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    if (mysqli_affected_rows($con) == 1) {
        echo '<script type="text/javascript">
        alert("ANIMAL AGREGADO");
        </script>';
        return 1;
    } else {
        echo '<script type="text/javascript">
        alert("Error");
        </script>';
    }
}
if (isset($_POST["subAgregarTernero"])) {
    global $con;

    $caravanaPropia = $_POST['txtCaravanaPropia'];
    $caravanaMadre = $_POST['txtCaravanaMadre'];
    $raza = $_POST['txtRaza'];
    $nacimiento = $_POST['datNacimiento'];
    $peso = $_POST['numPeso'];
    $color = $_POST['txtColor'];
    $lugar = $_POST['txtLugar'];
    $sexo = $_POST['selSexo'];

    $sql = "SELECT * FROM t_animal WHERE caravanaPropia = '$caravanaMadre'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1 && $caravanaMadre != $caravanaPropia) {
        $sql = "INSERT INTO t_animal (caravanaPropia, caravanaAjena, raza, nacimiento, color, sexo, eliminada) VALUES ('$caravanaPropia', '', '$raza', '$nacimiento', '$color','$sexo', 'FALSE') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) VALUES ('$caravanaPropia', '$nacimiento', '$peso') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$caravanaPropia', '$nacimiento', '$lugar') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_ternero (caravanaMadre, caravanaTernero) VALUES ('$caravanaMadre','$caravanaPropia') ";
        $result = mysqli_query($con, $sql);

        echo '<script type="text/javascript">
        alert("ANIMAL AGREGADO");
        </script>';
        // $stmt = $con->prepare($sql);
        // $stmt->execute();
        // if (mysqli_num_rows($result) == 1) {
        //     echo "<h3>Cargado exitoso</h3>";
        //     return 1;
        // } else {
        //     echo "<h3>ERROR</h3>";
        // }
    } else {
        echo '<script type="text/javascript">
        alert("Error");
        </script>';
    }
}

if ($funcion == "eliminar") {
    $id = isset($_POST['id']) ? $_POST["id"] : "";
    echo "<h3> id $id </h3>";
    $sql = "UPDATE t_animal SET eliminada = 1 WHERE caravanaPropia = $id";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    if ($funcion == "modificar") {
        global $con;
        $id = isset($_POST['id']) ? $_POST["id"] : "";
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
}

if ($funcion == "login") {
    global $con;
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM t_login WHERE usuario = '$usuario' and password = '$password' LIMIT 0,1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        /*
        session_start();
        $_SESSION["nombre_usuario"] = $usuario;
        print_r($_SESSION);*/
        setcookie("usuarioLogeado", $usuario, time() + (86400 * 30), "/");
        //Se logeo exitosamente
        echo json_encode(array(
            "error" => 0,
        ));
    } else {
        echo json_encode(array(
            "error" => 1,
        ));
    }
}

if ($funcion == "modificarLugar") {
    global $con;
    //Obtenemos los pesos
    $lugares = $_POST['lugares'];
    $id = $_POST['id'];

    //Lo primero que hacemos es eliminar todos los pesos de la base de datos
    //Ya que tenemos guardados todos dentro de un array
    //Entonces si no los borramos, los duplicariamos
    $sql = "DELETE FROM t_lugar WHERE caravanaPropia = '$id' ";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    //Una vez borrados, recorremos los pesos guardados en el array y los insertamos
    foreach ($lugares as $lugar) {
        $valorLugar = $lugar["lugar"];
        $valorFecha = $lugar["fecha"];
        $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$id', '$valorFecha', '$valorLugar') ";
        mysqli_query($con, $sql);
    }

    //Como estamos trabajando con json, debemos retonar json!
    echo json_encode(array(
        "error" => 0,
    ));
}

if ($funcion == "modificarCampo") {
    global $con;
    $id = $_POST["id"];
    $raza = $_POST["raza"];
    $caravanaPropia = $_POST["caravanaPropia"];
    $caravanaAjena = $_POST["caravanaAjena"];
    $nacimiento = $_POST["nacimiento"];
    $color = $_POST["color"];
    $sexo = $_POST["sexo"];

    $sql = "UPDATE t_animal SET raza = '$raza', color = '$color', sexo = '$sexo', nacimiento = '$nacimiento', caravanaAjena = '$caravanaAjena' WHERE caravanaPropia = '$id' ";

    $stmt = $con->prepare($sql);
    $stmt->execute();

    echo json_encode(array(
        "error" => 0,
    ));
}

if ($funcion == "cambioPesos") {
    global $con;
    //Obtenemos los pesos
    $pesos = $_POST['pesos'];
    $id = $_POST['id'];
    
    //Lo primero que hacemos es eliminar todos los pesos de la base de datos
    //Ya que tenemos guardados todos dentro de un array
    //Entonces si no los borramos, los duplicariamos
    $sql = "DELETE FROM t_peso WHERE caravanaPropia = '$id' ";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    //Una vez borrados, recorremos los pesos guardados en el array y los insertamos
    foreach ($pesos as $peso) {
        $valorPeso = $peso["peso"];
        $valorFecha = $peso["fecha"];
        $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) VALUES ('$id', '$valorFecha', '$valorPeso') ";
        mysqli_query($con, $sql);
    }

    //Como estamos trabajando con json, debemos retonar json!
    echo json_encode(array(
        "error" => 0,
    ));
}

if ($funcion == "cambioVacunas") {
    global $con;
    $vacunas = $_POST["vacunas"];
    $id = $_POST["id"];

    // $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$id', '$nuevaFecha', '$nuevoLugar')";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    // print_r($sql);

    $sql = "DELETE FROM t_vacuna WHERE caravanaPropia = '$id' ";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    foreach ($vacunas as $vacuna) {
        $nuevaVacuna = $vacuna["vacuna"];
        $nuevaFecha = $vacuna["fecha"];
        $nuevaDroga = $vacuna["droga"];
        $nuevoObligatoria = $vacuna["obligatoria"];
        $nuevoVeterinario = $vacuna["veterinario"];
        $nuevaDescripcion = $vacuna["descripcion"];

        $sql = "INSERT INTO t_vacuna (caravanaPropia, vacuna , fecha, droga, obligatoria, veterinario, descripcion) VALUES ('$id', '$nuevaVacuna', '$nuevaFecha', '$nuevaDroga', '$nuevoObligatoria', '$nuevoVeterinario', '$nuevaDescripcion') ";
        mysqli_query($con, $sql);
    }

    echo json_encode(array(
        "error" => 0,
    ));
}

if ($funcion == "registroEnfermedades") {
    global $con;

    $descripciones = $_POST['descripciones'];
    $id = $_POST['id'];

    $sql = "DELETE FROM t_enfermedades WHERE caravanaPropia = '$id' ";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    foreach ($descripciones as $descripcion) {
        $valorDescripcion = $descripcion["descripcion"];
        $valorFecha = $descripcion["fecha"];
        $sql = "INSERT INTO t_enfermedades (caravanaPropia, fecha, descripcion) VALUES ('$id', '$valorFecha', '$valorDescripcion') ";
        mysqli_query($con, $sql);
    }

    echo json_encode(array(
        "error" => 0,
    ));
}
if($funcion == "newContraseña"){

    global $con;
    $newContraseña = $_POST['newContraseña'];
    $oldContraseña = $_POST['oldContraseña'];

    $sql = "SELECT * FROM t_login WHERE password = '$oldContraseña'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $sql = "UPDATE t_login SET password = '$newContraseña'";

        $stmt = $con->prepare($sql);
        $stmt->execute();

        echo json_encode(array(
            "error" => 0,
        ));
    } else {
        echo json_encode(array(
            "error" => 1,
        ));
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
    $filtro_peso = isset($conf['peso']) ? $conf["peso"] : "";
    $nacimiento = isset($conf['nacimiento']) ? $conf["nacimiento"] : "";
    $filtro_lugar = isset($conf['lugar']) ? $conf["lugar"] : "";

    $sql = " SELECT * FROM t_animal a "; //CROSS JOIN t_peso p , t_lugar l WHERE a.caravanaPropia = p.caravanaPropia AND a.caravanaPropia = l.caravanaPropia ";
    /*ORDER BY p.id DESC LIMIT 1 */
    if ($caravanaPropia != "") $sql .= "AND a.caravanaPropia LIKE '%$caravanaPropia%' ";
    if ($caravanaAjena != "") $sql .= "AND caravanaAjena LIKE '%$caravanaAjena%' ";
    if ($sexo != "") $sql .= "AND sexo LIKE '%$sexo%' ";
    if ($color != "") $sql .= "AND color LIKE '%$color%' ";
    if ($raza != "") $sql .= "AND raza LIKE '%$raza%' ";
    //if ($peso != "") $sql .= "AND peso LIKE '%$peso%' ";
    if ($nacimiento != "") $sql .= "AND nacimiento LIKE '%$nacimiento%' ";
    //if ($lugar != "") $sql .= "AND lugar LIKE '%$lugar%' ";

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();


    $salida = array();
    while ($res = $resultado->fetch_object()) {

        $se_agrega = 1;

        $sql = "SELECT * FROM t_peso WHERE caravanaPropia = '$res->caravanaPropia' ORDER BY fecha DESC LIMIT 0,1";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $res_peso = $stmt->get_result();
        $peso = $res_peso->fetch_object();
        $res->peso = $peso->peso;

        $sql = "SELECT * FROM t_lugar WHERE caravanaPropia = '$res->caravanaPropia' ORDER BY fecha DESC LIMIT 0,1";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $res_lugar = $stmt->get_result();
        $lugar = $res_lugar->fetch_object();
        $res->lugar = $lugar->lugar;

        if ($filtro_peso != "" && $peso->peso != $filtro_peso) {
            $se_agrega = 0;
        }

        if ($filtro_lugar != "" && $lugar->lugar != $filtro_lugar) {
            $se_agrega = 0;
        }

        if ($se_agrega == 1) $salida[] = $res;
    }

    return $salida;

    #$stmt->bind_param("sss", $firstname, $lastname, $email);
    // $resultado = mysqli_query($con, $sql);
    // if (mysqli_num_rows($resultado) == 0) {
    //     echo "No se encontro ningun dato";
    // }
    // mysqli_free_result($resultado);
}

function obtenerAnimal($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();

    return $row;
    // $row->pesos = array();
    // $sql = "SELECT TP.* FROM t_peso TP WHERE TP.caravanaPropia = ? ";
    // $stmt = $con->prepare($sql);
    // $stmt->bind_param("i", $id);
    // $stmt->execute();
    // $resultado = $stmt->get_result();
    // while ($data = $resultado->fetch_object()) {
    //     $row->pesos[] = $data;
    // }

    // $row->lugares = array();
    // $sql = "SELECT TL.* FROM t_lugar TL WHERE TL.caravanaPropia = ? ";
    // $stmt = $con->prepare($sql);
    // $stmt->bind_param("i", $id);
    // $stmt->execute();
    // $resultado = $stmt->get_result();
    // while ($data = $resultado->fetch_object()) {
    //     $row->lugares[] = $data;
    // }

}

function obtenerLugar($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();


    $row->lugares = array();
    $row->fechas = array();
    $sql = "SELECT TL.* FROM t_lugar TL WHERE TL.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->lugares[] = $data;
        $row->fechas[] = $data;
    }

    return $row;
}

function cambioPeso($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();

    $row->pesos = array();
    $row->fechas = array();
    $sql = "SELECT TP.* FROM t_peso TP WHERE TP.caravanaPropia = ? ORDER BY fecha ASC ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->pesos[] = $data;
        $row->fechas[] = $data;
    }

    return $row;
}

function cambioVacunas2($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();

    $row->vacunas = array();
    $row->fechas = array();
    $row->drogas = array();
    $row->obligatorias = array();
    $row->veterinarios = array();
    $row->descripciones = array();
    $sql = "SELECT TV.* FROM t_vacuna TV WHERE TV.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if(mysqli_num_rows($resultado) > 0){
    while ($data = $resultado->fetch_object()) {
        $row->vacunas[] = $data;
        $row->fechas[] = $data;
        $row->drogas[] = $data;
        $row->obligatorias[] = $data;
        $row->veterinarios[] = $data;
        $row->descripciones[] = $data; 
    }
    $row->opcion[] = 1;
    }else{
        $row->opcion[] = 0;
    }
    return $row;
}

function registroEnfermedad($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();


    $row->descripciones = array();
    $row->fechas = array();
    $sql = "SELECT TE.* FROM t_enfermedades TE WHERE TE.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if(mysqli_num_rows($resultado) > 0){
    while ($data = $resultado->fetch_object()) {
        $row->descripciones[] = $data;
        $row->fechas[] = $data;
    }   
    $row->opcion[] = 1;
    }else{
        $row->opcion[] = 0;
    }
    return $row;
}

function cantidadAnimales()
{
    global $con;

    $sql = "SELECT * FROM t_animal where eliminada = 0";
    if ($stmt = $con->prepare($sql)) {
        $stmt->execute();
        $stmt->store_result();
        // printf("Number of rows: %d.\n", $stmt->num_rows);
    }
    return $stmt;

    //     $row = mysql_fetch_assoc($result);
    //     $count = $row['count'];
    //     $result = mysql_query("SELECT COUNT(*) AS `count` FROM `Students`");
    //     $row = mysql_fetch_assoc($result);
    //     $count = $row['count'];

    //     print_r($row[0]);
    //     return $row;
}

function mostrarTernero($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();


    $row->lugares = array();
    $row->fechas = array();
    $sql = "SELECT TL.* FROM t_lugar TL WHERE TL.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->lugares[] = $data;
        $row->fechas[] = $data;
    }

    return $row;
}

function esHija($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT * FROM t_ternero WHERE caravanaTernero = ? ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    return $resultado;
}


function esMadre($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT * FROM t_ternero WHERE caravanaMadre = ? ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    return $resultado;
}

function sexo($id){
    global $con;
    $id = intval($id);

    $sql = "SELECT * FROM t_animal WHERE caravanaPropia = ? ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    return $resultado;

}
