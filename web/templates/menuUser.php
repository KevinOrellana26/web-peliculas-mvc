<h3>Bienvenido <?php echo $_SESSION['nombreUsuario'] ?></h3>

<div class="container-fluid menu text-center p-3 my-4">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ">
				<a href="index.php?ctl=home" class="p-4">Inicio</a>
				<a href="index.php?ctl=listarPeliculas">Peliculas</a>
				<a href="index.php?ctl=buscarPorNombre">Buscar por nombre</a>
				<a href="index.php?ctl=buscarPorAnyio">Buscar por año</a>
				<!-- <a href="index.php?ctl=listarComentarios">Listar comentarios</a> -->
                <a href="index.php?ctl=agregarComentario">Agregar comentario a una pelicula</a>
				
				<a HREF="index.php?ctl=salir"><button TYPE="button" class="btn btn-secondary mt-3" style="width: 150px;">Cerrar Sesión</button></a>

			</div>
		</div>
	</div>
</div>