<?php
session_start();
require_once("../includes/class.Conexion.BD.php");
require_once("../config/configuracion.php");


$conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);

$usuario = $_POST['txtUsuario'];
$clave = $_POST['txtClave'];
if ($conn->conectar()) {
    $sql = "SELECT * FROM Usuarios WHERE usuUsuario = :usu";
    //cargo los parametros para la sql
    $parametros = array();
    $parametros[0] = array("usu",$usuario,"string");
    //ejecuto la consulta
    if($conn->consulta($sql,$parametros)){
        
        $fila=$conn->siguienteRegistro();
        if(md5($clave) == $fila['usuClave']){
        $_SESSION['ingreso'] = true;
        $_SESSION['usuario'] = $usuario;
        setcookie("txtUsu",$usuario,time()+(60*60*24));
        header("Location: ../inicioPrivado.php");
        }
        else{
            $_SESSION['ingreso'] = false; 
            $_SESSION['mensaje'] = "Usuario o clave erronea!";
            header("Location: ../index.php");
        }
    }
    else {
            echo "Error de Consulta " . $conn->ultimoError(); 
    }
} else {
    echo "Error de conexión de Base de datos. " . $conn->ultimoError();;
}



?>
