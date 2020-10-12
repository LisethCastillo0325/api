<?php
    require_once 'config/db.php';
    require_once 'app/controller.php';
    require_once 'app/model.php';
    require_once 'app/app.php';

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    $app = new App();
?>