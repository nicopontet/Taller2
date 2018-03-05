{extends file='common/layout.tpl'}
{block name=cuerpo}
    <div class="row">
            <div class="col col-md-3"></div>
            <div class="col col-md-6 ">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Registrarse</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="procesoRegistroUsuario.php">
                            <div class="form-group">
                                <label for="txtNombre">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="txtNombre" id="txtNombre">
                            </div>

                            <div class="form-group">
                                <label for="txtApellido">Apellido</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="txtApellido" id="txtApellido">
                            </div>
                            <div class="form-group">
                                <label for="txtEmail">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="txtEmail" id="txtEmail">
                            </div>
                            <div class="form-group">
                                <label for="txtClave">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="txtClave" id="txtClave">
                            </div>
                            <div class="form-labe-group">
                                {if $mensaje neq ""}
                                    <div class="alert alert-danger mt-3">{$mensaje}</div>
                                 {/if}
                            </div>
                            <button class="btn btn-primary" type="submit">Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
{/block}


