<div class="col">
	<div>
		<p>Usuario: <?php echo $_SESSION['nombreUsuario'] . " ";
			echo "<img src='img/" . $_SESSION['fotoPerfil'] . "' class='rounded-circle' style='width: 25px; height: 25px; object-fit: cover;' alt='Foto de perfil'> ";  ?>
			<br><a HREF="index.php?ctl=salir"><button TYPE="button" class="btn btn-secondary mt-3" style="width: 150px;">Cerrar Sesión</button></a>
		</p>
	</div>
</div>