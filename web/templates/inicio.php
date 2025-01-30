<?php ob_start() ?>

<h2 class="text-center pb-2"><b>Accediste como: <?php echo isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario'] : 'Invitado'; ?></b></h2>


<?php

switch ($_SESSION['nivel_usuario']) {
    case 1:
        echo '<h2 class="text-center pb-2"> <b> Accediste como: Usuario  </b> </h2>';
        break;
    case 2:
        echo '<h2 class="text-center pb-2"> <b> Accediste como: Administrador  </b> </h2>';
        break;
}

?>

<h3 class="text-center"><b><?php echo $params['mensaje'] ?></b></h3><br>

<h4 class="text-center"><?php echo $params['mensaje2'] ?></h4><br>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>