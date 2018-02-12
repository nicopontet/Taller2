<?php

session_start();

require_once("includes/libs/Smarty.class.php");

if(!$_SESSION['ingreso']){
    $_SESSION['mensaje'] = "Debe registrarse para acceder al área privada";
    header("Location: index.php");
}
else{
    $smarty = new Smarty();
    
    $smarty->template_dir = "templates";
    $smarty->compile_dir = "templates_c";
    
    //TODO
    $smarty->assign("usuario",$_SESSION['usuario']);
    
    $smarty->display("inicioPrivado.tpl");
            
}

?>