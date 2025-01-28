<?php ob_start() ?>

<!-- <div class="container text-center">
    <div class="col-md-12" id="cabecera">
        <h1 class="h1Inicio">Peliculas</h1>
    </div>
</div> -->

<div class="container text-center py-2">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])) : ?>
            <b><span style="color: rgb(255, 0, 0);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="container text-center p-4">
    <form action="index.php?ctl=iniciarSesion" method="post" name="formIniciarSesion">
        <h5>Iniciar sesión</h5>
        <!-- Nombre de usuario y Contraseña en la misma línea -->
        <div class="row mb-3 justify-content-center pt-2">
            <!-- Nombre de usuario -->
            <div class="col-md-4 text-start">
                <label for="nombreUsuario" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombreUsuario" placeholder="Usuario">
            </div>
        </div>
        <!-- Contraseña -->
        <div class="row mb-3 justify-content-center pb-2">
            <div class="col-md-4 text-start">
                <label for="contraseya" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasenya" placeholder="Contraseña">
            </div>
        </div>

        <!-- Botones Aceptar y Reset en la misma línea -->
        <button type="submit" name="bIniciarSesion" class="btn btn-primary me-2">Aceptar</button>
    </form>
</div>





<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>