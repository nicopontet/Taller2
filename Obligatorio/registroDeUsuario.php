<?php

session_start();

require_once("includes/libs/Smarty.class.php");


    $smarty = new Smarty();
    
    $smarty->template_dir = "templates";
    $smarty->compile_dir = "templates_c";
    
    //TODO
    $smarty->assign("usuario",$_SESSION['usuario']);
    
    $smarty->display("registroDeUsuario.tpl");


?>