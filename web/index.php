<?php
require_once __DIR__ . '/../app/libs/Config.php';
require_once __DIR__ . '/../app/libs/bGeneral.php';
require_once __DIR__ . '/../app/libs/bSeguridad.php';
require_once __DIR__ . '/../app/modelo/classModelo.php';
require_once __DIR__ . '/../app/modelo/classComentarios.php';
require_once __DIR__ . '/../app/modelo/classPelicula.php';
require_once __DIR__ . '/../app/modelo/classUsuario.php';
require_once __DIR__ . '/../app/controlador/Controller.php';
require_once __DIR__ . '/../app/controlador/UsuarioController.php';
require_once __DIR__ . '/../app/controlador/PeliculasController.php';
require_once __DIR__ . '/../app/controlador/ComentarioController.php';

//inicio de sesion
session_start();
//siempre el usuario tendrá por defecto el nivel de invitado
if (!isset($_SESSION['nivel_usuario'])) {
    $_SESSION['nivel_usuario'] = 0;
}

/**
 * Enrutamiento
 * Le añadimos el nivel mínimo que tiene que tener el usuario para ejecutar la acción
 **/
$map = array(
    //acciones que pueden realizar personas autenticadas o no
    'home' => array('controller' => 'Controller', 'action' => 'home', 'nivel_usuario' => 0),
    'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'nivel_usuario' => 0),
    'salir' => array('controller' => 'Controller', 'action' => 'salir', 'nivel_usuario' => 1),
    'error' => array('controller' => 'Controller', 'action' => 'error', 'nivel_usuario' => 0),

    //acciones de usuarios (autenticados o no)
    'registro' => array('controller' => 'UsuarioController', 'action' => 'registro', 'nivel_usuario' => 0),
    'iniciarSesion' => array('controller' => 'UsuarioController', 'action' => 'iniciarSesion', 'nivel_usuario' => 0),

    //acciones de peliculas
    'mostrarPeliculas' => array('controller' => 'PeliculasController', 'action' => 'mostrarPeliculas', 'nivel_usuario' => 0),
    'verPelicula' => array('controller' => 'PeliculasController', 'action' => 'verPelicula', 'nivel_usuario' => 0),

    //acciones de comentarios
    'guardarComentario' => array('controller' => 'ComentarioController', 'action' => 'guardarComentario', 'nivel_usuario' => 1),
);

//Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {
        //Si el valor puesto en el ctl en la URL no existe en el array de mapeo envía una cabecera de error
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' . $_GET['ctl'] . '</i></h1></body></html>';
        exit;
        /*
            * También podríamos poner $ruta=error; y mostraríamos una pantalla de error
            */
    }
} else {
    $ruta = 'home';
}
$controlador = $map[$ruta];

/* 
    Comprobamos si el metodo correspondiente a la acción relacionada con el valor de ctl existe, 
    si es así ejecutamos el método correspondiente.
    En caso de no existir cabecera de error.
    En caso de estar utilizando sesiones y permisos en las diferentes acciones comprobariamos tambien 
    si el usuario tiene permiso suficiente para ejecutar esa acción
    */

if (method_exists($controlador['controller'], $controlador['action'])) { //si existe el metodo (action) en la clase Controller
    if ($controlador['nivel_usuario'] <= $_SESSION['nivel_usuario']) { //comprobamos que el nivel_usuario de ese array no sea menor al nivel_usuario de sesion
        //realizar llamadas dinámicas cuando los nombres de la clase y el método se determinan en tiempo de ejecución.
        //instancia un objeto de un Controlador y invoca al método
        call_user_func(array(new $controlador['controller'], $controlador['action']));
    } else {
        call_user_func(array(new $controlador['controller'], 'inicio')); //metodo inicio
    }
} else { // Si no existe el metodo/accion en el Controlador
    header('Status: 404 Not Found');
    echo "<html><body><h1>Error 404: El controlador <i>" . $controlador['controller'] . " -> " . $controlador['action'] . " no existe</i></h1></body></html>";
    console_log("entrarErrorInicio");
}
