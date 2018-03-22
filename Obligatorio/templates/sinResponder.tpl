{extends file='common/layout.tpl'}
{block name=cuerpo}
    <div class="row">
        <div class="col-12">
            <div class="row comentarios d-flex flex-column">
               
                        {foreach from=$publicacionesSinResponder item=pregunta}
                            <div class="row comentarios d-flex flex-column">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4> Título publicación: {$pregunta['titulo']} </h4>
                                    </div>
                                    <div class="card-body"> 
                                        <div class="col-12">
                                            {if $pregunta['descripcion'] eq ""}
                                                Descripción: Sin descripción
                                            {else}
                                                Descripción: {$pregunta['descripcion']}
                                            {/if}
                                            <div class="media">
                                                <form method="POST" action="insertarRespuesta.php?id={$pregunta['id_publicacion']}&idPregunta={$pregunta['id_pregunta']}" class="form_comentarios  d-flex justify-content-end  flex-wrap">
                                                    <div class="media-body">
                                                        <p class="nombre">{$pregunta['nombre']}</p>
                                                        Pregunta: {$pregunta['texto']}
                                                        <textarea name="txtRespuesta" id="txtRespuesta" placeholder="Responda aquí"></textarea>
                                                        <button  class="btn" type="submit">Responder</button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/foreach}




            
            </div>
        </div>
    </div>


{/block}


