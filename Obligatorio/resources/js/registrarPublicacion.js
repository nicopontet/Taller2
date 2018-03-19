$(document).ready(inicializo);

function inicializo(){
    $("#imgPublicacion").hide();
}
  function archivo(evt) {
                  
                  var files = evt.target.files; // FileList object
             
                    for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
                    //Solo admitimos imágenes.
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         $("#imgPublicacion").attr("src", e.target.result,"title", escape(theFile.name));
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                    $("#imgPublicacion").show();
                    }     
              }
             
 document.getElementById('archivoPublicacion').addEventListener('change', archivo, false);
