<?php

class Token extends Modelo {
    public function insertarToken($token, $idUsuario){ //inserta el token asociado al usuario
        $consulta = "INSERT INTO peliculas.token_validacion(id_usuario, token, valido_hasta) VALUES(:idUsuario, :token, NOW())";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUsuario', $idUsuario);
        $result->bindParam(':token', $token);
        return $result->execute();
    }

    public function verificarToken($token){
        $consulta = "SELECT id_usuario FROM peliculas.token_validacion WHERE token=:token";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':token', $token);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);   
    }

    public function eliminarToken($token){
        $consulta = "DELETE FROM peliculas.token_validacion WHERE token=:token";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':token', $token);
        return $result->execute();
    }
}
?>