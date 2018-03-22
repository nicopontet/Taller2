

$(document).ready(inicializo);

var pagina = 1;
var ultPag = 0;

function inicializo(){

    $("#btnANT").click(anteriorPagina);
    $("#btnSIG").click(siguientePagina);
    $("#btnINI").click(primeraPagina);
    $("#btnFIN").click(ultimaPagina);
    $(".irPagina").click(irPaginaNro);
    $("#btnFiltrar").click(aplicarFiltro);
    cargarPublicaciones();
}

function aplicarFiltro(){
    pagina=1;
    cargarPublicaciones(pagina);
}

function irPaginaNro(){
    var pag = $(this).val();
    pagina = pag;
    cargarPublicaciones(pagina);
}

function primeraPagina(){
    pagina = 1;
    obtenerPublicaciones(pagina);
}

function ultimaPagina(){
    pagina = ultPag;
    cargarPublicaciones(pagina);
}

function anteriorPagina(){
    if(pagina > 1){
        pagina--;
    }
    else{
        pagina = ultPag;
    }
    cargarPublicaciones(pagina);
}

function siguientePagina(){
    if(pagina < ultPag){
        pagina++;
    }
    else{
        pagina = 1;
    }
    cargarPublicaciones(pagina);
}

function cargarPublicaciones(){
    obtenerPublicaciones(pagina);
}

function obtenerPublicaciones(pagina){
    var usuario="@Request.RequestContext.HttpContext.Session['usuario_id']";
    var abierto=$("#sltAbierto").val();
    $.ajax({
        url: "obtenerPublicaciones.php",
        type: "POST",
        dataType: "json",
        data: {'misPublicaciones':true ,'pagina': pagina, 'abierto':abierto,'usuario':usuario},
        success: cargoFilas
    });    
}

function cargoFilas(datos){
    var lineas = 1;
    var abierto=$("#sltAbierto").val();
    if(datos['estado'] == "OK"){
        ultPag = datos['totPaginas'];
        $("#publicaciones").empty();
        publicaciones = datos["data"];
        totalFilas=0;
        fila = ""; 
        for(pos = 0; pos <= publicaciones.length-1; pos++){
            publicacion = publicaciones[pos];
             if((pos% 5) == 0){
                 fila += "<div class='row mt-3 mb-3'>"; 
                 totalFilas = 0;
            }; 
             
            totalFilas++;
            fila += "<div class='col-4'> <div class='card'>";
            foto = "fotos/"+publicacion['id']+"/"+publicacion['foto'];
            fila += "<img src='" + foto + "' class='card-img-top img-fluid'/>";
            fila += "<div class='card-body'>"
            fila += "<h3 class='card-title'><a target='_blank' href='fichaPublicacion.php?id="+publicacion['id']+"'>" + publicacion['titulo'] + "</a></h3>";
            fila += "<p class='card-text'>" + publicacion['descripcion'] + "</p>";
            if (publicacion['tipo']=='E') {
                tipo="Encontrado";
            }else{ tipo="Perdido"}
            fila += "<h6 class='card-title'>" + tipo + "</h6>";
            if (abierto==='1') {
                fila += "<button type='button' class='btn btn-sm-primary' data-toggle='modal' data-target='#cerrarPublicacionModal' data-id='"+publicacion['id']+"'>Cerrar publicación</button>";
            }
            fila += "</div></div></div>";
             if(totalFilas == 5){
               fila += "</div>"; 
            }; 
            
            
           
            lineas++;
        }
        $("#publicaciones").append(fila);
        for(pos=lineas; pos<=cantidadXpagina; pos++){
            $("#publicaciones").append("<tr><td colspan='6'>&nbsp;</td></tr>");
        }
        $("#pagActual").html("<b>" + pagina + "/" + ultPag + "</b>")
     //   $(".borrar").click(procesoBorrar);
      //  $(".modif").click(procesoModif);
    }
    else{
        alert(datos['mensaje']);
    }
}
$('#cerrarPublicacionModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var idPublicacion = button.data('id') 
    var modal = $(this)
    $("#id").val(idPublicacion)   
})
