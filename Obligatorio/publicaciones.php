<?php

session_start();

require_once("includes/libs/Smarty.class.php");
require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");


    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    if($conn->conectar()){
        $sql="SELECT * FROM especies ORDER BY nombre";
        $parametros=array();
        if ($conn->consulta($sql, $parametros)) {
            
            $listadoEspecies = $conn->restantesRegistros();
            $sql="SELECT * FROM barrios ORDER BY nombre";
            $parametros=array();
            if ($conn->consulta($sql, $parametros)) {
                $listadoBarrios = $conn->restantesRegistros();
                $smarty = new Smarty();

                $smarty->template_dir = "templates";
                $smarty->compile_dir = "templates_c";

                //TODO
                $smarty->assign("usuario",$_SESSION['usuario']);
                $smarty->assign("nombreCompleto",$_SESSION['nombreCompleto']);
                $smarty->assign("ingreso",$_SESSION['ingreso']);
                $smarty->assign("especies",$listadoEspecies);
                $smarty->assign("barrios",$listadoBarrios);
                $smarty->assign("publicaciones",$listadoPublicaciones);
                $smarty->display("publicaciones.tpl");
            }else{
                echo "Error consulta.";
            }
        } else {
            echo "Error consulta.";
        }
        
    }else{
        echo "Error de conexión.";
    }


?>