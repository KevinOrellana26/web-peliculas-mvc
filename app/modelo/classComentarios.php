<?php
class Comentario extends Modelo
{
    public function agregarComentario($idPelicula, $idUsuario, $contenido) //Inserta un comentario a un id asociado
    {
        $consulta = "INSERT INTO peliculas.comentarios (id_pelicula, id_usuario, contenido, fecha) VALUES (:id_pelicula, :id_usuario, :contenido, NOW())";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id_pelicula', $idPelicula, PDO::PARAM_INT);
        $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $result->bindParam(':contenido', $contenido, PDO::PARAM_STR);
        $result->execute();
        return $result;
    }

    public function eliminarComentario($idComentario)
    {
        $consulta = "DELETE FROM peliculas.comentarios  WHERE id_comentario = :id";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $idComentario, PDO::PARAM_INT);
        $result->execute();
        return $result;
    }
}
