<?php

class Config
{
    public static $mvc_bd_hostname = "localhost";
    public static $mvc_bd_nombre = "peliculas";
    public static $mvc_bd_usuario = "root";
    public static $mvc_bd_clave = "";
    public static $mvc_vis_css = "estilo.css";
    public static $vista = __DIR__ . '/web-peliculas-mvc/web/templates/inicio.php';
    public static $menu = __DIR__ . '/web-peliculas-mvc/web/templates/menuSesionGeneral.php';
    public static $menu2 = __DIR__ . '/web-peliculas-mvc/web/templates/menuAccionesInvitado.php';
}
