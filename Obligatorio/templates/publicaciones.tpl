{extends file='common/layout.tpl'}
{block name=cuerpo}
    <div class="row">
        <div class="col col-md-12 ">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Filtrar publicación</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-12 col-md-3 mb-3">
                                <label for="tipo">Tipo</label>
                                <select id="tipoId" name="tipoId" class="form-control">
                                    <option value="T">Todos</option> 
                                    <option value="E">Encontrado</option> 
                                    <option value="P">Perdido</option> 
                                </select>
                            </div>
                            <div class="col-12 col-md-9 mb-3">
                                <label for="buscarPalabra">Buscar palabra</label>
                                <input type="text" class="form-control" placeholder="Buscar palabra en título o en descripción" name="buscarPalabra" id="buscarPalabra">
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-12 col-md-3 mb-3">
                                <label for="especies">Especie</label>
                                <select id="especieId" name="especieId" class="form-control">
                                    <option value="0">Todas</option>
                                    {foreach from=$especies item=especie}
                                        <option value="{$especie['id']}" {if $especie['id'] eq 0}selected="selected"{/if}>{$especie['nombre']}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label for="razas">Razas</label>
                                <select id="razaId" name="razaId" class="form-control">
                                    <option value="0">Sin Dato</option> 
                                </select>

                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label for="barrios">Barrio</label>
                                <select id="barrioId" name="barrioId" class="form-control">
                                    <option value="0">Todas</option>
                                    {foreach from=$barrios item=barrio}
                                        <option value="{$barrio['id']}" {if $barrio['id'] eq 0}selected="selected"{/if}>{$barrio['nombre']}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="col-12 col-md-3 mb-3 mt-4">
                                <input class="btn btn-primary btn-block float-right" type="button" value="Filtrar" id="btnFiltrar"/>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 ">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-auto">
                            <h4>Resultado</h4>
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

                    <div class="container">
                        <div id="publicaciones"></div>
                    </div>
                    <div class="card-footer">         

                    </div>
                </div>
            </div>
        </div>
    </div>
     
{/block}
{block name=js}
   <script src="resources/js/publicaciones.js"></script>
    <script type="text/javascript">
          var cantidadXpagina = {$smarty.const.CANTXPAG};
    </script>
{/block}