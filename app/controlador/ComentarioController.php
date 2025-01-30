<?php
class ComentarioController extends Controller
{
    public function guardarComentario()
    {
        try {
            if (!isset($_SESSION['nivel_usuario'])) { //si no está logueado, se redirige a iniciarSesion
                return header('Location: index.php?ctl=iniciarSesion');
            }

            $params = array(
                'comentario' => ''
            );
            $errores = array();
            if (isset($_POST['bInsertarComentario'])) {
                $comentario = recoge('comentario');
                $idPelicula = $_POST['id_pelicula'] ?? null; //comprobar que existe
                $idUsuario = $_SESSION['idUser'] ?? null; //comprobar que existe 

                if (!$idPelicula || !$idUsuario) { //Si el idPelicula ó idUsuario no están definidos
                    header('Location: index.php?ctl=error');
                    exit(); //para que el código no siga ejecutandose. siempre despues de un header
                }

                //comprobar campos formulario.
                cDescripcion($comentario, "comentario", $errores);

                if (empty($errores)) {
                    //si no ha habido problema, creo el modelo y hago inserción
                    $m = new Comentario();
                    if ($m->agregarComentario($idPelicula, $idUsuario, $comentario)) {
                        header("Location: index.php?ctl=verPelicula&id_pelicula=$idPelicula");
                        exit();
                    } else {
                        $params = array(
                            'comentario' => $comentario
                        );
                        $params['mensaje'] = "Ha habido un error al insertar el comentario.";
                    }
                } else {
                    $params = array(
                        'comentario' => $comentario
                    );
                    $params['mensaje'] = "Hay datos incorrectos.";
                }
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

    public function eliminarComentario()
    {
        try {
            if (!isset($_SESSION['nivel_usuario'])) { //si no está logueado, se redirige a iniciarSesion
                return header('Location: index.php?ctl=iniciarSesion');
            }

            $params = array(
                'idComentario' => ''
            );
            $errores = array();
            if (isset($_POST['bEliminarCom'])) {
                $comentario = recoge('id_comentario');
                $idPelicula = recoge('id_pelicula');

                if (empty($errores)) {
                    //si no ha habido problema, creo el modelo y hago inserción
                    $m = new Comentario();
                    if ($m->eliminarComentario($comentario)) {
                        header("Location: index.php?ctl=verPelicula&id_pelicula=$idPelicula");
                        exit();
                    } else {
                        $params = array(
                            'comentario' => $comentario
                        );
                        $params['mensaje'] = "Ha habido un error al insertar el comentario.";
                    }
                } else {
                    $params = array(
                        'comentario' => $comentario
                    );
                    $params['mensaje'] = "Hay datos incorrectos.";
                }
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

        require __DIR__ . '/../../web/templates/verPeliculaAdmin.php';
    }
}
