<?php

class Conectar{

    public static function conexion(){

        try{

            require_once(__DIR__ . '/../config.php');

            $conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $conn->exec("SET CHARACTER SET utf8");		
                
        }catch(Exception $e){			
            
            echo "Error" . $e->getMessage();
            echo "Línea del error: " . $e->getLine();
        }

        return $conn;

    }
    public function close(){
    $conn=null;
    }

}

?>