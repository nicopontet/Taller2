<?php

session_start();

require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");

$filtro = $_POST['filtro'];
$pagina = (int)$_POST['pagina'];

        
if($pagina <= 0 ){
    $pagina = 1;
}

$respuesta = array();

   
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    if($conn->conectar()){
          $parametros = array();

        $sql = "SELECT count(id) Total";
        $sql .= " FROM publicaciones";         
      //  $parametros[0]= array("usu",$_SESSION['usuario_id'],"int",0);
        if($conn->consulta($sql, $parametros)){        
            $fila = $conn->siguienteRegistro();
            
            $cantPags = ceil($fila["Total"] / CANTXPAG);
                    
            $inicio = ($pagina -1) * CANTXPAG;
            $parametros = array();
            $sql="";
            
            armarConsulta($sql,$parametros,$inicio);

            if($conn->consulta($sql, $parametros)){
                $listadoPublicaciones = $conn->restantesRegistros();                        
                CargarFotosIniciales($listadoPublicaciones);
                $respuesta['estado'] = "OK";
                $respuesta['totPaginas'] =  $cantPags;
                $respuesta['data'] = $listadoPublicaciones;

            }
            else{
                $respuesta['estado'] = "ERROR";
                $respuesta['mensaje'] = "Error de consulta 1 " . $conn->ultimoError();
            }
        }
        else{
            $respuesta['estado'] = "ERROR";
            $respuesta['mensaje'] = "Error de consulta 2 " . $conn->ultimoError();
        }       
    }
   /* else{
        $respuesta['estado'] = "ERROR";
        $respuesta['mensaje'] = "Error de Conexión " . $conn->ultimoError();
    }   */   


//para cuando respondo a la APP
echo json_encode($respuesta);


function armarConsulta(&$sql,&$parametros,$inicio) {
     
    $tipo = $_POST['tipo'];
    $palabra = $_POST['palabra'];
    $especie = (int)$_POST['especie'];
    $raza = (int)$_POST['raza'];
    $barrio = (int)$_POST['barrio'];
    $usuario = (int)$_POST['usuario'];
    $misPublicaciones=(bool)$_POST['misPublicaciones'];
    $abierto=(int)$_POST['abierto'];
    
    $sqlSelect = "SELECT p.id, p.titulo, p.descripcion, p.tipo, p.abierto, 'foto' as foto";
    $sqlFrom = " FROM publicaciones p";
    $sqlWhere=" WHERE abierto=:abierto ";
    $parametros[0] = array("abierto",$abierto,"int",0);
    
    if (!$misPublicaciones) {
         $sqlLimit=" LIMIT :ini, :cant";
         $parametros[1] = array("ini",$inicio,"int",0);
         $parametros[2] = array("cant",CANTXPAG,"int",0);
         $contParametros=3;
    }else{
        $contParametros=1;
        $sqlLimit="";
    }
   
    
    if ($especie!=0){
        $sqlWhere .= " AND especie_id= :especie";
        $parametros[$contParametros] = array("especie",$especie,"int",0);
        $contParametros++;   
    }
    if ($raza!=0){
        $sqlWhere .= " AND raza_id= :raza";        
        $parametros[$contParametros] = array("raza",$raza,"int",0);
        $contParametros++;   
    }
    if ($barrio!=0){
        $sqlWhere .= " AND barrio_id= :barrio";        
        $parametros[$contParametros] = array("barrio",$barrio,"int",0);
        $contParametros++;   
    }
    if ($tipo!="T" && $tipo!=null){
        $sqlWhere .= " AND tipo= :tipo";        
        $parametros[$contParametros] = array("tipo",$tipo);
        $contParametros++;   
    }
    if ($palabra!=""){
        $sqlWhere .= " AND (titulo LIKE '%" .$palabra ."%' OR descripcion LIKE '%" .$palabra . "%') ";       
    }
      if ($usuario!=0){
        $sqlWhere .= " AND usuario_id= :usuario";        
        $parametros[$contParametros] = array("usuario",$usuario);
        $contParametros++;   
    }
    $sql= $sqlSelect .$sqlFrom .$sqlWhere .$sqlLimit;
}
function CargarFotosIniciales(&$listadoPublicaciones){
    
    foreach ($listadoPublicaciones as $clave =>$value) {
       $dir="fotos/". $value['id'];
       if($directorio = opendir($dir)){
       
            while (!$encontro && (false !== ($archivo = readdir($directorio)))) {
                if ($archivo != '.' && $archivo != '..') {
                  
                  $value['foto']=$archivo;
                  $listadoPublicaciones[$clave] = $value;
                  $encontro=true;
                }
           }
           $encontro=false;
           closedir($directorio); 
       }
    } 
}
?>
