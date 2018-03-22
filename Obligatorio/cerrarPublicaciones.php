<?php

session_start();
require_once("clases/Publicacion.class.php");
if (!$_SESSION['ingreso']) {
    $_SESSION['mensaje'] = "Debe registrarse para acceder al área privada";
    header("Location: index.php");
} else {
    //agrego la clase de conexion a la BD
    require_once("includes/libs/Smarty.class.php");
  
    $smarty = new Smarty();

    $smarty->template_dir = "templates";
    $smarty->compile_dir = "templates_c";

    //TODO

    $smarty->assign("usuario", $_SESSION['usuario']);
    $smarty->assign("nombreCompleto", $_SESSION['nombreCompleto']);
    $smarty->assign("ingreso", $_SESSION['ingreso']);

    $smarty->display("cerrarPublicaciones.tpl");
}
?>
