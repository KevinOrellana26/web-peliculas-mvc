<?php ob_start() ?>

<div class="container text-center p-4">
    <div class="col-md-12" id="cabecera">
        <h1 class="h1Inicio">REGISTRARSE</h1>
    </div>
</div>

<div class="container text-center py-2">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])) : ?>
            <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="container text-center p-1">
    <form ACTION="index.php?ctl=registro" METHOD="post" NAME="formRegistro" ENCTYPE="multipart/form-data">
        <span style="color: rgba(200, 119, 119, 1);"><?php echo (isset($errores['nombre'])) ? "$errores[nombre] <br>" : ""; ?></span>
        <p>nombre: <input TYPE="text" NAME="nombre" VALUE="<?php echo $params['nombre'] ?>" PLACEHOLDER="Nombre"></p>

        <span style="color: rgba(200, 119, 119, 1);"><?php echo (isset($errores['apellido'])) ? "$errores[apellido] <br>" : ""; ?></span>
        <p>apellido: <input TYPE="text" NAME="apellido" VALUE="<?php echo $params['apellido'] ?>" PLACEHOLDER="Apellido"></p>

        <span style="color: rgba(200, 119, 119, 1);"><?php echo (isset($errores['nombreUsuario'])) ? "$errores[nombreUsuario] <br>" : ""; ?></span>
        <p>usuario: <input TYPE="text" NAME="nombreUsuario" VALUE="<?php echo $params['nombreUsuario'] ?>" PLACEHOLDER="Nombre de usuario"></p>

        <span style="color: rgba(200, 119, 119, 1);"><?php echo (isset($errores['contrasenya'])) ? "$errores[contrasenya] <br>" : ""; ?></span>
        <p>contraseña: <input TYPE="password" NAME="contrasenya" VALUE="<?php echo $params['contrasenya'] ?>" PLACEHOLDER="Contraseña"><br></p>
        <p>repite contraseña: <input TYPE="password" NAME="contrasenya2" PLACEHOLDER="repite"><br></p>

        <span style="color: rgba(200, 119, 119, 1);"><?php echo (isset($errores['fotoPerfil'])) ? "$errores[fotoPerfil] <br>" : ""; ?></span>
        <p>Foto de perfil: <input TYPE="file" NAME="fotoPerfil" ACCEPT="image/*"><br></p>
        <input TYPE="submit" NAME="bRegistro" VALUE="Aceptar"><br>
    </form>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>