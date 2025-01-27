<?php
    require_once __DIR__ . '/../app/libs/Config.php';
    require_once __DIR__ . '/../app/libs/bGeneral.php';
    require_once __DIR__ . '/../app/libs/bSeguridad.php';
    require_once __DIR__ . '/../app/modelo/classModelo.php';
    require_once __DIR__ . '/../app/modelo/classComentarios.php';
    require_once __DIR__ . '/../app/modelo/classPelicula.php';
    require_once __DIR__ . '/../app/modelo/classUsuario.php';
    require_once __DIR__ . '/../app/controlador/Controller.php';


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
        'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'nivel_usuario' => 0),

        //acciones de usuarios (autenticados o no)
        'registrarse' => array('controller' => 'UsuarioController', 'action' => 'registrarse', 'nivel_usuario' => 0),
        'guardarUsuario' => array('controller' => 'UsuarioController', 'action' => 'guardarUsuario', 'nivel_usuario' => 0),
        'iniciarSesion' => array('controller' => 'UsuarioController', 'action' => 'iniciarSesion', 'nivel_usuario' => 0),
        'autenticar' => array('controller' => 'UsuarioController', 'action' => 'autenticar', 'nivel_usuario' => 0),
        'salir' => array('controller' => 'UsuarioController', 'action' => 'salir', 'nivel_usuario' => 1),
        'perfil' => array('controller' => 'UsuarioController', 'action' => 'perfil', 'nivel_usuario' => 1),
        'editarPerfil' => array('controller' => 'UsuarioController', 'action' => 'editarPerfil', 'nivel_usuario' => 1), 
        'listarUsuarios' => array('controller' => 'UsuarioController', 'action' => 'listarUsuarios', 'nivel_usuario' => 2),   
    
        //acciones para peliculas (autenticados o no)
        'listarPeliculas' => array('controller' => 'PeliculaController', 'action' => 'listarPeliculas', 'nivel_usuario' => 0),
        'buscarPorNombre' => array('controller' => 'PeliculaController', 'action' => 'buscarPorNombre', 'nivel_usuario' => 1),
        'buscarPorAnyio' => array('controller' => 'PeliculaController', 'action' => 'buscarPorAnyio', 'nivel_usuario' => 1),
        'agregarPelicula' => array('controller' => 'PeliculaController', 'action' => 'agregarPelicula', 'nivel_usuario' => 2),   
        // 'guardarPelicula' => array('controller' => 'PeliculaController', 'action' => 'guardarPelicula', 'nivel_usuario' => 2),   
        'editarPelicula' => array('controller' => 'PeliculaController', 'action' => 'editarPelicula', 'nivel_usuario' => 2),   
        'eliminarPelicula' => array('controller' => 'PeliculaController', 'action' => 'eliminarPelicula', 'nivel_usuario' => 2),   
    
        //acciones para los comentarios
        // 'listarComentarios' => array('controller' => 'ComentarioController', 'action' => 'listarComentarios', 'nivel_usuario' => 0), LO PUEDEN VER TODOS
        'agregarComentario' => array('controller' => 'ComentarioController', 'action' => 'agregarComentario', 'nivel_usuario' => 1),
        'eliminarComentario' => array('controller' => 'ComentarioController', 'action' => 'eliminarComentario', 'nivel_usuario' => 2),
    );

    //Parseo de la ruta
    if(isset($_GET['ctl'])){  
        if(isset($map[$_GET['ctl']])){
            $ruta = $_GET['ctl'];
        }else{
            //Si el valor puesto en el ctl en la URL no existe en el array de mapeo envía una cabecera de error
            header('Status: 404 Not Found');
            echo '<html><body><h1>Error 404: No existe la ruta <i>'.$_GET['ctl'].'</i></h1></body></html>';
            exit;
            /*
            * También podríamos poner $ruta=error; y mostraríamos una pantalla de error
            */
        }
    }else{
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

    if(method_exists($controlador['controller'], $controlador['action'])){ //si existe el metodo (action) en la clase Controller
        if($controlador['nivel_usuario'] <= $_SESSION['nivel_usuario']){ //comprobamos que el nivel_usuario de ese array no sea menor al nivel_usuario de sesion
            //realizar llamadas dinámicas cuando los nombres de la clase y el método se determinan en tiempo de ejecución.
            //instancia un objeto de un Controlador y invoca al método
            call_user_func(array(new $controlador['controller'], $controlador['action']));
        }else{
            call_user_func(array(new $controlador['controller'], 'inicio')); //metodo inicio
        }
    }else { // Si no existe el metodo/accion en el Controlador
        header('Status: 404 Not Found');
        echo "<html><body><h1>Error 404: El controlador <i>".$controlador['controller']." -> ".$controlador['action']." no existe</i></h1></body></html>";
        console_log("entrarErrorInicio");
    }
?>
