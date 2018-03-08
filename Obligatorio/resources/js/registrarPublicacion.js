$(document).ready(inicializo);

function inicializo(){
    $("#especieId").change(cargarRazas);
    cargarRazas();
}

function cargarRazas(){
    var especieId = $("#especieId").val();
    
    $.ajax({
        url: "obtenerRazas.php",
        type: "POST",
        dataType: "json",
        data: "especieId=" + especieId,
        success: obtenerRazas,
        error: procesoError,
        timeout: 4000,
    });
}

function obtenerRazas(datos){
    if(datos['estado']=="OK"){
        razas = datos['data'];
        $("#razaId").empty();
        for(pos=0; pos<=razas.length-1; pos++){
            raza = razas[pos];
            $("#razaId").append("<option value='" + raza['id'] + "'>" + raza['nombre'] + "</option>")
        }      
    }
    else{
        alert(datos['mensaje']);
    }
}
function procesoError(){
    alert("Algo no funcionó correctamente!");
}