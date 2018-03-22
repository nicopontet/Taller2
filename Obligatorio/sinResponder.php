<?php

session_start();
require_once("clases/Publicacion.class.php");
if (!$_SESSION['ingreso']) {
    $_SESSION['mensaje'] = "Debe registrarse para acceder al área privada";
    header("Location: index.php");
} else {
    //agrego la clase de conexion a la BD
    require_once("includes/libs/Smarty.class.php");
    require_once("includes/class.Conexion.BD.php");
    require_once("config/configuracion.php");
    
    $tipo=$_POST['tipo'];

    //creo una instancia de conexion
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);

    //veo que puedo conectarme a la BD
    if ($conn->conectar()) {
        //armo la SQL
        $sql = "SELECT p.id as id_pregunta, p.texto, pub.id as id_publicacion,pub.titulo,pub.descripcion,u.nombre  FROM preguntas p, publicaciones pub, usuarios u";
        $sql .= " WHERE pub.usuario_id=:idUsuario and pub.id=p.id_publicacion and p.respuesta is NULL and u.id=p.usuario_id";
        
        //cargo los parametros para la sql
        $parametros = array();
        $parametros[0] = array("idUsuario", $_SESSION['usuario_id'], "int");
        //ejecuto la consulta
        if ($conn->consulta($sql, $parametros)) {
             $listadoPublicacionConPreguntasSinResponder = $conn->restantesRegistros();
              $smarty = new Smarty();

                $smarty->template_dir = "templates";
                $smarty->compile_dir = "templates_c";

                //TODO
                $smarty->assign("usuario",$_SESSION['usuario']);
                $smarty->assign("nombreCompleto",$_SESSION['nombreCompleto']);
                $smarty->assign("ingreso",$_SESSION['ingreso']);
                $smarty->assign("publicacionesSinResponder",$listadoPublicacionConPreguntasSinResponder);
                $smarty->display("sinResponder.tpl");
        } else {
            echo "Error de Consulta " . $conn->ultimoError();
        }
    } else {
        echo "Error de Conexión " . $conn->ultimoError();
    }
}

?>
