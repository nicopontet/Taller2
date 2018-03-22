<?php

session_start();

require_once("includes/libs/Smarty.class.php");
require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");

$idPublicacion=$_GET['id'];

    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    if($conn->conectar()){
        $sql="SELECT p.id,titulo,descripcion,tipo,e.nombre as especie ,r.nombre as raza,b.nombre as barrio"
                . " FROM publicaciones p, especies e, razas r, barrios b"
                . " WHERE p.id=:id and p.especie_id=e.id and p.raza_id=r.id and p.barrio_id=b.id";
        
        $parametros=array();
        $parametros[0]=array("id", $idPublicacion);
        if ($conn->consulta($sql, $parametros)) {
            
                $publicacion = $conn->siguienteRegistro();
                if ($publicacion['tipo']=='E') {
                    $tipo="ENCONTRADO";
                } else {
                    $tipo="PERDIDO";
                }
                $fotos=array();
                $cantFotos=0;
                cargarFotos($idPublicacion, $fotos, $cantFotos);
                cargarPreguntasYRespuestas($idPublicacion,$listadoPreguntas);
                $smarty = new Smarty();

                $smarty->template_dir = "templates";
                $smarty->compile_dir = "templates_c";

                //TODO
                $smarty->assign("usuario",$_SESSION['usuario']);
                $smarty->assign("nombreCompleto",$_SESSION['nombreCompleto']);
                $smarty->assign("ingreso",$_SESSION['ingreso']);
                $smarty->assign("id",$idPublicacion);
                $smarty->assign("titulo",$publicacion['titulo']);
                $smarty->assign("descripcion",$publicacion['descripcion']);
                $smarty->assign("tipo",$tipo);
                $smarty->assign("especie",$publicacion['especie']);
                $smarty->assign("raza",$publicacion['raza']);
                $smarty->assign("barrio",$publicacion['barrio']);
                $smarty->assign("fotos",$fotos);
                $smarty->assign("total",$cantFotos-1);
                $smarty->assign("preguntas",$listadoPreguntas);
                $smarty->display("fichaPublicacion.tpl");
       
        } else {
            echo "Error consulta." . $conn->ultimoError();
        }
        
    }else{
        echo "Error de conexión.".$conn->ultimoError;
    }

function cargarFotos($id,&$fotos,&$cantFotos){
       
       $dir="fotos/". $id;

       if($directorio = opendir($dir)){
            while (false !== ($archivo = readdir($directorio))) {
                if ($archivo != '.' && $archivo != '..') {
                  $fotos[$cantFotos]=$archivo;
                  $cantFotos++;
                }
           }
           closedir($directorio); 
       } 
}
function cargarPreguntasYRespuestas($idPublicacion,&$listadoPreguntas){
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    if($conn->conectar()){
        $sql="SELECT p.id,p.texto,p.respuesta,u.nombre"
             . " FROM preguntas p,usuarios u"
             . " WHERE p.id_publicacion=:id and usuario_id=u.id";
        
        $parametros=array();
        $parametros[0]=array("id", $idPublicacion);
        if ($conn->consulta($sql, $parametros)) {
            $listadoPreguntas=$conn->restantesRegistros();
        } else {
             echo "Error consulta." . $conn->ultimoError();
        }
    }else{
        echo "Error de conexión.".$conn->ultimoError;
    }
}
?>