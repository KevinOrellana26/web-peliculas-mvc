<?php
class Controller
{

    protected function cargaMenuAcciones() //Metodo de carga de del menu dependiendo del nivel de usuario
    {
        if ($_SESSION['nivel_usuario'] == 0) {
            return 'menuAccionesInvitado.php';
        } else if ($_SESSION['nivel_usuario'] == 1) {
            return 'menuAccionesUser.php';
        } else if ($_SESSION['nivel_usuario'] == 2) {
            return 'menuAccionesAdmin.php';
        }
    }
    protected function cargaMenuSesiones() //Metodo de carga de del menu dependiendo del nivel de usuario
    {
        if ($_SESSION['nivel_usuario'] == 0) {
            return 'menuSesionGeneral.php';
        } else if ($_SESSION['nivel_usuario'] >= 1) {
            return 'menuSesionUser.php';
        }
    }


    public function home()  //Carga del Home
    {

        $params = array(
            'mensaje' => 'Bienvenido a tu foro de peliculas de confianza',
            'mensaje2' => 'Aqui tendras una gran cantidad de peliculas y comentarios de otros usuarios',
        );
        $menu = 'menuSesionGeneral.php';
        $menu2 = 'menuAccionesInvitado.php';
        if ($_SESSION['nivel_usuario'] > 0) {
            header("location:index.php?ctl=inicio");
        }
        require __DIR__ . '/../../web/templates/inicio.php';
    }
    public function inicio()
    {


        $params = array(
            'mensaje' => 'Bienvenido a tu foro de peliculas de confianza',
            'mensaje2' => 'Aqui tendras una gran cantidad de peliculas y comentarios de otros usuarios',
        );
        $menu = $this->cargaMenuSesiones();
        $menu2 =
            $this->cargaMenuAcciones();

        require __DIR__ . '/../../web/templates/inicio.php';
    }

    public function salir()
    {
        session_destroy();

        header("location:index.php?ctl=home");
    }

    public function error()
    {

        $menu = $this->cargaMenuSesiones();
        $menu2 =
            $this->cargaMenuAcciones();

        require __DIR__ . '/../../web/templates/error.php';
    }
}
