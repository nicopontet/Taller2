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
    $pregunta = $_POST['txtPregunta'];
    $idPublicacion=$_GET['id'];


    //veo que puedo conectarme a la BD
    if ($conn->conectar()) {
        //armo la SQL
        $sql = "INSERT INTO preguntas (id_publicacion, texto, usuario_id)";
        $sql .= " VALUES (:idPub, :text, :idUsuario)";

        //cargo los parametros para la sql
        $parametros = array();
        $parametros[0] = array("idPub", $idPublicacion);
        $parametros[1] = array("text",$pregunta, "string");
        $parametros[2] = array("idUsuario", $_SESSION['usuario_id'], "int");
        //ejecuto la consulta
        if ($conn->consulta($sql, $parametros)) {
            header("Location: fichaPublicacion.php?id=".$idPublicacion);
        } else {
            echo "Error de Consulta " . $conn->ultimoError();
        }
    } else {
        echo "Error de Conexión " . $conn->ultimoError();
    }
}

?>
