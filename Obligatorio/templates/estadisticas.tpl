{extends file='common/layout.tpl'}
{block name=cuerpo}
<div class="row">
        <div class="col col-md-12 ">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-auto">
                            <h4>Estadísticas</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                   <form>
                        <div class="form-group row">
                            <div class="col-12 col-md-3 mb-3">
                                <label for="tipo">Tipo</label>
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="E">Encontrado</option> 
                                    <option value="P">Perdido</option> 
                                </select>
                            </div>
                             <div class="col-12 col-md-3 mb-3">
                                <label for="tipo">Publicación</label>
                                <select id="abierto" name="abierto" class="form-control">
                                    <option value="1">Abierta</option> 
                                    <option value="0">Cerrada</option> 
                                </select>
                            </div>
                          
                            <div class="col-12 col-md-3 mb-3 mt-4">
                                <input class="btn btn-primary btn-block float-right" type="button" value="Filtrar" id="btnFiltrar"/>
                            </div>
                        </div>
                          
                      </form>
                    <div class="container">
                                <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Especie</th>
                                    <th scope="col">Cant. Total</th>
                                    <th scope="col">Cant. con exito</th>
                                    <th scope="col">Cant. sin exito</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="datosEstadisitica">                      
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}
{block name=js}
   <script src="resources/js/estadisticas.js"></script>
{/block}