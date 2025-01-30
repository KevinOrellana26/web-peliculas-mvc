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

        <!-- 1 fila, 2 columnas. En la primer columna irá el titulo y el valor. En la segunda columna la portada --> 

        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col text-end">
                        <p><b>Descripción:</b></p>
                    </div>
                    <div class="col text-start">
                        <p><?php echo $params['peliculas']['descripción']; ?></p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col text-end">
                        <p><b>Año:</b></p>
                    </div>
                    <div class="col text-start">
                        <p><?php echo $params['peliculas']['anio']; ?></p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col text-end">
                        <p><b>Categoría:</b></p>
                    </div>
                    <div class="col text-start">
                        <p><?php echo $params['peliculas']['categoria']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col text-center">
                <img src="img/<?php echo $params['peliculas']['portada']; ?>" alt="Portada" class="img-fluid rounded shadow" style="max-height: 300px;">
            </div>
        </div>

        <!-- Listar los comentarios asociados al id en cuestion -->
        <div class="row mt-4 justify-content-center">
            <div class="col-10">
                <?php if (isset($params['comentarios'])) : ?>
                    <ul class="list-group">
                        <?php foreach ($params['comentarios'] as $comentario) : ?>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between text-start">
                                    <span class="fw-bold"><?php echo htmlspecialchars($comentario['nombre_usuario']); ?></span>
                                    <small class="text-muted"><?php echo $comentario['fecha']; ?></small>
                                </div>
                                <p class="mb-0"><?php echo nl2br(htmlspecialchars($comentario['contenido'])); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <!-- Agregar comentario -->
        <div class="row mt-4 justify-content-center">
            <div class="col-10">
                <form action="index.php?ctl=guardarComentario" method="post">
                <!-- <form action="index.php?ctl=iniciarSesion" method="post"> -->
                    <div class="mb-3">
                        <input type="hidden" name="id_pelicula" value="<?php echo $params['peliculas']['id_pelicula']; ?>">
                        <label for="comentario" class="form-label fw-bold text-dark">Deja tu comentario:</label>
                        <textarea id="comentario" name="comentario" rows="4" class="form-control" placeholder="Escribe tu comentario aquí..."></textarea>
                    </div>
                    <div class="justify-content-center text-center">
                        <button type="submit" class="btn btn-primary px-4" name="bInsertarComentario">Añadir comentario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $contenido = ob_get_clean(); ?>
<?php include 'layout.php' ?>