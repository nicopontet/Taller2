<?php

session_start();
require_once("clases/Publicacion.class.php");
if(!$_SESSION['ingreso']){
    $_SESSION['mensaje'] = "Debe registrarse para acceder al área privada";
    header("Location: index.php");
}
else{
    //agrego la clase de conexion a la BD
    require_once("includes/class.Conexion.BD.php");
    require_once("config/configuracion.php");

    if(is_uploaded_file($_FILES['archivoPublicacion']['tmp_name'])){
        $nuevoNombre = "fotos/" . date("YmdHis") . "_" . $_FILES['archivoPublicacion']['name']; 
        if(move_uploaded_file($_FILES['archivoPublicacion']['tmp_name'], $nuevoNombre)){
            $archivoPublicacion = $nuevoNombre;
        }
        else{
            die("Error al procesar archivo");
        }
    }
    else{
        die("Error al subir archivo");
    }
    
    
    //creo una instancia de conexion
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    $publicacion = new Publicacion();
    $publicacion ->Titulo = $_POST['txtTitulo'];
    $publicacion ->Descripcion = $_POST['txtDescripcion'];
    $publicacion ->Tipo = $_POST['tipoId'];
    $publicacion ->Especie  = (int)$_POST['especieId'];
    $publicacion ->Raza  = (int)$_POST['razaId'];
    $publicacion ->Barrio =(int)$_POST['barrioId'];
    $publicacion ->Abierto =True;
    $publicacion ->Usuario =(int)$_SESSION['usuario_id'];
    $publicacion ->Foto=$archivoPublicacion;

    //veo que puedo conectarme a la BD
    if($conn->conectar()){
        //armo la SQL
        $sql = "INSERT INTO publicaciones (titulo, descripcion, tipo, especie_id, raza_id, barrio_id, abierto,usuario_id,foto)";
        $sql .= " VALUES (:titulo, :descripcion, :tipo, :especie_id, :raza_id, :barrio_id, :abierto,:usuario_id,:foto)";

        //cargo los parametros para la sql
        $parametros = array();
        $parametros[0] = array("titulo",$publicacion ->Titulo,"string");
        $parametros[1] = array("descripcion",$publicacion ->Descripcion,"string");
        $parametros[2] = array("tipo",$publicacion ->Tipo,"string");
        $parametros[3] = array("especie_id", $publicacion ->Especie,"int");
        $parametros[4] = array("raza_id",$publicacion ->Raza,"int");
        $parametros[5] = array("barrio_id",$publicacion ->Barrio ,"int");
        $parametros[6] = array("abierto",$publicacion ->Abierto,"bool");
        $parametros[7] = array("usuario_id",$publicacion ->Usuario,"int");
        $parametros[8] = array("foto",$publicacion ->Foto,"string");
        //ejecuto la consulta
        if($conn->consulta($sql,$parametros)){
            header("Location: publicaciones.php");
        }
        else{
            echo "Error de Consulta " . $conn->ultimoError();
        }
    }
    else{
        echo "Error de Conexión " . $conn->ultimoError();
    }
}
?>
