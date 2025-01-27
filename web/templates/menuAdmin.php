<h3 class="text-center pt-4">Bienvenido, <?php echo $_SESSION['nombreUsuario'] ?></h3>
<h4 class="text-center ">Puedes realizar las siguientes acciones</h4>
<div class="text-center p-3 my-4 bg-light">
    <div class="row mb-3">
        <!-- Primera línea de botones -->
        <div class="col-12 d-flex justify-content-center flex-wrap">
            <a href="index.php?ctl=home" class="mx-2 my-1">Inicio</a>
            <a href="index.php?ctl=listarPeliculas" class="mx-2 my-1">Películas</a>
            <a href="index.php?ctl=buscarPorNombre" class="mx-2 my-1">Buscar por Nombre</a>
            <a href="index.php?ctl=buscarPorAnyio" class="mx-2 my-1">Buscar por Año</a>
            <a href="index.php?ctl=listarUsuarios" class="mx-2 my-1">Listar Usuarios</a>
        </div>
    </div>
    <div class="row mb-3">
        <!-- Segunda línea de botones -->
        <div class="col-12 d-flex justify-content-center flex-wrap">
            <a href="index.php?ctl=agregarPelicula" class="mx-2 my-1">Agregar Película</a>
            <a href="index.php?ctl=editarPelicula" class="mx-2 my-1">Editar Película</a>
            <a href="index.php?ctl=eliminarPelicula" class="mx-2 my-1">Eliminar Película</a>
            <a href="index.php?ctl=agregarComentario" class="mx-2 my-1">Agregar Comentario</a>
            <a href="index.php?ctl=eliminarComentario" class="mx-2 my-1">Eliminar Comentario</a>
        </div>
    </div>
    <div class="row">
        <!-- Botón Cerrar Sesión en línea independiente -->
        <div class="col-12 text-center">
            <a href="index.php?ctl=salir">
                <button type="button" class="btn btn-secondary mt-3" style="width: 150px;">Cerrar Sesión</button>
            </a>
        </div>
    </div>
</div>

