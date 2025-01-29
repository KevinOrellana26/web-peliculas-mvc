<?php ob_start() ?>

<div class="container text-center p-2">
    <div class="col-md-12" id="cabecera">
        <h1 class="h1">Registrarse</h1>
    </div>
</div>

<div class="container text-center py-2">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])) : ?>
            <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="container p-4">
    <form action="index.php?ctl=registro" method="post" name="formRegistro" enctype="multipart/form-data">
        <!-- Nombre y Apellido en la misma línea -->
        <div class="row mb-3">
            <!-- Nombre -->
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $params['nombre'] ?>" id="nombre" placeholder="Nombre">
                <div class="text-danger">
                    <?php echo (isset($errores['nombre'])) ? "$errores[nombre]" : ""; ?>
                </div>
            </div>
            <!-- Apellido -->
            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="<?php echo $params['apellido'] ?>" id="apellido" placeholder="Apellido">
                <div class="text-danger">
                    <?php echo (isset($errores['apellido'])) ? "$errores[apellido]" : ""; ?>
                </div>
            </div>
        </div>
        <!-- Nombre de usuario -->
        <div class="mb-3">
            <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" name="nombreUsuario" value="<?php echo $params['nombreUsuario'] ?>" id="nombreUsuario" placeholder="Nombre de usuario">
            <div class="text-danger">
                <?php echo (isset($errores['nombreUsuario'])) ? "$errores[nombreUsuario]" : ""; ?>
            </div>
        </div>
        <!-- Contraseña -->
        <div class="mb-3">
            <label for="contrasenya" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="contrasenya" value="<?php echo $params['contrasenya'] ?>" id="contrasenya" placeholder="Contraseña">
            <div class="text-danger">
                <?php echo (isset($errores['contrasenya'])) ? "$errores[contrasenya]" : ""; ?>
            </div>
        </div>
        <!-- Confirmar Contraseña -->
        <div class="mb-3">
            <label for="contrasenya2" class="form-label">Repite Contraseña</label>
            <input type="password" class="form-control" name="contrasenya2" id="contrasenya2" placeholder="Confirmar Contraseña">
        </div>
        <!-- Foto de perfil -->
        <div class="mb-3">
            <label for="fotoPerfil" class="form-label">Foto de Perfil</label>
            <input type="file" class="form-control" name="fotoPerfil" accept="img/*" id="fotoPerfil">
            <div class="text-danger">
                <?php echo (isset($errores['fotoPerfil'])) ? "$errores[fotoPerfil]" : ""; ?>
            </div>
        </div>
        <!-- Botones Aceptar y Reset en la misma línea -->
        <div class="d-flex justify-content-around">
            <button type="submit" name="bRegistro" class="btn btn-primary me-2">Aceptar</button>
            <button type="reset" class="btn btn-secondary">Borrar</button>
        </div>
    </form>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>