$(document).ready(inicializo);

function inicializo(){
    $("#deptoId").onclick();
}

function cargarLocalidades(){
    var deptoId = $("#deptoId").val();
    
    $.ajax({
        url: "traigoLocalidades.php",
        type: "POST",
        dataType: "json",
        data: "deptoId=" + deptoId,
        success: procesoLocalidades,
        error: procesoError,
        timeout: 4000,
        beforeSend: pongoEspera
    });
}

function procesoLocalidades(datos){
    if(datos['estado']=="OK"){
        localidades = datos['data'];
        $("#locId").empty();
        for(pos=0; pos<=localidades.length-1; pos++){
            localidad = localidades[pos];
            $("#locId").append("<option value='" + localidad['locId'] + "'>" + localidad['locNom'] + "</option>")
        }      
        window.setInterval(ocultoEspera,3000);
    }
    else{
        alert(datos['mensaje']);
    }
}