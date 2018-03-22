<?php
session_start();

require_once("includes/libs/Smarty.class.php");

$idPublicacion=$_GET['id'];
$mensaje = $_SESSION['mensaje'];
$smarty = new Smarty();

$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";
$_SESSION['redirigirAFicha']=-1;
if ($idPublicacion!=0) {
    $_SESSION['redirigirAFicha']=$idPublicacion;
}
//TODO
$smarty->assign("usuario",$_COOKIE['txtUsu']);
$smarty->assign("mensaje",$mensaje);


$smarty->display("login.tpl");


?>