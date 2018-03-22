$(document).ready(inicializo);


function inicializo(){
    $("#btnFiltrar").click(obtenerEstadisticas);
    obtenerEstadisticas();
}

function obtenerEstadisticas(){
    var encontrado=$("#tipo").val();
    var abierto=$("#abierto").val();
    $.ajax({
        url: "obtenerEstadisticas.php",
        type: "POST",
        dataType: "json",
        data: { 'tipo':encontrado,'abierto':abierto},
        success: cargoTabla
    });    
}

function cargoTabla(datos){
   
    if(datos['estado'] == "OK"){
        $("#datosEstadisitica").empty();
        estadisticas = datos["data"];
        totalFilas=0;
        fila = "";
        for(pos = 0; pos <= estadisticas.length-1; pos++){
            estadistica = estadisticas[pos];
            fila = "<tr>";
            fila += "<td>" + estadistica['especie'] + "</td>";
            fila += "<td>" + estadistica['abiertos'] + "</td>";
            fila += "<td>" + estadistica['abiertosPos'] + "</td>";
            fila += "<td>" + estadistica['abiertosNeg'] + "</td>";
            fila += "</tr>";
           $("#datosEstadisitica").append(fila);
        }
         
    }
    else{
        alert(datos['mensaje']);
    }
}