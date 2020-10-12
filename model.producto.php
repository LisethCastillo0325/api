<?php

include_once 'db.php';

class Producto extends DB{
    
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
                'nombre' => $producto['nombre'], 
                'referencia' => $producto['referencia'],
                'precio' => $producto['precio'],
                'descripcion' => $producto['descripcion'],
                'fecha_creacion' => date("Y-m-d")
            ]
        );
        return $query;
    }

    function actualizarProducto($producto){
        $query = $this->connect()->prepare('UPDATE producto SET nombre = :nombre, referencia = :referencia, precio = :precio, descripcion = :descripcion WHERE id = :id ');
        $res = $query->execute(
            [
                'nombre' => $producto['nombre'], 
                'referencia' => $producto['referencia'],
                'descripcion' => $producto['descripcion'],
                'precio' => $producto['precio'],
                'id' => $producto['id']
            ]
        );
        return $res;
    }

    function eliminarProducto($item){
        $query = $this->connect()->prepare('DELETE FROM producto WHERE id = :id');
        $res = $query->execute(['id' => $item['id']]);
        return $res;
    }

}

?>