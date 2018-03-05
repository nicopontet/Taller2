$(document).ready(inicializo);

function inicializo(){
	$("#login").click(aplicarFiltro);
}

function aplicarFiltro(){
	$.ajax({
		async:true,
		type: "POST",
		dataType: "html",
		contentType: "application/x-www-form-urlencoded",
                success:procesoRespuesta,
		error:errorRespuesta,		
		timeout:4000,                      
		url:"login.php",     		
	});
}
function procesoRespuesta(dato){
	$("#error").html(dato);
}
function errorRespuesta(error){
	$("#error").html(error);
}