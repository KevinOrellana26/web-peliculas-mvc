<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
    <link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>">
    <!-- De la clase Config, nos traemos el valor del parametro publico $mvc_vis_css que es el nombre del fichero .css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- HEADER -->
    <div class="container-fluid bg-dark text-white">
        <div class="row p-2">
            <div class="col text-center">
                <h1>PELICULAS</h1>
            </div>
            <div class="col-6 text-center p-2">
              <form action="">
                <label for="buscar"></label>
                <input type="search" id="buscar" name="buscar" placeholder="Buscar Pelicula">
                <input type="submit">
              </form>
            </div>
            <div class="col text-center p-2">
                <!-- <a href="index.php?ctl=iniciarSesion">Iniciar Sesión</a> / <a href="index.php?ctl=registrarse">Registrarse</a> -->
                <?php
                    if(!isset($menu)){ //si la variable $menu no ha sido definida antes o el valor es null, se muestra el 'menuInvitado.php'
                        $menu = 'menuInvitado.php';
                    }
                    include $menu; //si está definida y tiene valor, se incluye en esta página el valor del $menu
                ?>
            </div>
        </div>
    </div>

    <!-- CONTENEDOR DINÁMICO (DONDE SE MOSTRARÁN LAS VISTAS) -->
    <div class="container-fluid">
        <div class="container">
            <div id=contenido>
                <?php echo $contenido ?> <!-- $contenido = ob_get_clean() en esta variable esta toda la vista porque se almaceno en el buffer -->
            </div>
        </div>
    </div>
    
    <!-- FOOTER -->
    <footer class="container-fluid bg-dark text-white mt-5">
        <div class="row pt-4">
            <div class="col-md6 text-center">
                <p>&copy; <?php echo date('Y'); ?> Peliculas - Todos los derechos reservados</p>
            </div>
        </div>
        <div class="row pb-3">
            <div class="col-md6 text-center">
                <p>Desarrollado por Joan y Kevin</p>
            </div>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>