<?php
session_start();
require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");


$conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);

$usuario = $_POST['txtEmail'];
$clave = $_POST['txtClave'];
if ($conn->conectar()) {
    $sql = "SELECT * FROM usuarios WHERE email = :usu";
    //cargo los parametros para la sql
    $parametros = array();
    $parametros[0] = array("usu",$usuario,"string");
    //ejecuto la consulta
    if($conn->consulta($sql,$parametros)){
        
        $fila=$conn->siguienteRegistro();
        if(md5($clave) == $fila['password']){
        $_SESSION['ingreso'] = true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nombreCompleto']=$fila['nombre'];
        setcookie("txtUsu",$usuario,time()+(60*60*24));
        header("Location: publicaciones.php");
        }
        else{
            //TODO
            $_SESSION['ingreso'] = false; 
            $_SESSION['mensaje'] = "Usuario o clave erronea!";
            header("Location: iniciarSesion.php");
        }
    }
    else {
            echo "Error de Consulta " . $conn->ultimoError(); 
    }
} else {
    echo "Error de conexión de Base de datos. " . $conn->ultimoError();;
}



?>
