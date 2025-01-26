<?php
class Usuario extends Modelo
{
    public function consultarUsuario($nombreUsuario)
    {
        $consulta = "SELECT * FROM peliculas.usuarios WHERE nombre_usuario=:nombreUsuario ";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function insertarUsuario($nombre, $apellido, $nombreUsuario, $contrasenya, $fotoPerfil = "default.jpg",)
    {
        $consulta = "INSERT INTO peliculas.usuarios (nombre, apellido, nombre_usuario, contrasenya, foto_perfil) VALUES (:nombre, :apellido, :nombreUsuario, :contrasenya, :fotoPerfil)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $nombre);
        $result->bindParam(':apellido', $apellido);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->bindParam(':contrasenya', $contrasenya);
        $result->bindParam(':fotoPerfil', $fotoPerfil);
        $result->execute();
        return $result;
    }
}
