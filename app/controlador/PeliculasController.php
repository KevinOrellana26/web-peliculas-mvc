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
            if (!$params['peliculas']) {
                $params['mensaje'] = 'No hay peliculas que mostrar.';
            }
            //Obtenemos los comentarios relacionados con la pelicula
            $params['comentarios'] = $m->listarComentariosPorPelicula($idPelicula);

            if (!$params['peliculas']) {
                $params['mensaje'] = 'No hay peliculas que mostrar.';
            } elseif (!$params['comentarios']) {
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
        $menu2 =
            $this->cargaMenuAcciones();

        if ($_SESSION['nivel_usuario'] == 2) {
            require __DIR__ . '/../../web/templates/verPeliculaAdmin.php';
        } else {
            require __DIR__ . '/../../web/templates/verPelicula.php';
        }
    }

    public function buscarPorTitulo()
    {
        try {
            $params = array(
                'titulo' => '',
                'resultado' => array(),
                'peliculas' => array()
            );
            $m = new Pelicula();
            if (isset($_POST['buscarPorTitulo'])) {
                $titulo = recoge("buscar");
                $params['titulo'] = $titulo;
                $params['peliculas'] = $m->buscarPeliculaTitulo($titulo);
                if (!$params['peliculas']) {
                    $params['mensaje'] = 'No hay peliculas que mostrar.';
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
        $menu2 =
            $this->cargaMenuAcciones();

        require __DIR__ . '/../../web/templates/buscarPorTitulo.php';
    }


    public function busquedaCombinada()
    {
        try {
            $params = array(
                'anio' => '',
                'categoria' => '',
                'peliculas' => array()
            );
            $m = new Pelicula();
            if (isset($_POST['bCombinada'])) {
                $anio = recoge("anio");
                $categoria = recoge("categoria");
                $params['anio'] = $anio;
                $params['categoria'] = $categoria;

                if (!empty($anio) && !empty($categoria)) {
                    $params['peliculas'] = $m->buscarPeliculasPorAnioYCategoria($categoria, $anio);
                } elseif (!empty($anio)) {
                    $params['peliculas'] = $m->buscarPeliculaAnio($anio);
                } elseif (!empty($categoria)) {
                    $params['peliculas'] = $m->buscarPeliculaCategoria($categoria);
                } else {
                    $params['mensaje'] = "Debe ingresar al menos un criterio de búsqueda.";
                    $params['peliculas'] = [];
                }

                if (!$params['peliculas']) {
                    $params['mensaje'] = 'No hay peliculas que mostrar.';
                }

                // Cargar la plantilla de resultados
                $menu = $this->cargaMenuSesiones();
                $menu2 = $this->cargaMenuAcciones();
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

        require __DIR__ . '/../../web/templates/busquedaCombinada.php';
    }

    public function insertarPelicula()
    {
        try {
            $params = array(
                'titulo' => '',
                'descripcion' => '',
                'anio' => '',
                'categoria' => ''
            );

            $dir = "./img"; // Directorio donde se guardarán las fotos

            $max_file_size = 300000; // Tamaño máximo de archivo en bytes

            $extensionesValidas = ["gif", "jpeg", "jpg", "png"];

            $errores = array();
            if (isset($_POST['bInsertarP'])) {
                $titulo = recoge('titulo');
                $descripcion = recoge('descripcion');
                $anio = recoge('anio');
                $categoria = recoge('categoria');

                // Comprobar campos formulario. Aqui va la validación con las funciones de bGeneral
                cDescripcion($titulo, "titulo", $errores);
                cDescripcion($descripcion, "descripcion", $errores);
                cNum($anio, "anio", $errores);
                cTexto($categoria, "categoria", $errores);

                // Procesar portada
                if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
                    $nombreArchivo = $_FILES['portada']['name'];
                    $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                    $tamanoArchivo = $_FILES['portada']['size'];

                    if (!in_array($tipoArchivo, $extensionesValidas)) {
                        $errores['portada'] = "La extensión del archivo no es válida. Solo se permiten: " . implode(", ", $extensionesValidas);
                    }

                    if ($tamanoArchivo > $max_file_size) {
                        $errores['portada'] = "El archivo es demasiado grande. El tamaño máximo permitido es $max_file_size bytes.";
                    }

                    if (empty($errores)) {
                        // Generar un nombre único para el archivo
                        $nombreUnico = uniqid("portada_", true) . ".$tipoArchivo";
                        $rutaDestino = "$dir/$nombreUnico";

                        if (!move_uploaded_file($_FILES['portada']['tmp_name'], $rutaDestino)) {
                            $errores['portada'] = "No se pudo guardar la portada en el servidor.";
                        } else {
                            $params['portada'] = $nombreUnico; // Guardar el nombre del archivo en los parámetros
                        }
                    }
                } else {
                    $errores['portada'] = "Error al subir la portada.";
                }

                if (empty($errores)) {
                    // Si no ha habido problema creo modelo y hago inserción
                    try {
                        $m = new Pelicula();
                        if ($m->insertarPelicula($titulo, $descripcion, $anio, $params['portada'], $categoria)) {
                            header('Location: index.php?ctl=mostrarPeliculas');
                        } else {
                            $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario.';
                        }
                    } catch (Exception $e) {
                        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
                        header('Location: index.php?ctl=error');
                    } catch (Error $e) {
                        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
                        header('Location: index.php?ctl=error');
                    }
                } else {
                    $params = array(
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'anio' => $anio,
                        'categoria' => $categoria
                    );
                    $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario';
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
        $menu2 =
            $this->cargaMenuAcciones();

        require __DIR__ . '/../../web/templates/formInsertarP.php';
    }

    public function eliminarPelicula()
    {
        try {
            if (!isset($_SESSION['nivel_usuario'])) { //si no está logueado, se redirige a iniciarSesion
                return header('Location: index.php?ctl=iniciarSesion');
            }

            $params = array(
                'idPelicula' => '',
                'pelicula' => array()
            );
            $errores = array();
            if (isset($_POST['bEliminarPelicula'])) {
                $idPelicula = recoge('id_pelicula');
                $portada = recoge('portada');
                if (empty($errores)) {
                    // Si no ha habido problema, creo el modelo y hago la inserción
                    $m = new Pelicula();
                    $params['pelicula'] = $m->verPelicula($idPelicula);

                    if ($params['pelicula']) { // Si la película existe
                        // Eliminar el archivo de portada si existe
                        $rutaPortada = './img/' . $portada; // Ruta completa del archivo de la portada
                        if (file_exists($rutaPortada)) {
                            unlink($rutaPortada); // Eliminar archivo físico
                        } else {
                            $params['mensaje'] = "La portada no se encuentra en el servidor.";
                        }

                        // Ahora eliminamos la película de la base de datos
                        if ($m->eliminarPelicula($idPelicula)) {
                            header("Location: index.php?ctl=mostrarPeliculas");
                            exit();
                        } else {
                            $params['mensaje'] = "Ha habido un error en la eliminación de la película.";
                        }
                    } else {
                        $params['mensaje'] = "No se pudo realizar la acción, la portada no coincide.";
                    }
                } else {
                    $params['mensaje'] = "No se pudo realizar la acción.";
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
