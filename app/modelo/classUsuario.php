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

    public function insertarUsuario($nombre, $apellido, $nombreUsuario, $contrasenya, $fotoPerfil = "default.jpg", $email)
    {
        $consulta = "INSERT INTO peliculas.usuarios (nombre, apellido, nombre_usuario, contrasenya, foto_perfil, email) VALUES (:nombre, :apellido, :nombreUsuario, :contrasenya, :fotoPerfil, :email)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $nombre);
        $result->bindParam(':apellido', $apellido);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->bindParam(':contrasenya', $contrasenya);
        $result->bindParam(':fotoPerfil', $fotoPerfil);
        $result->bindParam(':email', $email);
        $result->execute();
        return $result;
    }
    public function buscarFotoPerfil($nombreUsuario)
    {
        $consulta = "SELECT foto_perfil FROM peliculas.usuarios WHERE nombre_usuario = :nombreUsuario";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombreUsuario', $nombreUsuario);
        $result->execute();
        return $result->fetchColumn(); // Devuelve solo el valor de la columna 'foto_perfil'
    }

    public function ultimoId(){
        return $this->conexion->lastInsertId(); //metodo para sacar el último ID insertado en la base de datos
    }

    public function activarCuenta($idUsuario){
        $consulta = "UPDATE usuarios SET validado = 1 WHERE id_usuario=:idUsuario";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUsuario', $idUsuario);
        return $result->execute(); //devuelve true si la actualización fue exitosa
    }
}
