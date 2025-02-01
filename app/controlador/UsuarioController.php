<?php

class UsuarioController extends Controller
{


    public function iniciarSesion()
    {
        try {
            $params = array(
                'nombreUsuario' => '',
                'contrasenya' => '',
                'tipografia' => '',
            );
            $menu = $this->cargaMenuSesiones();
            $menu2 =
                $this->cargaMenuAcciones();

            if ($_SESSION['nivel_usuario'] > 0) {
                header("location:index.php?ctl=inicio");
            }
            if (isset($_POST['bIniciarSesion'])) { // Nombre del boton del formulario
                $nombreUsuario = recoge('nombreUsuario');
                $contrasenya = recoge('contrasenya');

                // Comprobar campos formulario. Aqui va la validación con las funciones de bGeneral   
                if (cUser($nombreUsuario, "nombreUsuario", $params)) {
                    // Si no ha habido problema creo modelo y hago consulta                    
                    $m = new Usuario();
                    if ($usuario = $m->consultarUsuario($nombreUsuario)) {
                        // Compruebo si el password es correcto
                        if (comprobarhash($contrasenya, $usuario['contrasenya'])) {
                            // Obtenemos el resto de datos

                            $_SESSION['idUser'] = $usuario['id_usuario'];
                            $_SESSION['nombreUsuario'] = $usuario['nombre_usuario'];
                            $_SESSION['nivel_usuario'] = $usuario['nivel_usuario'];

                            $_SESSION['fotoPerfil'] = $m->buscarFotoPerfil($nombreUsuario);

                            header('Location: index.php?ctl=inicio');
                        }
                    } else {
                        $params = array(
                            'nombre_usuario' => $nombreUsuario,
                            'contrasenya' => $contrasenya,
                        );
                        $params['mensaje'] = 'No se ha podido iniciar sesión. Revisa el formulario.';
                    }
                } else {
                    $params = array(
                        'nombre_usuario' => $nombreUsuario,
                        'contrasenya' => $contrasenya
                    );
                    $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario.';
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/formInicioSesion.php';
    }


    public function registro()
    {
        $dir = "./img"; // Directorio donde se guardarán las fotos

        $max_file_size = 200000; // Tamaño máximo de archivo en bytes

        $extensionesValidas = ["gif", "jpeg", "jpg", "png"];

        $menu = $this->cargaMenuSesiones();
        $menu2 = $this->cargaMenuAcciones();

        if ($_SESSION['nivel_usuario'] > 0) {
            header("location:index.php?ctl=inicio");
        }

        $params = [
            'nombre' => '',
            'apellido' => '',
            'email' => '',
            'nombreUsuario' => '',
            'contrasenya' => '',
        ];


        $errores = [];

        if (isset($_POST['bRegistro'])) {
            $nombre = recoge('nombre');
            $apellido = recoge('apellido');
            $nombreUsuario = recoge('nombreUsuario');
            $email = recoge('email');
            $contrasenya = recoge('contrasenya');
            $confirmarContrasenya = recoge('contrasenya2');


            // Validación de los campos del formulario
            cTexto($nombre, "nombre", $errores);
            cTexto($apellido, "apellido", $errores);
            cUser($contrasenya, "contrasenya", $errores);
            cEmail($email, 'email', $errores);
            cUser($nombreUsuario, "nombreUsuario", $errores);

            // Comprobar si el nombre de usuario ya está registrado
            $m = new Usuario();
            if ($m->consultarUsuario($nombreUsuario)) {
                $errores["nombreUsuario"] = "El nombre de usuario ya está registrado.";
            }

            // Comprobar que las contraseñas coincidan
            if ($contrasenya !== $confirmarContrasenya) {
                $errores["contrasenya"] = "Las contraseñas no coinciden.";
            }

            // Procesar la foto de perfil
            if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['fotoPerfil']['name'];
                $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                $tamanoArchivo = $_FILES['fotoPerfil']['size'];

                if (!in_array($tipoArchivo, $extensionesValidas)) {
                    $errores['fotoPerfil'] = "La extensión del archivo no es válida. Solo se permiten: " . implode(", ", $extensionesValidas);
                }

                if ($tamanoArchivo > $max_file_size) {
                    $errores['fotoPerfil'] = "El archivo es demasiado grande. El tamaño máximo permitido es $max_file_size bytes.";
                }

                if (empty($errores)) {
                    // Generar un nombre único para el archivo
                    $nombreUnico = uniqid("perfil_", true) . ".$tipoArchivo";
                    $rutaDestino = "$dir/$nombreUnico";

                    if (!move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $rutaDestino)) {
                        $errores['fotoPerfil'] = "No se pudo guardar la foto de perfil en el servidor.";
                    } else {
                        $params['fotoPerfil'] = $nombreUnico; // Guardar el nombre del archivo en los parámetros
                    }
                }
            } else {
                $errores['fotoPerfil'] = "Error al subir la foto de perfil.";
            }

            if (empty($errores)) {
                // Si no ha habido problema creo modelo y hago inserción
                try {
                    $m = new Usuario();
                    if ($m->insertarUsuario($nombre, $apellido, $nombreUsuario, encriptar($contrasenya), $params['fotoPerfil'], $email)) {
                        //header('Location: index.php?ctl=iniciarSesion'); //redirigimos a enviarCorreo.php?idUsuario=<idusuario>
                        $idUsuario=$m->ultimoId(); //obtememos el último id insertado en la tabla
                        $token=bin2hex(openssl_random_pseudo_bytes(16));

                        //Insertar el token en la BBDD
                        $mToken = new Token();
                        $mToken->insertarToken($token, $idUsuario);

                        $urlVerificacion = "http://localhost/DWES/unidad_8_mvc/MVC/web-peliculas-mvc/web/templates/enviarCorreo.php?token=" . urlencode($token) . "&email=" . urlencode($email) . "&nombre=" . urlencode($nombre);
                        header("Location: ".$urlVerificacion);
                        exit();
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
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'email' => $email,
                    'nombreUsuario' => $nombreUsuario,
                    'contrasenya' => $contrasenya,
                );
                $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario.';
            }
        }

        require __DIR__ . '/../../web/templates/formRegistro.php';
    }

    public function verificarCorreo() {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            
            // Buscar el token en la base de datos (puedes usar el modelo Token para esto)
            $mToken = new Token();
            $usuarioId = $mToken->verificarToken($token);  // Este método podría retornar el ID del usuario asociado al token
            
            if ($usuarioId) {
                // Si se encuentra el token, activar la cuenta del usuario
                $mUsuario = new Usuario();
                $mUsuario->activarUsuario($usuarioId);  // Aquí deberías tener un método para activar al usuario
                
                // Mensaje de éxito y redirigir
                $params['mensaje'] = 'Cuenta activada con éxito. Ya puedes iniciar sesión.';
                header("Location: index.php?ctl=iniciarSesion");
                exit();
            } else {
                // Si no se encuentra el token, mostrar un error
                $params['mensaje'] = 'Token inválido o expirado.';
            }
        } else {
            $params['mensaje'] = 'No se recibió el token de verificación.';
        }
    }
}
