{extends file='common/layout.tpl'}
{block name=cuerpo}
    <div class="row">
        <div class="col col-md-8">
            <div class="card mt-5">
                <div class="card-body">

                    <div id="principal-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            {for $cant=0 to $total}
                                {if $cant eq 0}
                                    <li data-target="#principal-carousel" data-slide-to="{$cant}" class="active"></li>
                                    {/if}
                                    {if $cant ne 0}
                                    <li data-target="#principal-carousel" data-slide-to="{$cant}"></li>
                                    {/if}
                                {/for}
                        </ol>
                        <div class="carousel-inner">
                            {for $cant=0 to $total}
                                {if $cant eq 0}
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="fotos/{$id}/{$fotos[$cant]}" alt="">
                                    </div>
                                {/if}
                                {if $cant ne 0}
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="fotos/{$id}/{$fotos[$cant]}" alt="">
                                    </div>
                                {/if}
                            {/for}
                        </div>
                        <a class="carousel-control-prev" href="#principal-carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#principal-carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-4 ">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Ficha</h4>
                </div>
                <div class="card-body">
                    <form action="exportarpdf.php?id={$id}">
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            {$tipo}
                        </div>
                        <div class="form-group">
                            <label for="txtTitulo">Titulo</label>
                            <input type="text" class="form-control" placeholder="Titulo" name="txtTitulo" id="txtTitulo" disabled="true" value="{$titulo}">
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">Descripción</label>
                           <textarea class="form-control" rows="10" placeholder="Descripción" name="txtDescripcion" id="txtDescripcion" disabled="true">{$descripcion}</textarea>

                        </div>

                        <div class="form-group">
                            <label for="especies">Especie</label>
                            <input type="text" class="form-control" disabled="true" value="{$especie}">
                        </div>
                        <div class="form-group">
                            <label for="razas">Razas</label>
                            <input type="text" class="form-control" disabled="true" value="{$raza}">

                        </div>
                        <div class="form-group">
                            <label for="barrios">Barrio</label>
                            <input type="text" class="form-control" disabled="true" value="{$barrio}">

                        </div>


                        <div class="form-group">  
                            <div class="form-labe-group">
                                {if $mensaje neq ""}
                                    <div class="alert alert-danger mt-3">{$mensaje}</div>
                                {/if}
                            </div>
                           
                          
                                            
                        </div>
                    </form>
                     <form role="form" action = "exportarpdf.php?id={$id}"  method = "post" class="form">
                       
                         <input class="btn btn-danger btn-block float-right" type="submit" value="Exportar a PDF" id="btnFiltrar"/>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-12">
        <div class="row comentarios d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    <h3>Preguntas</h3>
                    <hr>
                    
                    <div class="col-12">
                        {if $ingreso}
                        <form method="POST" action="insertarPregunta.php?id={$id}" class="form_comentarios  d-flex justify-content-end flex-wrap">
                            <textarea name="txtPregunta" id="txtPregunta" placeholder="Escriba aquí una pregunta"></textarea>
                            <button  class="btn" type="submit">Preguntar</button>
                        </form>
                        {/if}
                        {if not $ingreso}
                            <form method="POST" action="iniciarSesion.php?id={$id}" class="form_comentarios  d-flex justify-content-end flex-wrap">
                                <button class="btn" type="submit">Inicia sesión para realizar una pregunta</button>
                            </form>
                        {/if}
                        {foreach from=$preguntas item=pregunta}
                        <div class="media">
                            <div class="media-body">
                                <p class="nombre">{$pregunta['nombre']}</p>
                                <input type="text" class="form-control mb-3" disabled="true" value="{$pregunta['texto']}">
                                 
                                
                                {if $pregunta['respuesta'] ne ''}
                                <div class="media">
                                    <div  class="col-1"></div>
                                    <div class="media-body">
                                        <p class="nombre">Yo</p>
                                        <input type="text" class="form-control mb-3" disabled="true" value="{$pregunta['respuesta']}">
                                       
                                    </div>
                                </div>
                                {/if}
                            </div>
                        </div>
                        {/foreach}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{/block}


