<?php
session_start();

require_once("includes/libs/Smarty.class.php");

$_SESSION['mensaje']="";
$mensaje = $_SESSION['mensaje'];

$smarty = new Smarty();

$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";

//TODO

$smarty->assign("ingreso",false);

$smarty->display("publicaciones.tpl");

?>