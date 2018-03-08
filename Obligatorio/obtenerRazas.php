<?php
session_start();

//agrego la clase de conexion a la BD
require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");

//creo una instancia de conexion
$conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);

$especieId = (int)$_POST['especieId'];

$respuesta = array();

//veo que puedo conectarme a la BD
if($conn->conectar()){
    //armo la SQL
    $sql = "SELECT * FROM razas WHERE especie_id = :id";
    
    //cargo los parametros para la sql
    $parametros = array();
    $parametros[0] = array("id",$especieId,"int");
    //ejecuto la consulta
    if($conn->consulta($sql,$parametros)){
        $respuesta['estado'] = "OK";
        $respuesta['data'] = $conn->restantesRegistros();
    }
    else{
        $respuesta['estado'] = "ERROR";
        $respuesta['mensaje'] = "Error de Consulta";
    }
}
else{
    $respuesta['estado'] = "ERROR";
    $respuesta['mensaje'] = "Error de Conexión";
}

echo json_encode($respuesta);

?>
