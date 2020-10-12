<?php

class ProductoController extends Controller{

    function __construct()
    {
        parent::__construct();
        $this->loadModel("producto");
    }

    function listarProductos(){
        
        $productos = array();
        
        $res = $this->model->obtenerProductos();
        
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
           
            $this->response(true,"",$productos, 200);
        }else{
            $this->response(true,"No hay elementos", null, 404);
        }
    }

    function obtenerProducto($id){
       
        $productos = array();

        $res = $this->model->obtenerProducto($id);

        if($res->rowCount() == 1){
            $row = $res->fetch();
        
            $item= array(
                "id" => $row['id'],
                "nombre" => $row['nombre'],
                "precio" => $row['precio'],
                "descripcion" => $row['descripcion'],
                "referencia" => $row['referencia'],
            );
            $productos[] = $item;
       
            $this->response(true,"",$productos, 200);
        }else{
            $this->response(true,"No hay elementos", null, 404);
        }
    }

    function crearProducto($item){
        $this->model->nuevoProducto($item);
        $this->response(true,"Nuevo producto registrado");
    }

    function actualizarProducto($item){
        $this->model->actualizarProducto($item);
        $this->response(true,"Producto actualizado");
    }

    function eliminarProducto($id){
        $this->model->eliminarProducto($id);
        $this->response(true,"Producto eliminado");
    }

}

?>