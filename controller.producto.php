<?php

include_once 'model.producto.php';

class ControllerProductos{

    function getAll(){
        
        $producto = new Producto();
        $productos = array();
        $productos = array();
        
        $res = $producto->obtenerProductos();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "precio" => $row['precio'],
                    "descripcion" => $row['descripcion'],
                    "referencia" => $row['referencia'],
                );
                array_push($productos, $item);
            }
        
            echo json_encode($productos);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }

    function getById($id){
        $producto = new Producto();
        $productos = array();

        $res = $producto->obtenerProducto($id);

        if($res->rowCount() == 1){
            $row = $res->fetch();
        
            $item=array(
                "id" => $row['id'],
                "nombre" => $row['nombre'],
                "precio" => $row['precio'],
                "descripcion" => $row['descripcion'],
                "referencia" => $row['referencia'],
            );
            array_push($productos, $item);
            echo json_encode($productos);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }

    function add($item){
        $producto = new Producto();
        $producto->nuevoProducto($item);
        echo json_encode(array('mensaje' => 'Nuevo producto registrado'));
    }

    function update($item){
        $producto = new Producto();
        $producto->actualizarProducto($item);
        echo json_encode(array('mensaje' => 'Producto actualizado'));
    }

    function delete($item){
        $producto = new Producto();
        $producto->eliminarProducto($item);
        echo json_encode(array('mensaje' => 'Producto eliminado'));
    }


    function error($mensaje){
        echo  json_encode(array('mensaje' => $mensaje)); 
    }
}

?>