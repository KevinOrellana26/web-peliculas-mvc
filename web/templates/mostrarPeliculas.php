<?php ob_start();
if (isset($params['mensaje'])) {
    echo $params['mensaje'];
} ?>
<table>
    <tr>
        <th>
            <h4><b>Peliculas</b></h4><br>
        </th>
    </tr>

    <?php foreach ($params['peliculas'] as $pelicula) : ?>
        <tr>
            <td><a href="index.php?ctl=verPelicula&id_pelicula=<?php echo $pelicula['id_pelicula'] ?>" class="tablaP">
                    <?php echo $pelicula['titulo'] ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>