<?php

if (!isset($_COOKIE["usuarioLogeado"]) || empty($_COOKIE["usuarioLogeado"])) {
	header("Location: ../login.php");
	exit;
}

define("DB_NAME","ganadero");
define("DB_USER","root");
define("DB_PASS","");

class Conexion{
    public $cnx;
    public function conectar(){
        try {
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
            );
            $this->cnx = new PDO(
                "mysql:host=localhost;
                dbname=".DB_NAME,
                DB_USER, 
                DB_PASS,
                $opciones
            );
            return $this->cnx;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function desconectar(){
        $this->cnx = null;
    }
}
class Consulta{

    private $_db;
    private  $listaAnimales;

    public function __construct(){
        $this->_db = new Conexion();
    }

    public function buscar(){
        
        $this->_db->conectar();

        $stmt = $this->_db->cnx->prepare("SELECT * FROM t_animal where eliminada = 0");
        $stmt->execute();
        while ($res = $stmt->fetch(PDO::FETCH_OBJ)) {
    
            $sql = "SELECT * FROM t_peso WHERE caravanaPropia = '$res->caravanaPropia' ORDER BY fecha DESC LIMIT 0,1";
            $stmt = $this->_db->cnx->prepare($sql);
            $stmt->execute();
            // $res_peso = $stmt->get_result();
            $peso = $stmt->fetch(PDO::FETCH_OBJ);
            $res->peso = $peso->peso;
    
            $sql = "SELECT * FROM t_lugar WHERE caravanaPropia = '$res->caravanaPropia' ORDER BY fecha DESC LIMIT 0,1";
            $stmt = $this->_db->cnx->prepare($sql);
            $stmt->execute();
            // $res_lugar = $stmt->get_result();
            $lugar = $stmt->fetch(PDO::FETCH_OBJ);
            $res->lugar = $lugar->lugar;

            $this->listaAnimales[] =$res;
        }
        // $consulta->execute();
        
        // while($row = $res->fetch(PDO::FETCH_OBJ)){
        //     $this->listaAnimales[] =$row;
        // }
        $this->_db->desconectar();
        return $this->listaAnimales;
    }


}

$animales = new Consulta();
$salida = "";
$salida .= "<table>";
$salida .= "<thead> <th>Caravana</th> <th>Caravana Ajena</th><th>Raza</th><th>Peso</th><th>Nacimiento</th><th>Color</th><th>Lugar</th><th>Sexo</th></thead>";
foreach($animales->buscar() as $r){
    $salida .= "<tr> <td>".$r->caravanaPropia."</td> <td>".$r->caravanaAjena."</td><td>".$r->raza."</td><td>".$r->peso."</td><td>".$r->nacimiento."</td><td>".$r->color."</td><td>".$r->lugar."</td><td>".$r->sexo."</td></tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=animales.xls");
header("Pragma: no-cache"); 
header("Expires: 0");
echo $salida;

?>