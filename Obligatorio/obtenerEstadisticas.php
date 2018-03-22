<?php

session_start();

require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");

$tipo = $_POST['tipo'];
$abierto =(int) $_POST['abierto'];

$respuesta = array();


$conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
if ($conn->conectar()) {
   

    $sqlAbierto = "(SELECT count(*) as abiertos";
    $sqlAbierto .= " FROM publicaciones p";
    $sqlAbierto .= " WHERE tipo=:tipo and abierto=:abierto and e.id=p.especie_id) as abiertos";
    
    $sqlAbiertoPos = "(SELECT count(*) as cerrados";
    $sqlAbiertoPos .= " FROM publicaciones p";
    $sqlAbiertoPos .= " WHERE tipo=:tipo and abierto=:abierto and exitoso=1 and e.id=p.especie_id) as abiertosPos";
    
    $sqlAbiertoNeg = "(SELECT count(*) as cerrados";
    $sqlAbiertoNeg .= " FROM publicaciones p";
    $sqlAbiertoNeg .= " WHERE tipo=:tipo and abierto=:abierto and exitoso=0 and e.id=p.especie_id) as abiertosNeg";

    
    $sqlGeneral = "SELECT e.nombre as especie, ".$sqlAbierto. ", ".$sqlAbiertoPos.", ".$sqlAbiertoNeg;
    $sqlGeneral .= " FROM especies e";

   
   
    $parametros = array();
    $parametros[0]= array("tipo",$tipo,"string");
    $parametros[1]= array("abierto",$abierto);
    if ($conn->consulta($sqlGeneral, $parametros)) {
        $listadoEspecies = $conn->restantesRegistros();
      
        $respuesta['estado'] = "OK";
        $respuesta['data'] = $listadoEspecies;
    } else {
        $respuesta['estado'] = "ERROR";
        $respuesta['mensaje'] = "Error de consulta 2 " . $conn->ultimoError();
    }
}
/* else{
  $respuesta['estado'] = "ERROR";
  $respuesta['mensaje'] = "Error de Conexión " . $conn->ultimoError();
  } */


//para cuando respondo a la APP
echo json_encode($respuesta);
?>