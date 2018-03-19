$(document).ready(inicializo);

var pagina = 1;
var ultPag = 0;

function inicializo(){
 //   $("#alta").click(procesoAlta);
    $("#btnANT").click(anteriorPagina);
    $("#btnSIG").click(siguientePagina);
    $("#btnINI").click(primeraPagina);
    $("#btnFIN").click(ultimaPagina);
    $(".irPagina").click(irPaginaNro);
 //   $("#btnFiltrar").click(aplicarFiltro);
    cargarPublicaciones();
}

/*function aplicarFiltro(){
    pagina=1;
    traigoUsuarios(pagina);
}*/

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


/*function procesoModif(){
    var usuId = $(this).attr("alt");
    window.location = "modifUsuario.php?id=" + usuId;
}

function procesoBorrar(){
    var usuId = $(this).attr("alt");
    if(confirm("Desea borrar el usuario seleccionado?")){
        window.location = "borroUsuario.php?id=" + usuId;
    }
}*/



function cargarPublicaciones(){
    obtenerPublicaciones(pagina);
}

function obtenerPublicaciones(pagina){
    $.ajax({
        url: "obtenerPublicaciones.php",
        type: "POST",
        dataType: "json",
        data: "pagina=" + pagina,// + "&filtro=" + $("#txtFiltro").val(),
        success: cargoFilas
    });    
}

function cargoFilas(datos){
    var lineas = 1;
    if(datos['estado'] == "OK"){
        ultPag = datos['totPaginas'];
        $("#publicaciones").empty();
        publicaciones = datos["data"];
        for(pos = 0; pos <= publicaciones.length-1; pos++){
            publicacion = publicaciones[pos];
            fila = "<tr>";
            
            foto = publicacion['foto'];
            if(publicacion['foto'] == ""){
                foto = "imagenes/vacio.png";
            }
            fila += "<td><img src='" + foto + "' width='40px'></td>";
            fila += "<td>" + publicacion['titulo'] + "</td>";
            fila += "<td>" + publicacion['descripcion'] + "</td>";
            if (publicacion['tipo']=='E') {
                tipo="Encontrado";
            }else{ tipo="Perdido"}
            fila += "<td>" + tipo + "</td>";
            
      /*      fila += "<td>";
            fila += "<input type='button' class='borrar' value='Borrar' alt='" + usuario['usuId'] +"'>";
            fila += "<input type='button' class='modif' value='Modificar' alt='" + usuario['usuId'] +"'>";
            fila += "</td>";*/
            fila += "</tr>";
            $("#publicaciones").append(fila);
            lineas++;
        }
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