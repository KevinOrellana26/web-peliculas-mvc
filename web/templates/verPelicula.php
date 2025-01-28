<?php ob_start(); ?>


<div class="container text-center py-2">
    <div class="col-md-12">
        <?php if (isset($params['mensaje'])) : ?>
            <b><span style="color: rgb(255, 0, 0);"><?php echo $params['mensaje'] ?></span></b>
        <?php endif; ?>
    </div>
</div>

<?php if(isset($params['peliculas']) && !empty($params['peliculas'])) : ?>
    <div class="container py-1">
        <!-- titulo-->
        <h3 class="text-center mb-4"><?php echo $params['peliculas']['titulo']; ?></h3>

        <!-- 1 fila, 3 columnas -->
        <div class="row align-items-center">
            <div class="col-md-4 text-end">
                <p><b>Descripción:</b></p>
                <p><b>Año:</b></p>
                <p><b>Categoría:</b></p>
            </div>
            <div class="col-md-4 text-start">
                <p><?php echo $params['peliculas']['descripción']; ?></p>
                <p><?php echo $params['peliculas']['anio']; ?></p>
                <p><?php echo $params['peliculas']['categoria']; ?></p>
            </div>
            <div class="col-md-4 text-center">
                <img src="img/<?php echo $params['peliculas']['portada']; ?>" alt="Portada" class="img-fluid rounded shadow" style="max-height: 300px;">
            </div>
        </div>

        <!-- Listar los comentarios asociados al id en cuestion -->

        <?php var_dump($params['comentarios']);?>
        <div class="mt-4">
            <?php if (isset($params['comentarios'])) : ?>
                <ul class="list-group">
                    <?php foreach ($params['comentarios'] as $comentario) : ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between text-start">
                                <span class="fw-bold"><?php echo htmlspecialchars($comentario['id_usuario']); ?></span>
                                <small class="text-muted"><?php echo $comentario['fecha']; ?></small>
                            </div>
                            <p class="mb-0"><?php echo nl2br(htmlspecialchars($comentario['contenido'])); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Agregar comentario -->
        <div class="row mt-4 justify-content-center">
            <div class="col-8">
                <form action="index.php?ctl=guardarComentario&id_pelicula=<?php echo $params['peliculas']['id_pelicula']; ?>" method="post">
                    <div class="mb-3">
                        <label for="comentario" class="form-label fw-bold text-dark">Deja tu comentario:</label>
                        <textarea id="comentario" name="comentario" rows="4" class="form-control" placeholder="Escribe tu comentario aquí..."></textarea>
                    </div>
                    <div class="row justify-content-space-around text-center">
                        <div class="col">
                            <button type="submit" class="btn btn-primary px-4">Añadir comentario</button>
                        </div>
                        <div class="col">
                            <button type="reset" class="btn btn-danger px-4">Borrar comentario</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $contenido = ob_get_clean(); ?>
<?php include 'layout.php' ?>