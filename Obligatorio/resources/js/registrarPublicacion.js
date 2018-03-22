$(document).ready(inicializo);

function inicializo(){
   // $("#imgPublicacion").hide();
}
  function archivo(evt) {
                  
                  var files = evt.target.files; // FileList object
             
                    for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                        if (!f.type.match('image.*')) {
                            continue;
                        }
                         $("#imagenes").empty()
                        //Solo admitimos imágenes.
                        var reader = new FileReader();
                          reader.onload = function(e) {
                           
                            fila="<img src='" + e.target.result + "' class='img-fotos card-img-top img-thumbnail'/>"
                            $("#imagenes").append(fila);
                        };
                        reader.readAsDataURL(f);
                    }    
              }
 //$("#archivoPublicacion[]").bind('change',archivo,false);          
 document.getElementById('archivoPublicacion[]').addEventListener('change', archivo, false);
