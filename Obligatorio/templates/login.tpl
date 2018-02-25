<html>
    <head>
        <meta charset="UTF-8">
        <title>Login - Obligatorio</title>
         <link rel="stylesheet" href="resources/css/bootstrap.css">
         <link rel="stylesheet" href="resources/css/login.css">
    
    </head>
    <body>
                    <form class="form-signin" method="post" action="login.php">
                        <div class="text-center mb-4">
                            <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                            <h1 class="h3 mb-3 font-weight-normal">Obligatorio</h1>
                            <p>Taller de programación</p>
                          </div>
                        <div class="form-label-group">
                            <input class="form-control" type="text" id="txtUsuario" name="txtUsuario" value="{$usuario}" required autofocus/>
                            <label for="usuario">Usuario</label> 
                        </div>
                         <div class="form-label-group">
             
                             <input class="form-control" type="password" id="txtClave" name="txtClave" required/>
                             <label for="pass">Contraseña</label> 
                       </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                        <div>{$mensaje}</div>
                        <p class="mt-5 mb-3 text-muted text-center">Universidad ORT - Uruguay</p>
                    </form>
                    
        
    </body>
</html>
