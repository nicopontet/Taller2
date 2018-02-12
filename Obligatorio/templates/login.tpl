<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi primer APP</title>
    </head>
    <body>
        <form method="post" action="procesoLogin.php">
            Usuario: <input type="text" id="txtUsuario" name="txtUsuario" value="{$usuario}"/>
            <br/>
            Clave: <input type="password" id="txtClave" name="txtClave"/>
            <br/>
            <input type="submit" value="Ingresar al Sistema"/>
        </form>
        <div>{$mensaje}</div>
    </body>
</html>
