<?php ob_start(); ?>

<div class="container text-center py-2">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])) : ?>
            <b><span style="color: rgb(255, 0, 0);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <?php foreach ($params['peliculas'] as $index => $pelicula) : ?>
            <!-- Columna para cada portada -->
            <div class="col-md-4 text-center">
                <a href="index.php?ctl=verPelicula&id_pelicula=<?php echo $pelicula['id_pelicula'] ?>">
                    <img src="img/<?php echo $pelicula['portada']; ?>" alt="Portada" class="img-fluid rounded shadow" style="max-height: 300px;">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>