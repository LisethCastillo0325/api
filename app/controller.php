<?php
class Controller {

    public $model;

    function __construct()
    {
        
    }

    function loadModel($model){
        $url = "app/models/$model.model.php";
        if(file_exists($url)){
            require $url;

            $modelName = ucwords($model)."Model";
            $this->model = new $modelName();
        }
    }

    function error($mensaje){
        echo  json_encode(array('mensaje' => $mensaje)); 
    }

    function response($ok, $mensaje, $data=null, $status=200){
        http_response_code(200);
        echo  json_encode(
                    array(
                        'ok' => $ok,
                        'mensaje' => $mensaje,
                        'data' => $data,
                        'status' => $status
                    )
                ); 
    }

}
?>