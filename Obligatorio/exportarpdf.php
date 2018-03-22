<?php
require_once("includes/class.Conexion.BD.php");
require_once("config/configuracion.php");
require_once("includes/fpdf/fpdf.php");

$idPublicacion = (int)$_GET['id'];

$pdf=new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,20,utf8_decode("FICHA DE PUBLICACIÓN"),0,1,'C');


$publicacion=array();
cargarDatos($idPublicacion,$publicacion);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,"Nro. publicacion: ".$idPublicacion,0,0);
$pdf->Cell(0,8,"Tipo: ".$publicacion['tipo'],0,1,'R');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,utf8_decode("Título"),0,1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,8,utf8_decode($publicacion['titulo']),0,1);

$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,8,utf8_decode("Descripción"),0,1);
$pdf->SetFont('Arial','',11);
if ($publicacion['descripcion']=="") {
    $pdf->MultiCell(0,8,utf8_decode("Sin descripción"),0,1);
}else{
    $pdf->MultiCell(0,8,utf8_decode($publicacion['descripcion']),0,1);
}
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,"Especie",0,1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,8,utf8_decode($publicacion['especie']),0,1);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,"Raza",0,1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,8,utf8_decode($publicacion['raza']),0,1);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,"Barrio",0,1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,8,utf8_decode($publicacion['barrio']),0,1);


//CARGA DE PREGUNTAS
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,20,"PREGUNTAS",0,1,'C');
$listadoPreguntas=array();

cargarPreguntasYRespuestas($idPublicacion,$listadoPreguntas);
foreach ($listadoPreguntas as $clave => $pregunta) {
    //pregunta
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(0,8,"Pregunta",0,1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,8,utf8_decode($pregunta['pregunta']),0,1);
    
    //respuesta
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(0,8,"Respuesta",0,1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,8,utf8_decode($pregunta['respuesta']),0,1);
    $pdf->Cell(0,8,'',0,1);
}
$pdf->AddPage();
//Fotos
cargarFotos($idPublicacion, $fotos, $cantFotos);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,20,"FOTOS",0,1,'C');
$fotos=array();
$cantFotos=0;
cargarFotos($idPublicacion, $fotos, $cantFotos);

for($i=0;$i<=$cantFotos-1;$i++){
    $archivo="fotos/".$idPublicacion."/".$fotos[$i];
    $pdf->Image($archivo,null,null,50);
}

$pdf->Output("FichaPublicacion_". $idPublicacion . ".pdf", 'D');

function cargarDatos($idPublicacion, &$publicacion){
    $conn = new ConexionBD(MOTOR, SERVIDOR, BASEDATOS, USUARIOBASE, CLAVEBASE);
    if($conn->conectar()){
         $sql="SELECT p.id,titulo,descripcion,tipo,e.nombre as especie ,r.nombre as raza,b.nombre as barrio"
                . " FROM publicaciones p, especies e, razas r, barrios b"
                . " WHERE p.id=:id and p.especie_id=e.id and p.raza_id=r.id and p.barrio_id=b.id";
        
        $parametros=array();
        $parametros[0]=array("id", $idPublicacion);
        if($conn->consulta($sql, $parametros)){        
             $publicacion = $conn->siguienteRegistro();
             if ($publicacion['tipo']=='E') {
                    $publicacion['tipo']="ENCONTRADO";
             } else {
                    $publicacion['tipo']="PERDIDO";
             }
             $fotos=array();
             $cantFotos=0;
            
           
        }
        else{
            $respuesta['estado'] = "ERROR";
            $respuesta['mensaje'] = "Error de consulta 2 " . $conn->ultimoError();
        }       
    } 
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
        $sql="SELECT p.id,p.texto as pregunta,p.respuesta,u.nombre"
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
