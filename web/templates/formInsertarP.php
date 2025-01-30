<?php ob_start(); ?>

<div class="container text-center py-2">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])) : ?>
            <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="container p-4">
    <form action="index.php?ctl=insertarP" method="post" name="formInsertarP" enctype="multipart/form-data">
        <!-- Titulo y Año en la misma línea -->
        <div class="row mb-3">
            <!-- Titulo -->
            <div class="col-md-6">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" value="<?php echo $params['titulo'] ?>" id="titulo" placeholder="Titulo">
                <div class="text-danger">
                    <?php echo (isset($errores['titulo'])) ? "$errores[titulo]" : ""; ?>
                </div>
            </div>
            <!-- Año -->
            <div class="col-md-6">
                <label for="anio" class="form-label">Año de publicación</label>
                <input type="number" class="form-control" name="anio" value="<?php echo $params['anio'] ?>" id="anio" placeholder="Año">
                <div class="text-danger">
                    <?php echo (isset($errores['anio'])) ? "$errores[anio]" : ""; ?>
                </div>
            </div>
        </div>
        <!-- Descripcion -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" value="<?php echo $params['descripcion'] ?>" id="descripcion" placeholder="Descripcion">
            <div class="text-danger">
                <?php echo (isset($errores['descripcion'])) ? "$errores[descripcion]" : ""; ?>
            </div>
        </div>
        <!-- Categoria -->
        <div class="mb-3">
            <label for="categoria" class="form-label">Genero</label>
            <input type="text" class="form-control" name="categoria" value="<?php echo $params['categoria'] ?>" id="categoria" placeholder="Genero">
            <div class="text-danger">
                <?php echo (isset($errores['categoria'])) ? "$errores[categoria]" : ""; ?>
            </div>
        </div>
        <!-- Portada -->
        <div class="mb-3">
            <label for="portada" class="form-label">Portada</label>
            <input type="file" class="form-control" name="portada" accept="img/*" id="portada">
            <div class="text-danger">
                <?php echo (isset($errores['portada'])) ? "$errores[portada]" : ""; ?>
            </div>
        </div>
        <!-- Botones Aceptar y Reset en la misma línea -->
        <div class="d-flex justify-content-around">
            <button type="submit" name="bInsertarP" class="btn btn-primary me-2">Aceptar</button>
            <button type="reset" class="btn btn-secondary">Borrar</button>
        </div>
    </form>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>