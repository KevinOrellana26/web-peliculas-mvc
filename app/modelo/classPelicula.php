<?php
class Pelicula extends Modelo
{

    public function listarPeliculas() //Devuelve todas las peliculas
    {
        $consulta = "SELECT * FROM peliculas.peliculas ORDER BY titulo ASC";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verPelicula($idPelicula) //Devuelve la pelicula en especifico que queremos
    {
        $consulta = "SELECT * FROM peliculas.peliculas WHERE id_pelicula=:idPelicula";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idPelicula', $idPelicula);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPeliculaTitulo($titulo) // Busca pelicula dependiendo del titulo y da una aproximacion al titulo introducido
    {
        $consulta = "SELECT * FROM peliculas.peliculas WHERE titulo like :titulo;";

        $result = $this->conexion->prepare($consulta);
        $titulo = "%" . $titulo . "%";
        $result->bindParam(':titulo', $titulo);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPeliculaAnio($anio)
    {
        $consulta = "SELECT * FROM peliculas.peliculas WHERE anio=:anio";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':anio', $anio);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPeliculaCategoria($categoria)
    {
        $consulta = "SELECT * FROM peliculas.peliculas WHERE categoria COLLATE utf8_general_ci =:categoria;";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':categoria', $categoria);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }



    public function insertarLibro($titulo, $descripcion, $anio, $portada, $categoria)
    {
        $consulta = "INSERT INTO biblioteca.listaLibros (titulo, descripcion, anio, portada, categoria ) VALUES (:titulo, :descripcion, :anio, :portada, :categoria)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':titulo', $titulo);
        $result->bindParam(':descripcion', $descripcion);
        $result->bindParam(':anio', $anio);
        $result->bindParam(':portada', $portada);
        $result->bindParam(':categoria', $categoria);
        $result->execute();
        return $result;
    }

    public function eliminarLibro($id)
    {
        $consulta = "DELETE FROM biblioteca.listaLibros WHERE id = :id";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result;
    }

    public function modificarLibro($id, $titulo, $descripcion, $anio, $portada, $categoria)
    {
        $consulta = "UPDATE biblioteca.listaLibros 
                 SET titulo = :titulo, 
                     descripcion = :descripcion, 
                     anio = :anio, 
                     portada = :portada, 
                     categoria = :categoria 
                 WHERE id = :id";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':titulo', $titulo);
        $result->bindParam(':descripcion', $descripcion);
        $result->bindParam(':anio', $anio);
        $result->bindParam(':portada', $portada);
        $result->bindParam(':categoria', $categoria);
        $result->execute();
        return $result;
    }
}
