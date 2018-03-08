<?php

session_start();

require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");

    
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    
    $email = $_POST['txtEmail'];
    $clave = $_POST['txtClave'];
    $nombre = $_POST['txtNombre'];
    
    if($conn->conectar()){

        $sql = "SELECT * FROM usuarios where email=:email";

        $parametros = array();
        $parametros[0] = array("email",trim($email),"string");
        if($conn->consulta($sql, $parametros)){

            $resultado = $conn->cantidadRegistros();
            if ($resultado==0) {
                $sql = "INSERT INTO usuarios (email,nombre,password)";
                $sql .= " VALUES (:email, :nombre,:pass)";

                //cargo los parametros para la sql
                $parametros = array();
                $parametros[0] = array("pass",md5($clave),"string");
                $parametros[1] = array("email",$email,"string");
                $parametros[2] = array("nombre",$nombre,"string");
                //ejecuto la consulta
                if($conn->consulta($sql,$parametros)){
                    $_SESSION['ingreso'] = true;
                    $_SESSION['usuario'] = $email;
                    $_SESSION['nombreCompleto']=$nombre;
                    setcookie("txtUsu",$email,time()+(60*60*24));
                    header("Location: publicaciones.php");
                }
                else{
                    echo "Error de Consulta " . $conn->ultimoError() . $nombre;
                }
            } 
            else {
               echo "Usuario existente"; 
               
            }

        }
        else{
            echo "Error de consulta " . $conn->ultimoError() . $nombre;
        }               
    }

?>