<?php
session_start();

$usuario = $_POST['txtUsuario'];
$clave = $_POST['txtClave'];

if($usuario == "admin" && $clave == "1234"){
    $_SESSION['ingreso'] = true;
    $_SESSION['usuario'] = $usuario;
    setcookie("txtUsu",$usuario,time()+(60*60*24));
    header("Location: ../inicioPrivado.php");
}
else{
    $_SESSION['ingreso'] = false; 
    $_SESSION['mensaje'] = "Usuario o clave erronea!";
    header("Location: index.php");
}


?>
