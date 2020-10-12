<?php
    include_once 'controller.producto.php';

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $api = new ControllerProductos();

    // Obtener los datos publicados
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata))
    {
  
        // Extraer los datos.
        $request = json_decode($postdata, true);
    
        $accion = $request['accion'];

        if($accion == "crear"){
            $api->add($request);
        }else if($accion == "actualizar"){
            $api->update($request);
        }else if($accion == "eliminar"){
                $api->delete($request);
        }else{
            
            $api->error('Proceso no permitido. Accion: '. $accion);
        }
       

    }else if(isset($_GET['id'])){
        $id = $_GET['id'];

        if(is_numeric($id)){
            $api->getById($id);
        }else{
            $api->error('El id es incorrecto');
        }
    }else{
        $api->getAll();
    }
    
?>