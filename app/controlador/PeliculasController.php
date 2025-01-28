<?php
class PeliculasController extends Controller
{


    public function mostrarPeliculas()
    {
        try {
            $m = new Pelicula();
            $params = array(
                'peliculas' => $m->listarPeliculas(),
            );
            if (!$params['peliculas'])
                $params['mensaje'] = "No hay peliculas que mostrar.";
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        $menu = $this->cargaMenuSesiones();
        $menu2 = $this->cargaMenuAcciones();

        require __DIR__ . '/../../web/templates/mostrarPeliculas.php';
    }

    public function verPelicula()
    {
        try {
            if (!isset($_GET['id_pelicula'])) {
                $params['mensaje'] = 'No hay peliculas que mostrar.';
            }
            $idPelicula = recoge('id_pelicula');
            $m = new Pelicula();
            $params['peliculas'] = $m->verPelicula($idPelicula);
            //Obtenemos los comentarios relacionados con la pelicula
            $params['comentarios'] = $m->listarComentariosPorPelicula($idPelicula);
            
            if (!$params['peliculas']) {
                $params['mensaje'] = 'No hay peliculas que mostrar.';
            }elseif (!$params['comentarios']) {
                $params['mensaje'] = 'No hay comentarios aún';
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }

        $menu = $this->cargaMenuSesiones();
        $menu2 = $this->cargaMenuAcciones();

        require __DIR__ . '/../../web/templates/verPelicula.php';
    }
}
