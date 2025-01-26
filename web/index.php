<?php
    require_once __DIR__ . '/web-peliculas-mvc/app/libs/Config.php';
    require_once __DIR__ . '/web-peliculas-mvc/app/libs/bGeneral.php';
    require_once __DIR__ . '/web-peliculas-mvc/app/libs/bSeguridad.php';
    require_once __DIR__ . '/web-peliculas-mvc/app/modelo/classModelo.php';
    require_once __DIR__ . '/web-peliculas-mvc/app/modelo/classComentarios.php';
    require_once __DIR__ . '/web-peliculas-mvc/app/modelo/classPelicula.php';
    require_once __DIR__ . '/web-peliculas-mvc/app/modelo/classUsuarios.php';
    require_once __DIR__ . '/web-peliculas-mvc/app/controlador/Controller.php';

    //inicio de sesion
    session_start();
    //siempre el usuario tendrá por defecto el nivel de invitado
    if(!isset($_SESSION['nivel_usuario'])){
        $_SESSION['nivel_usuario'] = 0;
    }

    /**
    * Enrutamiento
    * Le añadimos el nivel mínimo que tiene que tener el usuario para ejecutar la acción
    **/
    $map = array(
        //acciones que pueden realizar personas autenticadas o no
        'home' => array('controller' => 'Controller', 'action' => 'home', 'nivel_usuario' => 0),

        //acciones de usuarios (autenticados o no)
        'registro' => array('controller' => 'UsuarioController', 'action' => 'registor', 'nivel_usuario' => 0),
        'guardarUsuario' => array('controller' => 'UsuarioController', 'action' => 'guardarUsuario', 'nivel_usuario' => 0),
        'login' => array('controller' => 'UsuarioController', 'action' => 'login', 'nivel_usuario' => 0),
        'autenticar' => array('controller' => 'UsuarioController', 'action' => 'autenticar', 'nivel_usuario' => 0),
        'logout' => array('controller' => 'UsuarioController', 'action' => 'logout', 'nivel_usuario' => 1),
        'perfil' => array('controller' => 'UsuarioController', 'action' => 'perfil', 'nivel_usuario' => 1),
        'editarPerfil' => array('controller' => 'UsuarioController', 'action' => 'editarPerfil', 'nivel_usuario' => 1), 
        'listarUsuarios' => array('controller' => 'UsuarioController', 'action' => 'listarUsuarios', 'nivel_usuario' => 2),   
    
        //acciones para peliculas (autenticados o no)
        'listarPeliculas' => array('controller' => 'PeliculaController', 'action' => 'listarPeliculas', 'nivel_usuario' => 0),
        'verPelicula' => array('controller' => 'PeliculaController', 'action' => 'verPelicula', 'nivel_usuario' => 0),
        'agregarPelicula' => array('controller' => 'PeliculaController', 'action' => 'agregarPelicula', 'nivel_usuario' => 2),   
        'guardarPelicula' => array('controller' => 'PeliculaController', 'action' => 'guardarPelicula', 'nivel_usuario' => 2),   
        'editarPelicula' => array('controller' => 'PeliculaController', 'action' => 'editarPelicula', 'nivel_usuario' => 2),   
        'eliminarPelicula' => array('controller' => 'PeliculaController', 'action' => 'eliminarPelicula', 'nivel_usuario' => 2),   
    
        //acciones para los comentarios
        'listarComentarios' => array('controller' => 'ComentarioController', 'action' => 'listarComentarios', 'nivel_usuario' => 0),
        'agregarComentario' => array('controller' => 'ComentarioController', 'action' => 'agregarComentario', 'nivel_usuario' => 1),
        'eliminarComentario' => array('controller' => 'ComentarioController', 'action' => 'eliminarComentario', 'nivel_usuario' => 1),
    )






?>
