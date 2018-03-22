<?php

session_start();
require_once("clases/Publicacion.class.php");
if (!$_SESSION['ingreso']) {
    $_SESSION['mensaje'] = "Debe registrarse para acceder al área privada";
    header("Location: index.php");
} else {
    //agrego la clase de conexion a la BD
    require_once("includes/class.Conexion.BD.php");
    require_once("config/configuracion.php");


    //creo una instancia de conexion
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    $idPublicacion=$_GET['id'];
    $idPregunta=$_GET['idPregunta'];
    $respuesta=$_POST['txtRespuesta'];


    //veo que puedo conectarme a la BD
    if ($conn->conectar()) {
        //armo la SQL
        $sql = "UPDATE preguntas SET respuesta=:respuesta";
        $sql .= " WHERE id_publicacion=:idPub and id=:idPregunta";

        //cargo los parametros para la sql
        $parametros = array();
        $parametros[0] = array("idPub", $idPublicacion);
        $parametros[1] = array("idPregunta",$idPregunta);
        $parametros[2] = array("respuesta", $respuesta, "string");
        //ejecuto la consulta
        if ($conn->consulta($sql, $parametros)) {
            header("Location: sinResponder.php");
        } else {
            echo "Error de Consulta " . $conn->ultimoError();
        }
    } else {
        echo "Error de Conexión " . $conn->ultimoError();
    }
}

?>
