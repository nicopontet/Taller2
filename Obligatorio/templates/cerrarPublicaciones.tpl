{extends file='common/layout.tpl'}
{block name=cuerpo}
    <div class="row">
        <div class="col col-md-12 ">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-auto">
                            <h4>Mis publicaciones</h4>
                            <h6>Visualizar y cerrar publicaciones</h6>
                        </div>
                        <div class="col-6 col-auto-ml">
                            <ul class="pagination">
                                <li class="page-item"><a id="btnINI" class="page-link" href="#">Inicio</a></li>
                                <li class="page-item"><a id="btnANT" class="page-link" href="#">Anterior</a></li>
                                <li class="page-item active"><a id="pagActual" class="page-link" href="#"> <span id="pagActual"></span></a></li>
                                <li class="page-item"><a id="btnSIG" class="page-link" href="#">Siguiente</a></li>
                                <li class="page-item"><a id="btnFIN" class="page-link" href="#">Fin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                      <form>
                        <div class="form-group row">
                            <div class="col-12 col-md-3 mb-3">
                                <label for="tipo">Publicaciones</label>
                                <select id="sltAbierto" name="sltAbierto" class="form-control">
                                    <option value="1">Abierta</option> 
                                    <option value="0">Cerradas</option> 
                                </select>
                            </div>
                          
                            <div class="col-12 col-md-3 mb-3 mt-4">
                                <input class="btn btn-primary btn-block float-right" type="button" value="Filtrar" id="btnFiltrar"/>
                            </div>
                        </div>
                          
                      </form>
                    <div class="container">
                        <div id="publicaciones"></div>
                    </div>
                    <div class="card-footer">         

                    </div>
                </div>
            </div>
        </div>
    </div>
    
  <!--Formulario modal para cerrar una publicación-->
  <div class="modal fade" id="cerrarPublicacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cerrar publicacion</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <form action="cerrarPublicacion.php" method="POST">
      <div class="modal-body">
         
              <div class="form-group row">
                  
                  <input type="hidden" class="form-control"  name="id" id="id">
                  <div class="col-12  mb-3">
                     <label for="exito">¿La mascota se reunió con su dueño?</label>
                                <select name="exitoso" class="form-control">
                                    <option value="0">No</option> 
                                    <option value="1">Sí</option> 
                                </select>
                   </div>
              </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" value="Cerrar publicación">
      </div>
             </form>
    </div>
  </div>
</div>
{/block}
{block name=js}
   <script src="resources/js/cerrarPublicaciones.js"></script>
   <script type="text/javascript">
          var cantidadXpagina = {$smarty.const.CANTXPAG};
    </script>
{/block}