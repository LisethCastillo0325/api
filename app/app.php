<?php
class App {

    function __construct()
    {
        $url = $_REQUEST['url'];
        $url = rtrim($url, "/");
        $url = explode('/', $url);
        $nombreController  = $url[0].'.controller';
        $archivoController = 'app/controllers/'.$nombreController.'.php';

        if(! file_exists($archivoController) ){
            $controller = new Controller();
            $controller->response(false, "recurso no encontrado [$nombreController]", null, 404);
        }else{
            require_once($archivoController);
            $nombreController = str_replace(" ", "", ucwords(str_replace(".", " ", $nombreController)));
            $nombreFunction   = lcfirst(str_replace(" ", "", ucwords(str_replace("-"," ", $url[1]))));
            $controller       = new $nombreController();
            
            if(! method_exists($controller, $nombreFunction)){
                $controller->response(false, "recurso no encontrado [$nombreFunction]", null, 404);
            }else{
                
                // Obtener los datos publicados
                $postdata = file_get_contents("php://input");
                
                if(isset($postdata) && !empty($postdata))
                {
                    // Extraer los datos.
                    $request = json_decode($postdata, true);
                    $controller->$nombreFunction($request);

                } else if(isset($url[2])){
                    $id = $url[2];
                    if(is_numeric($id)){
                        $controller->$nombreFunction($id);
                    }else{
                        $controller->response(false, "El id es incorrecto [$id]", null, 404);
                    }
                }else{
                    $controller->$nombreFunction(null);
                }
            }
        }
    }
}

?>