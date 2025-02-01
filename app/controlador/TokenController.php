<?php
class TokenController extends Controller
{
    public function verificarToken() {
        try {
            if(!isset($_GET['token'])){
                $params['mensaje'] = "No se proporcionó un token";
            }else{
                $token = recoge('token');
                $m = new Token();
                $usuario = $m->verificarToken($token);
                
                if(!$usuario){ //Si el token no existe en la tabla
                    $params['mensaje'] = "El token no es válido o la cuenta ya está activada.";
                }else{ //Si el token existe
                    $mUsuario = new Usuario();
                    if($mUsuario->activarCuenta($usuario['id_usuario'])){ //activamos la cuenta
                        $m->eliminarToken($token); //eliminamos el token de la tabla
                        $params['mensaje'] = "Cuenta activada correctamente";
                    }else{
                        $params['mensaje'] = "Hubo un problema al activar la cuenta.";
                    }
                }
            }
        }catch(Exception $e){
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        }catch(Error $e){
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../app/log/logExceptio.txt");
            header('Location: index.php?ctl=error');
        }

        $menu = $this->cargaMenuSesiones();
        $menu2 = $this->cargaMenuAcciones();

        require __DIR__ . '/../../web/templates/formInicioSesion.php';
    } 
}
?>
