<?php

class ProductoModel extends Model{

    function __construct()
    {
        parent::__construct();
    }
    
    function obtenerProductos(){
        
        $query = $this->connect()->query('SELECT * FROM producto');
        return $query;
    }

    function obtenerProducto($id){
        $query = $this->connect()->prepare('SELECT * FROM producto WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query;
    }

    function nuevoProducto($producto){
        $query = $this->connect()->prepare('INSERT INTO producto (nombre, referencia, precio, descripcion, fecha_creacion) VALUES (:nombre, :referencia, :precio, :descripcion, :fecha_creacion)');
        $query->execute(
            [
                'nombre' => trim($producto['nombre']), 
                'referencia' => trim($producto['referencia']),
                'precio' => trim($producto['precio']),
                'descripcion' => trim($producto['descripcion']),
                'fecha_creacion' => date("Y-m-d")
            ]
        );
        return $query;
    }

    function actualizarProducto($producto){
        $query = $this->connect()->prepare('UPDATE producto SET nombre = :nombre, referencia = :referencia, precio = :precio, descripcion = :descripcion WHERE id = :id ');
        $res = $query->execute(
            [
                'nombre' => trim($producto['nombre']),
                'referencia' => trim($producto['referencia']),
                'descripcion' => trim($producto['descripcion']),
                'precio' => trim($producto['precio']),
                'id' => trim($producto['id'])
            ]
        );
        return $res;
    }

    function eliminarProducto($id){
        $query = $this->connect()->prepare('DELETE FROM producto WHERE id = :id');
        $res = $query->execute(['id' => trim($id)]);
        return $res;
    }

}

?>