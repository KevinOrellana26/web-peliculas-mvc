<?php ob_start() ?>

<?php if (isset($params['mensaje'])) {
    echo $params['mensaje'];
}
if (count($params['peliculas']) > 0) : ?>

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <p></p>
            </div>

            <div class="col-md-4">
                <table border="1" cellpadding="10">
                    <tr align="center">
                        <th>Título</th>
                        <th>Año</th>
                        <th>Categoria</th>
                    </tr>
                    <?php foreach ($params['peliculas'] as $pelicula) : ?>
                        <tr align="center">
                            <td><a href="index.php?ctl=verPelicula&id_pelicula=<?php echo $pelicula['id_pelicula'] ?>"> <?php echo $pelicula['titulo']; ?></a></td>
                            <td><?php echo $pelicula['anio'] ?></td>
                            <td><?php echo $pelicula['categoria'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="col-md-4">
                <p></p>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>