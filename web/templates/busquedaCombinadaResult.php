<?php ob_start(); ?>


<div class="container text-center py-2">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])) : ?>
            <b><span style="color: rgba(200, 119, 119, 1);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="container p-4">
    <form action="index.php?ctl=busquedaCombinada" method="post" name="formBusquedaComb" enctype="multipart/form-data">
        <!-- Titulo y Año en la misma línea -->
        <div class="row mb-3">
            <!-- Año -->
            <div class="col-md-4">
                <label for="anio" class="form-label">Año de publicación</label>
                <input type="number" class="form-control" name="anio" value="<?php echo isset($params['anio']) ? $params['anio'] : ''; ?>" id="anio" placeholder="Año">
                <div class="text-danger">
                    <?php echo isset($errores['anio']) ? $errores['anio'] : ""; ?>
                </div>
            </div>
            <!-- Categoría -->
            <div class="col-md-4">
                <label for="categoria" class="form-label">Genero</label>
                <input type="text" class="form-control" name="categoria" value="<?php echo isset($params['categoria']) ? $params['categoria'] : ''; ?>" id="categoria" placeholder="Genero">
                <div class="text-danger">
                    <?php echo isset($errores['categoria']) ? $errores['categoria'] : ""; ?>
                </div>
            </div>
            <!-- Botones Aceptar y Reset -->
            <div class="col-md-4 d-flex align-items-end justify-content-around">
                <button type="submit" name="bCombinada" class="btn btn-primary me-2">Aceptar</button>
            </div>
        </div>
    </form>
</div>

<div class="container py-4">
    <div class="row">
        <?php foreach ($params['peliculas'] as $index => $pelicula) : ?>
            <!-- Columna para cada portada -->
            <div class="col-md-4 text-center my-3">
                <a href="index.php?ctl=verPelicula&id_pelicula=<?php echo $pelicula['id_pelicula'] ?>">
                    <img src="img/<?php echo $pelicula['portada']; ?>" alt="Portada" class="img-fluid rounded shadow" style="max-height: 300px;">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>