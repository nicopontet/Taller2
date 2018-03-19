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

//para testing
//echo "<pre>";
//print_r($respuesta);
//echo "</pre>";
function armarConsulta(&$sql,&$parametros,$inicio) {
     
    $tipo = $_POST['tipo'];
    $palabra = $_POST['palabra'];
    $especie = (int)$_POST['especie'];
    $raza = (int)$_POST['raza'];
    $barrio = (int)$_POST['barrio'];
    
    $sqlSelect = "SELECT id,foto, titulo, descripcion, tipo";
    $sqlFrom = " FROM publicaciones";
    $sqlWhere="";
    $sqlLimit=" LIMIT :ini, :cant";
    
    $parametros[0] = array("ini",$inicio,"int",0);
    $parametros[1] = array("cant",CANTXPAG,"int",0);
    $contParametros=2;
    
    if ($especie!=0){
        if ($sqlWhere == "" ) {
             $sqlWhere .= " WHERE especie_id= :especie";
        }
        $parametros[$contParametros] = array("especie",$especie,"int",0);
        $contParametros++;   
    }
    if ($raza!=0){
        if ($sqlWhere == "" ) {
             $sqlWhere .= " WHERE raza_id= :raza";
        }else{ 
            $sqlWhere .= " AND raza_id= :raza";        
        }
        $parametros[$contParametros] = array("raza",$raza,"int",0);
        $contParametros++;   
    }
    if ($barrio!=0){
        if ($sqlWhere == "" ) {
             $sqlWhere .= " WHERE barrio_id= :barrio";
        }else{ 
            $sqlWhere .= " AND barrio_id= :barrio";        
        }
        $parametros[$contParametros] = array("barrio",$barrio,"int",0);
        $contParametros++;   
    }
    if ($tipo!="T"){
        if ($sqlWhere == "" ) {
             $sqlWhere .= " WHERE tipo= :tipo";
        }else{ 
            $sqlWhere .= " AND tipo= :tipo";        
        }
        $parametros[$contParametros] = array("tipo",$tipo);
        $contParametros++;   
    }
    if ($palabra!=""){
        if ($sqlWhere == "" ) {
             $sqlWhere .= " WHERE (titulo LIKE '%" .$palabra ."%' OR descripcion LIKE '%" .$palabra . "%') ";
        }else{ 
            $sqlWhere .= " AND (titulo LIKE '%" .$palabra ."%' OR descripcion LIKE '%" .$palabra . "%') ";      
        }  
    }
    $sql= $sqlSelect .$sqlFrom .$sqlWhere .$sqlLimit;
}
?>
