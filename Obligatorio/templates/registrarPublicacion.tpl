{extends file='common/layout.tpl'}
{block name=cuerpo}
    <div class="row">
        <div class="col col-md-3"></div>
        <div class="col col-md-6 ">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Registrar publicación</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="procesoRegistroPublicacion.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="txtTitulo">Titulo</label>
                            <input type="text" class="form-control" placeholder="Titulo" name="txtTitulo" id="txtTitulo">
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">Descripción</label>
                            <textarea class="form-control" rows="5" placeholder="Descripción" name="txtDescripcion" id="txtDescripcion"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select id="tipoId" name="tipoId" class="form-control">
                                <option value="E">Encontrado</option> 
                                <option value="P">Perdido</option> 
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="especies">Especie</label>
                            <select id="especieId" name="especieId" class="form-control">
                                {foreach from=$especies item=especie}
                                    <option value="{$especie['id']}" {if $especie['id'] eq 0}selected="selected"{/if}>{$especie['nombre']}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="razas">Razas</label>
                            <select id="razaId" name="razaId" class="form-control">
                                <option value="0">Sin Dato</option> 
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="barrios">Barrio</label>
                            <select id="barrioId" name="barrioId" class="form-control">
                                {foreach from=$barrios item=barrio}
                                    <option value="{$barrio['id']}" {if $barrio['id'] eq 0}selected="selected"{/if}>{$barrio['nombre']}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="form-group">    
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="archivoPublicacion" name="archivoPublicacion">
                            </div>
                        </div>
                        <div class="form-group">    
                            <div class="row no-gutters">
                                <div class="col-4 columna">
                                    <img id="imgPublicacion" name="imgPublicacion" class="imgPublicacion img-fluid float-left img-thumbnail"/>
                                </div>
                            </div>
                            <div class="form-labe-group">
                                {if $mensaje neq ""}
                                    <div class="alert alert-danger mt-3">{$mensaje}</div>
                                {/if}
                            </div>
                            <div class="form-group">    
                                <div class="row no-gutters">
                                    <button class="btn btn-primary" type="submit">Publicar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    </div>
{/block}


