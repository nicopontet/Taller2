<?php

session_start();

require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");

    
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    
    $email = $_POST['txtEmail'];
    $clave = $_POST['txtClave'];
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    
    if($conn->conectar()){

        $sql = "SELECT * FROM Usuarios where usuEmail=:email";

        $parametros = array();
        $parametros[0] = array("email",trim($email),"string");
        if($conn->consulta($sql, $parametros)){

            $resultado = $conn->cantidadRegistros();
            if ($resultado==0) {
                $sql = "INSERT INTO Usuarios (usuClave, usuEmail,usuNom,usuApe)";
                $sql .= " VALUES (:cla, :corr, :nombre, :apellido)";

                //cargo los parametros para la sql
                $parametros = array();
                $parametros[0] = array("cla",md5($clave),"string");
                $parametros[1] = array("corr",$email,"string");
                $parametros[2] = array("nombre",$nombre,"string");
                $parametros[3] = array("apellido",$apellido,"string");
                //ejecuto la consulta
                if($conn->consulta($sql,$parametros)){
                    $_SESSION['ingreso'] = true;
                    $_SESSION['usuario'] = $email;
                    $_SESSION['nombreCompleto']=$nombre. " " . $apellido;
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