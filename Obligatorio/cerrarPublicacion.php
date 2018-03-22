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

    $idPublicacion=(int)$_POST['id'];
    $exito1=(int)$_POST['exitoso'];
    
    //creo una instancia de conexion
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);


    //veo que puedo conectarme a la BD
    if ($conn->conectar()) {
        //armo la SQL
        $sql = "UPDATE publicaciones SET exitoso=:exito, abierto=0";
        $sql .= " WHERE id=:idPublicacion";
        //cargo los parametros para la sql
        $parametros = array();
        $parametros[0] = array("idPublicacion", $idPublicacion);
        $parametros[1] = array("exito", $exito1);
        //ejecuto la consulta
        if ($conn->consulta($sql, $parametros)) {
             
              $smarty = new Smarty();

                $smarty->template_dir = "templates";
                $smarty->compile_dir = "templates_c";

                //TODO
                $smarty->assign("usuario",$_SESSION['usuario']);
                $smarty->assign("nombreCompleto",$_SESSION['nombreCompleto']);
                $smarty->assign("ingreso",$_SESSION['ingreso']);

                $smarty->display("cerrarPublicaciones.tpl");
        } else {
            echo "Error de Consulta " . $conn->ultimoError();
        }
    } else {
        echo "Error de Conexión " . $conn->ultimoError();
    }

}

?>
