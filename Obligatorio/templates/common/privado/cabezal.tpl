<!--<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Mascotas Perdidas</a>
      <div class="d-inline-flex align-content-center">
          <div class="p-2 text-white">Hola</div>
          <div>  
              <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                  <a class="nav-link" href="logout.php">Cerrar sesion</a>
                </li>
          </ul></div>
     
          </div>
 </nav>-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- .container nos permite centrar el contenido de nuestro menu, esta clase es opcional y podemos encerrar el menu <nav> o incluir el contenedor dentro del <nav> -->
    <div class="container">
        <!-- Nos sirve para agregar un logotipo al menu -->
        <a href="#" class="navbar-brand">Menu</a>

        <!-- Nos permite usar el componente collapse para dispositivos moviles -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Menu de Navegacion">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="inicioPrivado.php" class="nav-link">Inicio <span class="sr-only">(Actual)</span></a>
                </li>
                 <li class="nav-item">
                    <a href="publicaciones.php" class="nav-link">Publicaciones</a>
                </li>
                <li class="nav-item">
                    <a href="estadisticas.php" class="nav-link">Estadísticas</a>
                </li>
            </ul>
            <div class="d-inline-flex align-content-center">
                <div class="p-2 text-white">Bienvenido/a, {$nombreCompleto}</div>
                <div>  
                    <ul class="navbar-nav px-3">
                        <li class="nav-item text-nowrap">
                            <a class="nav-link" href="logout.php">Cerrar sesion</a>
                        </li>
                    </ul></div>

            </div>

        </div>
    </div>
</nav>